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

    private function height(int $width): int
    {
        return (int)(floor($width / $this->x) * $this->y);
    }
}
