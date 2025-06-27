<?php

namespace Betta\Filament\FqnSettings\Pages;

use Betta\Filament\FqnSettings\Pages\Concerns\CanExpandSchema;
use Betta\Filament\FqnSettings\Pages\Concerns\CanSaveSettings;
use Betta\Filament\FqnSettings\Pages\Concerns\HasColumns;
use Betta\Filament\FqnSettings\Pages\Concerns\HasForm;
use Betta\Filament\FqnSettings\Pages\Concerns\HasFormActions;
use Betta\Filament\FqnSettings\Pages\Concerns\HasFqnSettingComponents;
use Betta\Filament\FqnSettings\Pages\Concerns\HasNavigation;
use Betta\Filament\FqnSettings\Pages\Concerns\HasSettingsSlug;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

/**
 * @property Form $form
 */
class SettingPage extends Page implements \Filament\Actions\Contracts\HasActions, HasForms
{
    use CanExpandSchema;
    use CanSaveSettings;
    use HasColumns;
    use HasForm;
    use HasFormActions;
    use HasFqnSettingComponents;
    use HasNavigation;
    use HasSettingsSlug;

    protected array $settingComponents = [];

    protected static string $view = 'filament-fqn-settings::filament.pages.page';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    public ?array $data;

    public function mount(): void
    {
        $this->form->fill([
            ...$this->fillAdditionalData(),
            ...$this->getComponentData(),
        ]);
    }
}
