<?php

namespace Betta\Filament\FqnSettings\Values\Concerns;

use Betta\Filament\FqnSettings\Values\Concerns\Return\AsFieldset;
use Betta\Filament\FqnSettings\Values\Concerns\Return\AsGroup;
use Betta\Filament\FqnSettings\Values\Concerns\Return\AsSection;
use Betta\Filament\FqnSettings\Values\Concerns\Return\AsTabs;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;

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
