<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

use function is_array;
use function is_bool;
use function is_numeric;

/**
 * @phpstan-type BuiltInImageSizeConfig = array{0: int, 1?: int, 2?: bool}
 */
final class BuiltInImageSizes implements HookCallbackProviderInterface
{
    public function __construct(
        /** @var BuiltInImageSizeConfig */
        private readonly array $thumbnail = [],
        /** @var BuiltInImageSizeConfig */
        private readonly array $medium = [],
        /** @var BuiltInImageSizeConfig */
        private readonly array $mediumLarge = [],
        /** @var BuiltInImageSizeConfig */
        private readonly array $large = [],
    ) {
    }

    public function registerHookCallbacks(): void
    {
        if ($this->thumbnail !== []) {
            $size = $this->getSize($this->thumbnail);
            add_filter('option_thumbnail_size_w', fn() => $size[0]);
            add_filter('option_thumbnail_size_h', fn() => $size[1]);
            add_filter('option_thumbnail_crop', fn() => $size[2]);

            add_filter('pre_update_option_thumbnail_size_w', fn() => $size[0]);
            add_filter('pre_update_option_thumbnail_size_h', fn() => $size[1]);
            add_filter('pre_update_option_thumbnail_crop', fn() => $size[2]);
        }

        if ($this->medium !== []) {
            $size = $this->getSize($this->medium);
            add_filter('option_medium_size_w', fn() => $size[0]);
            add_filter('option_medium_size_h', fn() => $size[1]);

            add_filter('pre_update_option_medium_size_w', fn() => $size[0]);
            add_filter('pre_update_option_medium_size_h', fn() => $size[1]);
        }

        if ($this->mediumLarge !== []) {
            $size = $this->getSize($this->mediumLarge);
            add_filter('option_medium_large_size_w', fn() => $size[0]);
            add_filter('option_medium_large_size_h', fn() => $size[1]);

            add_filter('pre_update_option_medium_large_size_w', fn() => $size[0]);
            add_filter('pre_update_option_medium_large_size_h', fn() => $size[1]);
        }

        if (!$this->large !== []) {
            return;
        }

        $size = $this->getSize($this->large);
        add_filter('option_large_size_w', fn() => $size[0]);
        add_filter('option_large_size_h', fn() => $size[1]);

        add_filter('pre_update_option_large_size_w', fn() => $size[0]);
        add_filter('pre_update_option_large_size_h', fn() => $size[1]);
    }

    /**
     * @param BuiltInImageSizeConfig $config
     *
     * @return array{0: int, 1: int, 2: bool}
     */
    private function getSize(array $config): array
    {
        return [
            (int)$config[0],
            isset($config[1]) && is_numeric($config[1]) ? (int)$config[1] : 0,
            isset($config[2]) && is_bool($config[2]) && $config[2],
        ];
    }
}
