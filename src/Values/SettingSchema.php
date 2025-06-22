<?php

namespace Betta\Filament\FqnSettings\Values;

use Betta\Filament\FqnSettings\Values\Concerns\AsSection;
use Betta\Filament\FqnSettings\Values\Concerns\AsTab;
use Betta\Filament\FqnSettings\Values\Concerns\HasCommonAttributes;
use Betta\Filament\FqnSettings\Values\Concerns\HasComponents;
use Betta\Filament\FqnSettings\Values\Concerns\HasValues;

class SettingSchema
{
    use AsSection;
    use AsTab;
    use HasCommonAttributes;
    use HasComponents;
    use HasValues;

    protected array $fqnSettings = [];

    protected ?string $returnAs = 'section';

    public function schema(): array
    {
        return [
            //
        ];
    }
}
