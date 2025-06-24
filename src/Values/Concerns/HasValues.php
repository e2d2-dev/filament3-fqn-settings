<?php

namespace Betta\Filament\FqnSettings\Values\Concerns;

trait HasValues
{
    public function getValues(): array
    {
        $arr = [];

        foreach ($this->fqnSettings as $fqn) {

            $path = str($fqn)->beforeLast('\\')->replace('\\', '_')->snake();
            $key = str($fqn)->afterLast('\\')->snake();

            $this->data["{$path}.{$key}"] = $fqn::get();
        }

        return $this->data;
    }
}
