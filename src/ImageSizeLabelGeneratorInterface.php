<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

interface ImageSizeLabelGeneratorInterface
{
    public function __invoke(ImageSizeInterface $imageSize): string;
}
