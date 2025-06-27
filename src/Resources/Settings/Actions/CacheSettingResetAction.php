<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Actions;

use Betta\Filament\FqnSettings\Resources\Settings\Actions\Concerns\CanResetCachedValue;
use Filament\Actions\Action;

class CacheSettingResetAction extends Action
{
    use CanResetCachedValue;
}
