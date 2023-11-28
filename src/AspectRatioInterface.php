<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

interface AspectRatioInterface
{
    /**
     * @return list<ImageSize>
     */
    public function createImageSizes(): array;
}
