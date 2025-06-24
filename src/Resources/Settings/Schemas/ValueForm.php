<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Schemas;

use Betta\Filament\FqnSettings\Resources\Settings\Sections\DefaultValueSection;
use Betta\Filament\FqnSettings\Resources\Settings\Sections\EncryptSection;
use Betta\Filament\FqnSettings\Resources\Settings\Sections\FqnSection;
use Betta\Filament\FqnSettings\Resources\Settings\Sections\KeySection;
use Betta\Filament\FqnSettings\Resources\Settings\Sections\TypeSection;
use Betta\Filament\FqnSettings\Resources\Settings\Sections\ValueSection;
use Filament\Schemas\Schema;

class ValueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                FqnSection::make(),
                TypeSection::make(),
                KeySection::make(),
                ValueSection::make(),
                DefaultValueSection::make(),
                EncryptSection::make(),
            ]);
    }
}
