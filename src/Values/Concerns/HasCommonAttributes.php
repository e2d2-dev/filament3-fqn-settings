<?php

namespace Betta\Filament\FqnSettings\Values\Concerns;

use BackedEnum;
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

    public function getIcon(): string|BackedEnum|Htmlable|Closure|null
    {
        return null;
    }

    public function getIconColor(): string|array|null
    {
        return null;
    }
}
