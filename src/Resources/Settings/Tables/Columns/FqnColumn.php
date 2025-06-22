<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class FqnColumn extends TextColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->searchable();

        $this->label(false);

        $this->icon('heroicon-o-academic-cap');
    }
}
