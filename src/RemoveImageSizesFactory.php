<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class RemoveImageSizesFactory
{
    public function __invoke(
        ContainerInterface $container,
    ): RemoveImageSizes {
        $config = Config::get($container);
        /** @var list<string> $sizes */
        $sizes = $config->array('image_sizes/remove_sizes', []);
        return new RemoveImageSizes($sizes);
    }
}
