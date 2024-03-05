<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\WordPress\Hook\HookProviderInterface;

use function add_filter;

final class BigImageSizeThreshold implements HookProviderInterface
{
    public function __construct(private readonly int|false|null $bigImageSizeThreshold)
    {
    }

    public function addHooks(): void
    {
        if ($this->bigImageSizeThreshold === null) {
            return;
        }
        add_filter('big_image_size_threshold', fn() => $this->bigImageSizeThreshold);
    }
}
