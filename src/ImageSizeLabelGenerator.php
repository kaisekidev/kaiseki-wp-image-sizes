<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

class ImageSizeLabelGenerator implements ImageSizeLabelGeneratorInterface
{
    public function __invoke(ImageSizeInterface $imageSize): string
    {
        $name = $imageSize->label() !== '' ? $imageSize->label() : $imageSize->name();
        return "{$name} ({$imageSize->width()}×{$imageSize->height()} px)";
    }
}
