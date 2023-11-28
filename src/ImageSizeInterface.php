<?php

declare(strict_types=1);

namespace Kaiseki\WordPress\ImageSizes;

interface ImageSizeInterface
{
    public function name(): string;

    public function width(): int;

    public function height(): int;

    public function crop(): bool;
}
