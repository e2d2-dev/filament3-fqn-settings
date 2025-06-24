<?php

namespace Betta\Filament\FqnSettings\Values\Concerns\Return;

use Filament\Schemas\Components\Group;

trait AsGroup
{
    public function group(): Group
    {
        return Group::make($this->schema());
    }

    public function modifyGroupUsing(Group $group): Group
    {
        return $group;
    }

    public function asGroup(): Group
    {
        return $this->modifyGroupUsing($this->group());
    }
}
