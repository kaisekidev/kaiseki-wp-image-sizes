# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.0.0 - 2026-06-01

First tagged release.

### Added

- Configurable WordPress image sizes via the `image_sizes` config key: set built-in size dimensions,
  register custom `ImageSize`s, generate size families from an `AspectRatio` + widths, set the
  big-image threshold (`BigImageSizeThreshold`), and remove sizes (`RemoveImageSizes`). Wired by
  `ConfigProvider` (`WpImageSizes`, `ImageSizesRegistry`, `BigImageSizeThreshold`, `RemoveImageSizes`).

### Changed

- PHP requirement is `^8.2` (PHP 8.4 is the primary target).
- Modernized the dev toolchain (PHPStan 2, PHPUnit 11 schema, composer-require-checker 4); now depends
  on `kaiseki/php-coding-standard: ^1.0` with the shared PHPStan config; `kaiseki/config` and
  `kaiseki/wp-hook` pinned to `^2.0`. CI now runs via the reusable workflow in `kaisekidev/.github`.

### Fixed

- PHPStan 2 (level max), at the root: moved the misplaced `@var list<int>` / `@var list<string>` on
  promoted constructor params to proper `@param` docblocks (removing a `@phpstan-ignore`), and use
  `array_values()` so `AspectRatio::withWidths()` and `RemoveImageSizes::filterIntermediateImageSizes()`
  return genuine lists. No behaviour change.
