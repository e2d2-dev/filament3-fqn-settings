<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Closure;

trait HasColumns
{
    public function columns(): array|int|Closure|null
    {
        return 2;
    }
}
