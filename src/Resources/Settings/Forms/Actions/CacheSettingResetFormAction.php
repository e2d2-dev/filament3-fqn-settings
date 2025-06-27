<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Forms\Actions;

use Betta\Filament\FqnSettings\Resources\Settings\Actions\Concerns\CanResetCachedValue;
use Filament\Forms\Components\Actions\Action;

class CacheSettingResetFormAction extends Action
{
    use CanResetCachedValue;
}
