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

        /** @var BuiltInImageSizeConfig|null $thumbnail */
        $thumbnail = $config->array('image_sizes/built_in/thumbnail', null, true);
        /** @var BuiltInImageSizeConfig|null $medium */
        $medium = $config->array('image_sizes/built_in/medium', null, true);
        /** @var BuiltInImageSizeConfig|null $mediumLarge */
        $mediumLarge = $config->array('image_sizes/built_in/medium_large', null, true);
        /** @var BuiltInImageSizeConfig|null $large */
        $large = $config->array('image_sizes/built_in/large', null, true);

        return new BuiltInImageSizes(
            $thumbnail,
            $medium,
            $mediumLarge,
            $large,
        );
    }
}
