<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

use function array_diff;

final class RemoveImageSizes implements HookCallbackProviderInterface
{
    public function __construct(
        /** @var list<string> */
        private readonly array $removeSizes = [],
    ) {
    }

    public function registerHookCallbacks(): void
    {
        add_action('init', [$this, 'removeImageSize']);
        add_filter('intermediate_image_sizes', [$this, 'filterIntermediateImageSizes']);
    }

    public function removeImageSize(): void
    {
        foreach ($this->removeSizes as $size) {
            remove_image_size($size);
        }
    }

    /**
     * @param list<string> $sizes
     *
     * @return list<string>
     */
    public function filterIntermediateImageSizes(array $sizes): array
    {
        return array_diff($sizes, $this->removeSizes);
    }
}
