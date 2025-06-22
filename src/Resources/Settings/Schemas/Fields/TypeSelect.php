<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Schemas\Fields;

use Filament\Forms\Components\ToggleButtons;

class TypeSelect extends ToggleButtons
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-fqn-settings::field.Type'));

        $this->default('string');

        $this->inline();

        $this->required();

        $this->reactive();

        $this->options([
            'string' => 'string',
            'int' => 'int',
            'bool' => 'bool',
            'float' => 'float',
        ]);
    }
}
