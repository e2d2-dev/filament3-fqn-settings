<?php

namespace Betta\Filament\FqnSettings\Values\Concerns;

use Betta\Filament\FqnSettings\Values\Concerns\Return\AsFieldset;
use Betta\Filament\FqnSettings\Values\Concerns\Return\AsGroup;
use Betta\Filament\FqnSettings\Values\Concerns\Return\AsSection;
use Betta\Filament\FqnSettings\Values\Concerns\Return\AsTabs;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs\Tab;

trait CanReturnAs
{
    use AsFieldset;
    use AsGroup;
    use AsSection;
    use AsTabs;

    /**
     * @return array|Section|Group|Tab|Fieldset
     */
    public function getComponents(): mixed
    {
        return match ($this->returnAs->value) {
            'section' => $this->asSection(),
            'tabs' => $this->tabs(),
            'fieldset' => $this->asFieldset(),
            'group' => $this->asGroup(),
            default => $this->schema(),
        };
    }
}
