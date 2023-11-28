<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

use function array_merge;

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
        $imageSizes = $this->imageSizes;

        foreach ($this->aspectRatios as $aspectRatio) {
            $imageSizes = array_merge($this->imageSizes, $aspectRatio->createImageSizes());
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
