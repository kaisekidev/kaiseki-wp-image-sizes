<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

final class WpImageSizes implements HookCallbackProviderInterface
{
    public function __construct(
        private readonly ?WpImageSize $thumbnail = null,
        private readonly ?WpImageSize $medium = null,
        private readonly ?WpImageSize $mediumLarge = null,
        private readonly ?WpImageSize $large = null,
    ) {
    }

    public function registerHookCallbacks(): void
    {
        if ($this->thumbnail !== null) {
            add_filter('option_thumbnail_size_w', fn() => $this->thumbnail->width());
            add_filter('option_thumbnail_size_h', fn() => $this->thumbnail->height());
            add_filter('option_thumbnail_crop', fn() => $this->thumbnail->crop());

            add_filter('pre_update_option_thumbnail_size_w', fn() => $this->thumbnail->width());
            add_filter('pre_update_option_thumbnail_size_h', fn() => $this->thumbnail->height());
            add_filter('pre_update_option_thumbnail_crop', fn() => $this->thumbnail->crop());
        }

        if ($this->medium !== null) {
            add_filter('option_medium_size_w', fn() => $this->medium->width());
            add_filter('option_medium_size_h', fn() => $this->medium->height());

            add_filter('pre_update_option_medium_size_w', fn() => $this->medium->width());
            add_filter('pre_update_option_medium_size_h', fn() => $this->medium->height());
        }

        if ($this->mediumLarge !== null) {
            add_filter('option_medium_large_size_w', fn() => $this->mediumLarge->width());
            add_filter('option_medium_large_size_h', fn() => $this->mediumLarge->height());

            add_filter('pre_update_option_medium_large_size_w', fn() => $this->mediumLarge->width());
            add_filter('pre_update_option_medium_large_size_h', fn() => $this->mediumLarge->height());
        }

        if ($this->large === null) {
            return;
        }

        add_filter('option_large_size_w', fn() => $this->large->width());
        add_filter('option_large_size_h', fn() => $this->large->height());

        add_filter('pre_update_option_large_size_w', fn() => $this->large->width());
        add_filter('pre_update_option_large_size_h', fn() => $this->large->height());
    }
}
