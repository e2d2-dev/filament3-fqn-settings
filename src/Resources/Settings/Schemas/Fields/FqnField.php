<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Schemas\Fields;

use Betta\Settings\Models\FqnSetting;
use Filament\Forms\Components\Placeholder;

class FqnField extends Placeholder
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->visibleOn('edit');

        $this->hiddenLabel();

        $this->content(fn(FqnSetting $record) => $record->fqn);
    }
}
