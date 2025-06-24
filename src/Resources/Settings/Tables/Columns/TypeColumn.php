<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class TypeColumn extends TextColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->tooltip(__('filament-fqn-settings::field.ReturnType'));

        $this->label(false);

        $this->icon('');

        $this->badge();
    }
}
