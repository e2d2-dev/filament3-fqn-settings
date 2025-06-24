<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class KeyColumn extends TextColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->searchable();

        $this->label(false);

        $this->icon(config('filament-fqn-settings.icon.Key'));

        $this->tooltip(__('filament-fqn-settings::field.Key'));
    }
}
