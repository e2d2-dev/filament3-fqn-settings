<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Tables;

use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\EncryptColumn;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\FqnColumn;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\KeyColumn;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\LostColumn;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\NullableColumn;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\TypeColumn;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\ValueColumn;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ValuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                NullableColumn::make('nullable'),
                TypeColumn::make('type'),
                KeyColumn::make('key'),
                EncryptColumn::make('encrypt'),
                ValueColumn::make('value'),
                FqnColumn::make('fqn'),
                LostColumn::make('lost_at'),
            ])
            ->headerActions([
                DeleteBulkAction::make(),
            ])
            ->filters([
                TernaryFilter::make('nullable')
                    ->label(__('filament-fqn-settings::field.Nullable')),

                TernaryFilter::make('encrypt')
                    ->label(__('filament-fqn-settings::field.Encryption')),

                TernaryFilter::make('lost_at')
                    ->label(__('filament-fqn-settings::field.Lost')),

                SelectFilter::make('type')
                    ->label(__('filament-fqn-settings::field.Type'))
                    ->options([
                        'bool' => 'Boolean',
                        'int' => 'Integer',
                        'float' => 'Float',
                        'string' => 'String',
                    ])
            ]);
    }
}
