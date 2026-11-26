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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

namespace mod_certificatebeautiful\local;

/**
 * Removes editor-only CSS rules without rewriting declaration values.
 *
 * @package    mod_certificatebeautiful
 * @copyright  2026 Eduardo Kraus https://eduardokraus.com/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class css_cleaner {
    /** @var string CSS whitespace, excluding non-ASCII selector characters. */
    private const SPACE = " \t\r\n\f";

    /** @var string Wrapper selector prefix. */
    private const WRAPPER = '/^\[data-gjs-type[ \t\r\n\f]*=[ \t\r\n\f]*(?:"wrapper"|\'wrapper\'|wrapper)[ \t\r\n\f]*\]/';

    /**
     * Clean CSS while preserving the original on structural errors.
     *
     * @param string $css Source CSS
     * @return string
     */
    public static function clean(string $css): string {
        return self::rules($css, 0, strlen($css), 0) ?? $css;
    }

    /**
     * Locate a rule delimiter or the closing brace of a block.
     *
     * @param string $css Source CSS
     * @param int $start Start offset
     * @param int $end Exclusive end offset
     * @param bool $block Whether to find the closing brace
     * @return int Offset, or -1 for incomplete or malformed input
     */
    private static function scan(string $css, int $start, int $end, bool $block): int {
        $braces = 0;
        $parens = 0;
        $brackets = 0;
        for ($i = $start; $i < $end; $i++) {
            $ch = $css[$i];
            if ($ch === "\\") {
                if (++$i === $end) {
                    return -1;
                }
                continue;
            }
            if ($ch === "/" && ($css[$i + 1] ?? "") === "*") {
                $close = strpos($css, "*/", $i + 2);
                if ($close === false || $close + 2 > $end) {
                    return -1;
                }
                $i = $close + 1;
                continue;
            }
            if ($ch === '"' || $ch === "'") {
                $quote = $ch;
                do {
                    $i++;
                    if (($css[$i] ?? "") === "\\") {
                        $i++;
                    } else if (($css[$i] ?? "") === $quote) {
                        break;
                    }
                } while ($i < $end);
                if ($i >= $end) {
                    return -1;
                }
                continue;
            }
            if ($ch === "(") {
                $parens++;
            } else if ($ch === ")") {
                if (--$parens < 0) {
                    return -1;
                }
            } else if ($ch === "[") {
                $brackets++;
            } else if ($ch === "]") {
                if (--$brackets < 0) {
                    return -1;
                }
            } else if (!$parens && !$brackets) {
                if (!$block && ($ch === "{" || $ch === ";")) {
                    return $i;
                }
                if ($ch === "{") {
                    $braces++;
                } else if ($ch === "}") {
                    if (!$block) {
                        return -1;
                    }
                    if (!$braces) {
                        return $i;
                    }
                    $braces--;
                }
            }
        }
        return -1;
    }

    /**
     * Process a list of rules, including supported grouping at-rules.
     *
     * @param string $css Source CSS
     * @param int $start Start offset
     * @param int $end Exclusive end offset
     * @param int $depth Grouping depth
     * @return string|null Cleaned rules, or null on a structural error
     */
    private static function rules(string $css, int $start, int $end, int $depth): ?string {
        if ($depth > 32) {
            return null;
        }
        $output = [];
        $pos = $start;
        while ($pos < $end) {
            // Keep whitespace and comments even when the following rule is removed.
            $trivia = $pos;
            while ($pos < $end) {
                if (strpos(self::SPACE, $css[$pos]) !== false) {
                    $pos++;
                } else if ($css[$pos] === "/" && ($css[$pos + 1] ?? "") === "*") {
                    $close = strpos($css, "*/", $pos + 2);
                    if ($close === false || $close + 2 > $end) {
                        return null;
                    }
                    $pos = $close + 2;
                } else {
                    break;
                }
            }
            $output[] = substr($css, $trivia, $pos - $trivia);
            if ($pos === $end) {
                break;
            }
            $delimiter = self::scan($css, $pos, $end, false);
            if ($delimiter < 0) {
                return null;
            }
            if ($css[$delimiter] === ";") {
                $output[] = substr($css, $pos, $delimiter + 1 - $pos);
                $pos = $delimiter + 1;
                continue;
            }
            $close = self::scan($css, $delimiter + 1, $end, true);
            if ($close < 0) {
                return null;
            }
            $raw = substr($css, $pos, $delimiter - $pos);
            $selector = rtrim($raw, self::SPACE);
            $suffix = substr($raw, strlen($selector));
            $remove = $selector === "body" || $selector === "*";
            $normalized = $selector;
            if (preg_match(self::WRAPPER, $selector, $match) && strpos($selector, ",") === false) {
                $rest = substr($selector, strlen($match[0]));
                if (preg_match('/^[ \t\r\n\f]*>[ \t\r\n\f]*div[ \t\r\n\f]+\*$/D', $rest)) {
                    $remove = true;
                } else {
                    $candidate = "";
                    if (preg_match('/^[ \t\r\n\f]*>[ \t\r\n\f]*(#.+)$/D', $rest, $child)) {
                        $candidate = $child[1];
                    } else if (preg_match('/^[ \t\r\n\f]+([^>+~ \t\r\n\f].*)$/D', $rest, $descendant)) {
                        $candidate = $descendant[1];
                    }
                    if ($candidate !== "" && $candidate !== "body" && $candidate !== "*" &&
                            !preg_match(self::WRAPPER, $candidate)) {
                        $normalized = $candidate;
                    }
                }
            }
            if (!$remove) {
                if (preg_match('/^@(media|supports|layer|container|document|scope|starting-style)(?=[ \t\r\n\f(]|$)/i', $selector)) {
                    $nested = self::rules($css, $delimiter + 1, $close, $depth + 1);
                    if ($nested === null) {
                        return null;
                    }
                    $output[] = $raw . "{" . $nested . "}";
                } else {
                    $output[] = $normalized . $suffix . substr($css, $delimiter, $close + 1 - $delimiter);
                }
            }
            $pos = $close + 1;
        }
        return implode("", $output);
    }
}
