<?php

namespace Betta\Filament\FqnSettings\Pages;

use Betta\Filament\FqnSettings\Pages\Concerns\CanExpandSchema;
use Betta\Filament\FqnSettings\Pages\Concerns\CanSaveSettings;
use Betta\Filament\FqnSettings\Pages\Concerns\HasActions;
use Betta\Filament\FqnSettings\Pages\Concerns\HasColumns;
use Betta\Filament\FqnSettings\Pages\Concerns\HasContent;
use Betta\Filament\FqnSettings\Pages\Concerns\HasFqnSettingComponents;
use Betta\Filament\FqnSettings\Pages\Concerns\HasNavigation;
use Betta\Filament\FqnSettings\Pages\Concerns\HasSettingsSlug;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;

/**
 * @property Schema $content
 */
abstract class SettingPage extends Page implements \Filament\Actions\Contracts\HasActions, HasForms
{
    use CanExpandSchema;
    use CanSaveSettings;
    use HasActions;
    use HasColumns;
    use HasContent;
    use HasFqnSettingComponents;
    use HasNavigation;
    use HasSettingsSlug;

    protected array $settingComponents = [];

    protected string $view = 'filament-panels::pages.page';

    protected static \BackedEnum|null|string $navigationIcon = 'heroicon-o-cog-6-tooth';

    public ?array $data;

    public function mount(): void
    {
        $this->content->fill([
            ...$this->fillAdditionalData(),
            ...$this->getComponentData(),
        ]);
    }
}
