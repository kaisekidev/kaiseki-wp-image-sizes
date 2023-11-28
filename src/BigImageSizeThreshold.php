<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

final class BigImageSizeThreshold implements HookCallbackProviderInterface
{
    public function __construct(private readonly int|false $bigImageSizeThreshold)
    {
    }

    public function registerHookCallbacks(): void
    {
        add_filter('big_image_size_threshold', fn() => $this->bigImageSizeThreshold);
    }
}
