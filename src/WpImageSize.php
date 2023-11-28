<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

class WpImageSize
{
    public function __construct(
        private int $width,
        private int $height = 0,
        private bool $crop = false,
    ) {
    }

    public function width(): int
    {
        return $this->width;
    }

    public function height(): int
    {
        return $this->height;
    }

    public function crop(): bool
    {
        return $this->crop;
    }
}
