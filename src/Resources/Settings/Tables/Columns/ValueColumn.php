<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns;

use Betta\Settings\Models\FqnSetting;
use Filament\Tables\Columns\TextColumn;

class ValueColumn extends TextColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(false);

        $this->formatStateUsing(fn (FqnSetting $record) => $this->getValue($record));

        $this->searchable();

        $this->grow();
    }

    protected function getValue(FqnSetting $record): string
    {
        if($record->isEncrypted()) return '*** '.__('filament-fqn-settings::state.Encrypted').' ***';
        if($record->type == 'array') return 'array';
        return $record->value;
    }
}
