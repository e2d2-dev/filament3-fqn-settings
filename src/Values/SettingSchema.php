<?php

namespace Betta\Filament\FqnSettings\Values;

use Betta\Filament\FqnSettings\Enums\SchemaAs;
use Betta\Filament\FqnSettings\Values\Concerns\CanReturnAs;
use Betta\Filament\FqnSettings\Values\Concerns\HasCommonAttributes;
use Betta\Filament\FqnSettings\Values\Concerns\HasValues;

class SettingSchema
{
    use CanReturnAs;
    use HasCommonAttributes;
    use HasValues;

    protected array $data = [];

    protected array $fqnSettings = [];

    protected \BackedEnum $returnAs = SchemaAs::Tabs;

    public function schema(): array
    {
        return [
            //
        ];
    }
}
