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
            'hook' => [
                'provider' => [],
            ],
            'dependencies' => [
                'aliases' => [
                    ImageSizeLabelGeneratorInterface::class => ImageSizeLabelGenerator::class,
                ],
                'factories' => [
                    BigImageSizeThreshold::class => BigImageSizeThresholdFactory::class,
                    BuiltInImageSizes::class => BuiltInImageSizesFactory::class,
                    ImageSizesRegistry::class => ImageSizesRegistryFactory::class,
                    RemoveImageSizes::class => RemoveImageSizesFactory::class,
                ],
            ],
        ];
    }
}
