# kaiseki/wp-image-sizes

Register, configure and remove WordPress image sizes, including aspect-ratio-based size sets.

Driven by the `image_sizes` config key and wired through `ConfigProvider`: set the built-in size
dimensions, register custom sizes, generate whole families of sizes from an aspect ratio and a list of
widths, tune the big-image threshold, and remove unwanted core sizes.

## Installation

```bash
composer require kaiseki/wp-image-sizes
```

Requires PHP 8.2 or newer.

## Usage

Register `ConfigProvider` with your laminas-style config aggregator and configure the `image_sizes`
key:

```php
use Kaiseki\WordPress\ImageSizes\AspectRatio;
use Kaiseki\WordPress\ImageSizes\ImageSize;

return [
    'image_sizes' => [
        // Built-in sizes: [width, height, crop] or null to leave untouched.
        'thumbnail'    => [150, 150, true],
        'medium'       => [300, 300, false],
        'medium_large' => null,
        'large'        => [1024, 1024, false],

        // Additional custom sizes.
        'image_sizes' => [
            new ImageSize('hero', 1600, 900, true),
        ],

        // Generate one ImageSize per width from a name + aspect ratio.
        'aspect_ratios' => [
            (new AspectRatio('card-', 4, 3, []))->withWidths(320, 640, 960),
        ],

        // Override the 2560px "big image" threshold (or false to disable scaling).
        'big_image_threshold' => 2560,

        // Core/registered sizes to remove.
        'remove_sizes' => ['1536x1536', '2048x2048'],
    ],
];
```

`ConfigProvider` registers factories for `WpImageSizes` (applies the size configuration),
`ImageSizesRegistry`, `BigImageSizeThreshold` (the `big_image_size_threshold` filter) and
`RemoveImageSizes` (removes sizes and filters them out of `intermediate_image_sizes`). An
`AspectRatio` expands a ratio and a set of widths into individual `ImageSize`s via `createImageSizes()`.

## Development

```bash
composer install
composer check   # check-deps, cs-check, phpstan
```

## License

MIT — see [LICENSE](LICENSE).
