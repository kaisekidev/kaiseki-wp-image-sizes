<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

/**
 * @phpstan-import-type BuiltInImageSizeConfig from BuiltInImageSizes
 */
final class BuiltInImageSizesFactory
{
    public function __invoke(
        ContainerInterface $container,
    ): BuiltInImageSizes {
        $config = Config::get($container);

        /** @var BuiltInImageSizeConfig $thumbnail */
        $thumbnail = $config->array('image_sizes/built_in/thumbnail', []);
        /** @var BuiltInImageSizeConfig $medium */
        $medium = $config->array('image_sizes/built_in/medium', []);
        /** @var BuiltInImageSizeConfig $mediumLarge */
        $mediumLarge = $config->array('image_sizes/built_in/medium_large', []);
        /** @var BuiltInImageSizeConfig $large */
        $large = $config->array('image_sizes/built_in/large', []);

        return new BuiltInImageSizes(
            $thumbnail,
            $medium,
            $mediumLarge,
            $large,
        );
    }
}
