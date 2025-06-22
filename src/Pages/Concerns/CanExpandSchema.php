<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

trait CanExpandSchema
{
    public function fillAdditionalData(): array
    {
        return [];
    }

    public function beforeSchema(): array
    {
        return [];
    }

    public function afterSchema(): array
    {
        return [];
    }
}
