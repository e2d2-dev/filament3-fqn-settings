<?php

namespace Betta\Filament\FqnSettings\Values\Concerns;

use Closure;
use Illuminate\Contracts\Support\Htmlable;

trait HasCommonAttributes
{
    public function getHeading(): string|Htmlable|Closure|null
    {
        return null;
    }

    public function getDescription(): string|Htmlable|Closure|null
    {
        return null;
    }

    public function getIcon(): string|Htmlable|Closure|null
    {
        return null;
    }

    public function getIconColor(): string|array|null
    {
        return null;
    }

    public function columnSpan(?int $columnSpan = 1): int
    {
        return $columnSpan;
    }

    public function columns(?int $columns = 1): int
    {
        return $columns;
    }
}
