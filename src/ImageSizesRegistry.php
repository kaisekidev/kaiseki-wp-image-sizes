<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\WordPress\Hook\HookProviderInterface;

use function add_action;
use function add_image_size;
use function array_merge;

final class ImageSizesRegistry implements HookProviderInterface
{
    /**
     * @param list<ImageSizeInterface>   $imageSizes
     * @param list<AspectRatioInterface> $aspectRatios
     */
    public function __construct(
        private readonly array $imageSizes = [],
        private readonly array $aspectRatios = [],
    ) {
    }

    public function addHooks(): void
    {
        add_action('after_setup_theme', [$this, 'registerImageSizes']);
    }

    public function registerImageSizes(): void
    {
        $imageSizes = $this->imageSizes;

        foreach ($this->aspectRatios as $aspectRatio) {
            array_push($imageSizes, ...$aspectRatio->createImageSizes());
        }

        foreach ($imageSizes as $imageSize) {
            $this->addImageSize($imageSize);
        }
    }

    private function addImageSize(ImageSizeInterface $imageSize): void
    {
        add_image_size(
            $imageSize->name(),
            $imageSize->width(),
            $imageSize->height(),
            $imageSize->crop()
        );
    }
}
