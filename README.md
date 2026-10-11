**Beautiful certificate plugin for Moodle**

## Overview

The Beautiful certificate plugin for Moodle improves the certificate creation experience, providing a smooth and aesthetically pleasing design for personalized certificates. This plugin is designed to enrich the visual and professional appeal of certificate designs, offering an intuitive interface for ease of use.

## Resources

- **Standard certificates:**
  - Certificate of Appreciation
  - Elegant Certificate
  - Modern Flat Certificate
  - Simple Certificate
  - Vintage Certificate
  - Golden Certificate
  - Certificate Summary

- **Configuration Options:**
  - Student's course
  - Course category
  - Enrolment data
  - Data functions
  - Notes
  - Moodle Data
  - Teacher data
  - Student Data
  - Student Profile

- **Export pfor PDF:**
  - The plugin allows the export of certificates in PDF format.

## Installation

1. Download Beautiful certificate plugin.
2. Install the plugin on your Moodle instance following the standard installation process..
3. Add to the courses where you want to deliver a certificate.

## Contributing

Please feel free to contribute to the development of the Beautiful certificate plugin, sending problems or pull requests. [repositório do GitHub](https://github.com/EduardoKrausME/moodle-mod_certificatebeautiful).

## Licença

Este plugin está licenciado sob a Licença MIT.


## MCP integration (optional)

When [local_mcp](https://github.com/EduardoKrausME/moodle-local_mcp) is installed,
its automatic discovery loads `mod_certificatebeautiful\mcp\provider` from
`classes/mcp/provider.php`. No callback, manually configured tool, or dependency
in `version.php` is required. With local_mcp absent the normal certificate
module continues to work.

Tools discovered in **READ** scope:

- `certificatebeautiful_list_models`: enumerate templates and page counts.
- `certificatebeautiful_get_model`: return complete template HTML/CSS plus a `state_hash`.
- `certificatebeautiful_list_activities`: list course certificates and automation settings.
- `certificatebeautiful_list_issues`: paginate issued certificates of a module (max 100).

Tools discovered in **WRITE** scope:

- `certificatebeautiful_save_model`: create a template or update selected fields,
  with an `expected_hash` on existing models and a confirmation preview.
- `certificatebeautiful_create_activity`: create a certificate course module through
  Moodle's standard course-module API, supporting automatic issuance rules.

Template read/write operations require
`mod/certificatebeautiful:managemodels` at site context; activity listing and
creation require course-management permissions, and issuance reports require
`mod/certificatebeautiful:viewreport` at module context. READ and WRITE
capabilities must also be enabled independently in local_mcp. Never give an MCP
integration more permissions than the connected Moodle user requires.

For editing templates, first call `certificatebeautiful_get_model`, then send
the returned `state_hash` as `expected_hash` to avoid overwriting intervening
edits. Each model has one to three pages, represented by `htmldata` and
`cssdata`. New templates without pages start with the module's standard
blank page. HTML and CSS are trusted administrative content, so only authorized
template administrators should have access.

