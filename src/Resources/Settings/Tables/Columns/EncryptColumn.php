<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns;

use Betta\Settings\Models\FqnSetting;
use Filament\Tables\Columns\IconColumn;

class EncryptColumn extends IconColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->boolean();

        $this->label(false);

        $this->tooltip(fn (FqnSetting $record) => $record->isEncrypted() ?
            __('filament-fqn-settings::state.Encrypted') :
            __('filament-fqn-settings::state.NotEncrypted'));

        $this->icon('heroicon-o-finger-print');
    }
}
