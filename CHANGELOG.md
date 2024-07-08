# Change Log

All notable changes to this project will be documented in this file.

## [1.9] - 2024-07-08
### Fixed
- Fixed issue around changing of Processed and Inducted checkboxes, as well as inability access notes history.

## [1.8] - 2024-07-08
### Fixed
- Ensured the Inducted and Processed check boxes on history page are directly editable and requires are handled to update fields.

## [1.7] - 2024-07-08
### Fixed
- Improved help popup behavior to appear next to the question mark icon.

## [1.6] - 2024-07-08
### Fixed
- Adjusted the position of the "Add Another Subject" button for better formatting.
- Changed help box behavior to display as overlays instead of submitting the form.

## [1.5] - 2024-07-08
### Changed
- Switched to using PDO for database operations for improved security and performance.

## [1.4] - 2024-07-08
### Added
- Added the `inducted` and `processed` fields to the notes table.
- Added a detailed view for each student in the meeting history.

### Fixed
- Ensured tables are created correctly on plugin activation.

## [1.3] - 2024-07-08
### Added
- Added meeting history page with a list of notes and status tracking fields.
- Implemented shortcode `[tnp_meeting_history]` for meeting history.

## [1.2] - 2024-07-08
### Fixed
- Improved form submission handling and AJAX response.

## [1.1] - 2024-07-08
### Added
- Created introductory form with multiple fields to collect tutee information.
- Implemented shortcode `[tnp_introductory_form]` for the form.

## [1.0] - 2024-07-08
### Added
- Initial release with basic functionality for collecting and storing introductory session notes.
