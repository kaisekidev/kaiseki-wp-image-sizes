<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

use function array_map;
use function floor;

final class AspectRatio implements AspectRatioInterface
{
    public function __construct(
        private readonly string $name,
        private readonly int $x,
        private readonly int $y,
        /** @var list<int> */
        private readonly array $widths,
    ) {
    }

    /**
     * @return list<ImageSize>
     */
    public function createImageSizes(): array
    {
        return array_map(
            fn(int $width): ImageSize => new ImageSize(
                $this->name . $width,
                $width,
                $this->height($width),
                true,
            ),
            $this->widths
        );
    }

    public function withName(string $name): self
    {
        return new self($name, $this->x, $this->y, $this->widths);
    }

    public function withAspectRatio(int $x, int $y): self
    {
        return new self($this->name, $x, $y, $this->widths);
    }

    public function withWidths(int ...$widths): self
    {
        // @phpstan-ignore-next-line
        return new self($this->name, $this->x, $this->y, $widths);
    }

    private function height(int $width): int
    {
        return (int)(floor($width / $this->x) * $this->y);
    }
}
