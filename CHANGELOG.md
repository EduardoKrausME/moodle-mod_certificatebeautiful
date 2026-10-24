# Changelog

This changelog documents only the two latest published GitHub releases. Each entry is based on the differences between its release tag and the immediately preceding published release. Later changes on `master` are excluded.

## 3.2.20 - 2026-10-19

### Added

- Added an optional Moodle MCP integration notice for site administrators when `local_mcp` is not installed. The notice is shown on the Certificate Beautiful activity editing form, rather than the certificate model list.
- Added a persistent, per-user dismissal option. Dismissal is submitted through a POST form, requires a valid Moodle session key, and is limited to site administrators.
- Added a dedicated accessible Mustache template, responsive and dark-mode-aware styling, and English and Brazilian Portuguese translations for the notice.

### Changed

- Updated the optional Moodle MCP integration documentation to link to its documentation website.
- Adjusted notice placement to render it before the activity form, avoiding nested HTML forms.
- Refined the new banner's PHPDoc annotations for Moodle coding-style checks.
- Updated the plugin release to `3.2.20` and its build number to `2026101900`.

[Compare 3.2.19...3.2.20](https://github.com/EduardoKrausME/moodle-mod_certificatebeautiful/compare/3.2.19...3.2.20)

## 3.2.19 - 2026-10-15

### Changed

- Removed `db/events.php`, which previously registered the `\core\event\course_completed` observer callback `\mod_certificatebeautiful\observer::course_completed`.
- Updated the GitHub Actions CI database service from MariaDB 11 to MariaDB 11.4, including its initialization variables and health-check command.
- Updated the plugin release to `3.2.19` and its build number to `2026101500`.

[Compare 3.2.18...3.2.19](https://github.com/EduardoKrausME/moodle-mod_certificatebeautiful/compare/3.2.18...3.2.19)
