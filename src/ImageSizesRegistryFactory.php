<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class ImageSizesRegistryFactory
{
    public function __invoke(
        ContainerInterface $container,
    ): ImageSizesRegistry {
        $config = Config::fromContainer($container);
        /** @var list<ImageSizeInterface> $imageSizes */
        $imageSizes = $config->array('image_sizes.image_sizes');
        /** @var list<AspectRatioInterface> $aspectRatios */
        $aspectRatios = $config->array('image_sizes.aspect_ratios');

        return new ImageSizesRegistry(
            $imageSizes,
            $aspectRatios
        );
    }
}
