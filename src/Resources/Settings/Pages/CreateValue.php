<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Pages;

use Betta\Filament\FqnSettings\Resources\Concerns\HasPrefixedBreadcrumb;
use Betta\Filament\FqnSettings\Resources\ValueResource;
use Filament\Resources\Pages\CreateRecord;

class CreateValue extends CreateRecord
{
    use HasPrefixedBreadcrumb;

    protected static string $resource = ValueResource::class;
}
