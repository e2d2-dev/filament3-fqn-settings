<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

trait HasContent
{
    public function getFormActionsContentComponent(): Component
    {
        return Actions::make($this->getFormActions())
            ->alignment($this->getFormActionsAlignment())
            ->fullWidth($this->hasFullWidthFormActions())
            ->sticky($this->areFormActionsSticky());
    }

    public function content(Schema $schema): Schema
    {
        $this->registerComponents();

        return $schema
            ->statePath('data')
            ->components([
                Form::make([EmbeddedSchema::make('form')])
                    ->id('form')
                    ->schema([
                        ...$this->beforeSchema(),
                        ...$this->getSchemaComponents(),
                        ...$this->afterSchema(),
                    ])
                    ->columns($this->columns())
                    ->columnSpan($this->columnSpan())
                    ->footer($this->getFormActionsContentComponent()),
            ]);
    }

    public function getFormContentComponent(): Component
    {
        if (! $this->hasFormWrapper()) {
            return Group::make([
                EmbeddedSchema::make('form'),
                $this->getFormActionsContentComponent(),
            ]);
        }

        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler($this->getSubmitFormLivewireMethodName())
            ->footer([
                $this->getFormActionsContentComponent(),
            ]);
    }
}
