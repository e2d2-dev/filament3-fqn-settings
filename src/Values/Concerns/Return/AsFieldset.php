<?php

namespace Betta\Filament\FqnSettings\Values\Concerns\Return;

use Filament\Forms\Components\Fieldset;

trait AsFieldset
{
    public function fieldset(): Fieldset
    {
        return Fieldset::make($this->getHeading())
            ->schema($this->schema());
    }

    public function modifyFieldsetUsing(Fieldset $fieldset): Fieldset
    {
        return $fieldset;
    }

    public function asFieldset(): Fieldset
    {
        return $this->modifyFieldsetUsing($this->fieldset());
    }
}
