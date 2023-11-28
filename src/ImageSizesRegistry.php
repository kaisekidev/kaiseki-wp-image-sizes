<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

final class ImageSizesRegistry implements HookCallbackProviderInterface
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

    public function registerHookCallbacks(): void
    {
        add_action('after_setup_theme', [$this, 'registerImageSizes']);
    }

    public function registerImageSizes(): void
    {
        foreach ($this->imageSizes as $imageSize) {
            $this->addImageSize($imageSize);
        }

        foreach ($this->aspectRatios as $aspectRatio) {
            $this->addRatio($aspectRatio);
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

    private function addRatio(AspectRatioInterface $aspectRatio): void
    {
        foreach ($aspectRatio->createImageSizes() as $imageSize) {
            $this->addImageSize($imageSize);
        }
    }
}
