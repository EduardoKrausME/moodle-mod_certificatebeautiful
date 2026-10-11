<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Certificate model MCP validation and persistence.
 *
 * @package mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\mcp;

use invalid_parameter_exception;
use mod_certificatebeautiful\model\form_create_page;
use moodle_url;

/**
 * Keep model reads, write validation and optimistic locking in one place.
 */
final class model_service {
    /**
     * Return a model and revision for editing.
     *
     * @param int $id Model id.
     * @return array
     */
    public static function snapshot(int $id): array {
        global $DB;

        $model = $DB->get_record('certificatebeautiful_model', ['id' => $id], '*', MUST_EXIST);
        $pages = json_decode($model->pages_info ?? '[]', true);
        return [
            'id' => (int)$model->id,
            'name' => $model->name,
            'orientation' => $model->orientation,
            'model_key' => $model->model_key,
            'pages' => is_array($pages) ? $pages : [],
            'timecreated' => (int)$model->timecreated,
            'timemodified' => (int)$model->timemodified,
            'state_hash' => self::hash($model),
            'edit_url' => (new moodle_url('/mod/certificatebeautiful/manage-model.php',
                ['id' => $model->id]))->out(false),
        ];
    }

    /**
     * Hash all editable columns, not only a timestamp with one-second resolution.
     *
     * @param object $model Database model.
     * @return string
     */
    private static function hash($model): string {
        return hash('sha256', json_encode([
            (int)$model->id, $model->name, $model->orientation,
            $model->model_key, $model->pages_info, (int)$model->timemodified,
        ]));
    }

    /**
     * Validate a create/update without writing to the database.
     *
     * @param array $args MCP arguments.
     * @return array
     */
    public static function prepare(array $args): array {
        global $DB;

        $id = (int)($args['id'] ?? 0);
        if ($id < 0) {
            throw new invalid_parameter_exception('id must be zero or a positive model id.');
        }

        $existing = $id ? $DB->get_record('certificatebeautiful_model',
            ['id' => $id], '*', MUST_EXIST) : null;
        if ($existing) {
            if (empty($args['expected_hash']) ||
                    !hash_equals(self::hash($existing), (string)$args['expected_hash'])) {
                throw new invalid_parameter_exception(
                    'The model changed. Read certificatebeautiful_get_model again and retry with its state_hash.');
            }
            if (array_key_exists('orientation', $args) &&
                    $args['orientation'] !== $existing->orientation) {
                throw new invalid_parameter_exception('Model orientation cannot be changed after creation.');
            }
        }

        $name = array_key_exists('name', $args) ? trim((string)$args['name']) :
            ($existing->name ?? '');
        $name = clean_param($name, PARAM_TEXT);
        if ($name === '' || \core_text::strlen($name) > 254) {
            throw new invalid_parameter_exception('Model name must contain between 1 and 254 characters.');
        }

        $orientation = $existing->orientation ?? ($args['orientation'] ?? 'L');
        if (!in_array($orientation, ['L', 'P'], true)) {
            throw new invalid_parameter_exception('Orientation must be L or P.');
        }

        if (array_key_exists('pages', $args)) {
            $pages = $args['pages'];
            if (!is_array($pages) || count($pages) < 1 || count($pages) > 3 ||
                    array_keys($pages) !== range(0, count($pages) - 1)) {
                throw new invalid_parameter_exception('Pages must be an array containing 1 to 3 pages.');
            }
            foreach ($pages as $page) {
                if (!is_array($page) || !isset($page['htmldata'], $page['cssdata']) ||
                        !is_string($page['htmldata']) || !is_string($page['cssdata']) ||
                        strlen($page['htmldata']) > 1048576 || strlen($page['cssdata']) > 1048576) {
                    throw new invalid_parameter_exception(
                        'Every page needs htmldata and cssdata strings, each at most 1 MiB.');
                }
                if (array_diff(array_keys($page), ['htmldata', 'cssdata'])) {
                    throw new invalid_parameter_exception('Unsupported page property.');
                }
            }
        } else if ($existing) {
            $pages = json_decode($existing->pages_info ?? '[]', true);
            if (!is_array($pages)) {
                throw new invalid_parameter_exception('The existing pages_info is not valid JSON.');
            }
        } else {
            $pages = [(array)form_create_page::empty_page((object)['orientation' => $orientation])];
        }

        $json = json_encode($pages, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            throw new invalid_parameter_exception('Certificate page data could not be encoded as JSON.');
        }

        $record = (object)[
            'name' => $name,
            'orientation' => $orientation,
            'pages_info' => $json,
            'timemodified' => time(),
        ];
        if ($existing) {
            $record->id = (int)$existing->id;
        } else {
            $record->model_key = '';
            $record->timecreated = time();
        }
        return ['record' => $record, 'is_new' => !$existing, 'page_count' => count($pages)];
    }

    /**
     * Save a validated model. Recheck the revision in prepare at write time.
     *
     * @param array $args MCP arguments.
     * @return array
     */
    public static function save(array $args): array {
        global $DB;

        $prepared = self::prepare($args);
        $record = $prepared['record'];
        if ($prepared['is_new']) {
            $record->id = $DB->insert_record('certificatebeautiful_model', $record);
        } else {
            $DB->update_record('certificatebeautiful_model', $record);
        }
        return self::snapshot((int)$record->id);
    }
}
