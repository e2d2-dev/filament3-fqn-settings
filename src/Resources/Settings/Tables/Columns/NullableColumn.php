<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns;

use Betta\Settings\Models\FqnSetting;
use Filament\Tables\Columns\IconColumn;

class NullableColumn extends IconColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->tooltip(fn(FqnSetting $record) => $record->isNullable() ? __('filament-fqn-settings::field.Nullable') : '');

        $this->boolean();

        $this->label(false);

        $this->trueIcon(config('filament-fqn-settings.icon.Nullable'));

        $this->falseIcon(false);
    }
}
