<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

class ImageSize implements ImageSizeInterface
{
    public function __construct(
        private string $name,
        private int $width,
        private int $height = 0,
        private bool $crop = false,
    ) {
    }

    public function name(): string
    {
        return $this->name;
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
