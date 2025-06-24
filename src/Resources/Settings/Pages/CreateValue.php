<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Pages;

use Betta\Filament\FqnSettings\Resources\Concerns\HasPrefixedBreadcrumb;
use Betta\Filament\FqnSettings\Resources\ValueResource;
use Filament\Resources\Pages\CreateRecord;

class CreateValue extends CreateRecord
{
    use HasPrefixedBreadcrumb;

    protected static string $resource = ValueResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->saveBoolWhenSelected($data);
    }

    protected function saveBoolWhenSelected(array $data): array
    {
        if($data['type'] == 'bool') {
            $data['value'] = $data['default'] = (bool)$data['hidden_value'];
            $data['encrypt'] = false;
        }

        return $data;
    }
}
