<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

class WpImageSize
{
    public function __construct(
        private readonly int $width,
        private readonly int $height = 0,
        private readonly bool $crop = false,
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

    public function withWidth(int $width): self
    {
        return new self($width, $this->height, $this->crop);
    }

    public function withHeight(int $height): self
    {
        return new self($this->width, $height, $this->crop);
    }

    public function withCrop(bool $crop = true): self
    {
        return new self($this->width, $this->height, $crop);
    }
}
