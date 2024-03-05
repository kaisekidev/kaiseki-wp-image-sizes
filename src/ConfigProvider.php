<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

final class ConfigProvider
{
    /**
     * @return array<mixed>
     */
    public function __invoke(): array
    {
        return [
            'image_sizes' => [
                'thumbnail' => null,
                'medium' => null,
                'medium_large' => null,
                'large' => null,
                'image_sizes' => [],
                'aspect_ratios' => [],
                'big_image_threshold' => null,
                'remove_sizes' => [],
            ],
            'dependencies' => [
                'factories' => [
                    BigImageSizeThreshold::class => BigImageSizeThresholdFactory::class,
                    WpImageSizes::class => WpImageSizesFactory::class,
                    ImageSizesRegistry::class => ImageSizesRegistryFactory::class,
                    RemoveImageSizes::class => RemoveImageSizesFactory::class,
                ],
            ],
        ];
    }
}
