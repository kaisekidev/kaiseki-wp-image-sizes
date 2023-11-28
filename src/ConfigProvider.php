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
            'dependencies' => [
                'factories' => [
                    BigImageSizeThreshold::class => BigImageSizeThresholdFactory::class,
                    WpImageSizes::class          => WpImageSizesFactory::class,
                    ImageSizesRegistry::class    => ImageSizesRegistryFactory::class,
                    RemoveImageSizes::class      => RemoveImageSizesFactory::class,
                ],
            ],
        ];
    }
}
