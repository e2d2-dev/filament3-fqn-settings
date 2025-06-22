<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns;

use Betta\Settings\Models\FqnSetting;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;

class DefaultValueColumn extends TextColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(false);

        $this->formatStateUsing(fn (FqnSetting $record) => $record->isEncrypted() ? '*** encrypted ***' : $record->default);

        $this->tooltip(__('filament-fqn-settings::field.DefaultValue'));

        $this->icon(Heroicon::OutlinedLightBulb);

        $this->searchable();

        $this->grow();
    }
}
