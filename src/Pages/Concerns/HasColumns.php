<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Closure;

trait HasColumns
{
    public function columns(): array|int|Closure|null
    {
        return 1;
    }

    public function columnSpan(): int|Closure|null
    {
        return 2;
    }
}
