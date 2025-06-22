<?php

namespace Betta\Filament\FqnSettings\Values\Concerns;

use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;

trait HasComponents
{
    protected array $data = [];

    /**
     * @return array|Section|Group|Tab
     */
    public function getComponents(): mixed
    {
        return match ($this->returnAs) {
            'section' => $this->asSection(),
            'tab' => $this->asTab(),
            default => $this->schema(),
        };
    }
}
