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

        $this->grow(false);

        $this->label(false);

        $this->tooltip(fn (?FqnSetting $record) =>
            $record->isEncrypted() ? __('filament-fqn-settings::state.Encrypted') : ''
        );

        $this->trueIcon(config('filament-fqn-settings.icon.Encrypted'));

        $this->falseIcon(false);
    }
}
