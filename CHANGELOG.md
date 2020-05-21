# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.5.0] - 2018-07-14

### Changed

- All classes in `application/admin/controllers`, `application/admin/models`, 
  `application/admin/catalog` and `application/catalog/models` start with upper case letter
  to be CodeIgniter Style conform.
- Removed closing PHP tag `?>` from all classes in `application/admin/controllers`, `application/admin/libraries`,
  `application/admin/models`, `application/catalog/controllers`, `application/catalog/libraries` and
  `application/catalog/models`.
- Ignored `.idea/` and `htdocs/` in `.gitignore`.
- README.
- Change base url and database configuration of admin and catalog application to be able to develop locally
  using [devilbox](https://github.com/cytopia/devilbox).
- **Updated to CodeIgniter v3.1.9**.
  - Application config updated.
  - Errors moved to views.
  - Missing directories added.
  - `index.php` and `admin.php` adapted.
  - Converted Files to LF format.
- Application directory (`system/application`) moved to root of the project.

### Deleted

- Removed unneeded `_img` and `_css` directories and all their contents.

## [0.4.0] - 2017-02-23

### Added

- MySQL file `/simplecishop.sql`

## [0.3.0] - 2011-10-24

### Added

- `/.gitignore`

### Changed

- Upgraded CodeIgniter to v1.7.2

## [0.2.0] - 2011-08-08

### Added

- Details of the project in the README.

### Changed

- Moved the files in the `/theme` directory under `default` subdirectory to support more themes in the future.

## [0.1.0] - 2011-08-04

### Added

- First Commit (3b0cfd8a)
  - CodeIgniter v1.5.3 under `/system`
  - Common style `/_css/style.css`
  - Common images under `/_img`
  - Assets (JavaScript packages)
    - FCKeditor v2.3.2
    - jscalendar v1.51
    - validation v1.5.4.1
  - Shop images under `/images`
  - Javascript libraries under `/javascript`
    - script.aculo.us `builder.js` v1.7.0
    - script.aculo.us `controls.js` v1.7.0
    - script.aculo.us `dragdrop.js` v1.7.0
    - script.aculo.us `effects.js` v1.7.0
    - Prototype JavaScript framework `prototype.js` v1.5.0
    - script.aculo.us `scriptaculous.js` v1.7.0
    - script.aculo.us `slider.js` v1.7.0
    - script.aculo.us `unittest.js` v1.7.0
  - SimpleCiShop Applications under `/system/application`
    - Admin application in `/system/application/admin`
    - Catalog (frontend) application in `/system/application/catalog`
  - Common theme under `/theme`
  - Blog images under `/uploads/Image/products`
  - `/.htaccess`
  - `/admin.php`
  - `/index.php`
  - `/licence.txt`
  - `/README.md`

[unreleased]: https://github.com/panigrc/SimpleCiShop/compare/v0.5.0...HEAD
[0.5.0]: https://github.com/panigrc/SimpleCiShop/compare/v0.4.0...v0.5.0
[0.4.0]: https://github.com/panigrc/SimpleCiShop/compare/v0.3.0...v0.4.0
[0.3.0]: https://github.com/panigrc/SimpleCiShop/compare/v0.2.0...v0.3.0
[0.2.0]: https://github.com/panigrc/SimpleCiShop/compare/v0.1.0...v0.2.0
[0.1.0]: https://github.com/panigrc/SimpleCiShop/releases/tag/v0.1.0