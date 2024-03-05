<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

class ImageSize implements ImageSizeInterface
{
    public function __construct(
        private readonly string $name,
        private readonly int $width,
        private readonly int $height = 0,
        private readonly bool $crop = false,
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

    public function withName(string $name): self
    {
        return new self($name, $this->width, $this->height, $this->crop);
    }

    public function withWidth(int $width): self
    {
        return new self($this->name, $width, $this->height, $this->crop);
    }

    public function withHeight(int $height): self
    {
        return new self($this->name, $this->width, $height, $this->crop);
    }

    public function withCrop(bool $crop = true): self
    {
        return new self($this->name, $this->width, $this->height, $crop);
    }
}
