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
        $config = Config::fromContainer($container);
        /** @var false|int|null $threshold */
        $threshold = $config->get('image_sizes.big_image_threshold');

        return new BigImageSizeThreshold($threshold);
    }
}
