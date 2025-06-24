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

        $this->formatStateUsing(fn (FqnSetting $record) => $record->isEncrypted() ? '*** '.__('filament-fqn-settings::state.Encrypted').' ***' : $record->value);

        $this->limit('30');

        $this->searchable();

        $this->grow();
    }
}
