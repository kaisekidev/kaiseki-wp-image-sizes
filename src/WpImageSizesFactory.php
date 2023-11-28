<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class WpImageSizesFactory
{
    public function __invoke(
        ContainerInterface $container,
    ): WpImageSizes {
        $config = Config::get($container);

        /** @var WpImageSize|null $thumbnail */
        $thumbnail = $config->get('image_sizes/thumbnail', null);
        /** @var WpImageSize|null $medium */
        $medium = $config->get('image_sizes/medium', null);
        /** @var WpImageSize|null $mediumLarge */
        $mediumLarge = $config->get('image_sizes/medium_large', null);
        /** @var WpImageSize|null $large */
        $large = $config->get('image_sizes/large', null);

        return new WpImageSizes(
            $thumbnail,
            $medium,
            $mediumLarge,
            $large,
        );
    }
}
