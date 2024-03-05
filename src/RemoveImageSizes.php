<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\WordPress\Hook\HookProviderInterface;

use function add_action;
use function add_filter;
use function array_diff;
use function remove_image_size;

final class RemoveImageSizes implements HookProviderInterface
{
    public function __construct(
        /** @var list<string> */
        private readonly array $removeSizes = [],
    ) {
    }

    public function addHooks(): void
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
