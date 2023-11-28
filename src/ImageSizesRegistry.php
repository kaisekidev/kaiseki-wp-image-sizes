<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use Kaiseki\WordPress\Hook\HookCallbackProviderInterface;

use function array_keys;
use function array_merge;

final class ImageSizesRegistry implements HookCallbackProviderInterface
{
    /** @var array<string, string> */
    private array $labels = [];

    /**
     * @param list<ImageSizeInterface>   $imageSizes
     * @param list<AspectRatioInterface> $aspectRatios
     */
    public function __construct(
        private readonly ImageSizeLabelGeneratorInterface $labelGenerator,
        private array $imageSizes = [],
        private readonly array $aspectRatios = [],
    ) {
        foreach ($this->aspectRatios as $aspectRatio) {
            $this->imageSizes = array_merge($this->imageSizes, $aspectRatio->createImageSizes());
        }

        $this->labels = $this->getLabels($this->imageSizes);
    }

    public function registerHookCallbacks(): void
    {
        add_action('after_setup_theme', [$this, 'registerImageSizes']);
        add_filter('image_size_names_choose', [$this, 'updateNames']);
    }

    public function registerImageSizes(): void
    {
        foreach ($this->imageSizes as $imageSize) {
            $this->addImageSize($imageSize);
        }
    }

    /**
     * @param array<string, string> $names
     *
     * @return array<string, string>
     */
    public function updateNames(array $names): array
    {
        foreach (array_keys($names) as $name) {
            if (!isset($this->labels[$name])) {
                continue;
            }
            $names[$name] = $this->labels[$name];
        }

        return $names;
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

    /**
     * @param list<ImageSizeInterface> $imageSizes
     *
     * @return array<string, string>
     */
    private function getLabels(array $imageSizes): array
    {
        $labels = [];

        foreach ($imageSizes as $imageSize) {
            $label = ($this->labelGenerator)($imageSize);

            if ($label === '') {
                continue;
            }

            $labels[$imageSize->name()] = $label;
        }

        return $labels;
    }
}
