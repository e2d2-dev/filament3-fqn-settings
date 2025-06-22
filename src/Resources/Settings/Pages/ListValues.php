<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Pages;

use Betta\Filament\FqnSettings\Resources\Concerns\HasPrefixedBreadcrumb;
use Betta\Filament\FqnSettings\Resources\Settings\Actions\SyncAction;
use Betta\Filament\FqnSettings\Resources\ValueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListValues extends ListRecords
{
    use HasPrefixedBreadcrumb;

    protected static string $resource = ValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            SyncAction::make(),
            CreateAction::make(),
        ];
    }
}
