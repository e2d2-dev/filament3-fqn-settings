<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns;

use Filament\Tables\Columns\IconColumn;

class LostColumn extends IconColumn
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->color('danger');

        $this->boolean();

        $this->label(false);

        $this->tooltip(fn ($record) => __('filament-fqn-settings::state.Lost').' '.$record->lost_at?->diffForHumans());

        $this->icon(config('filament-fqn-settings.icon.Lost'));
    }
}
