<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\Config\Config;
use Psr\Container\ContainerInterface;

final class BigImageSizeThresholdFactory
{
    public function __invoke(
        ContainerInterface $container,
    ): BigImageSizeThreshold {
        $config = Config::get($container);
        /** @var false|int $threshold */
        $threshold = $config->get('image_sizes/big_image_threshold', 2560);
        return new BigImageSizeThreshold($threshold);
    }
}
