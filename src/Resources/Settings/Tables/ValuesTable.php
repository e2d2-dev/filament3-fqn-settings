<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Tables;

use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\EncryptColumn;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\FqnColumn;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\KeyColumn;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\LostColumn;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\TypeColumn;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\Columns\ValueColumn;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Table;

class ValuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                EncryptColumn::make('encrypt'),
                TypeColumn::make('type'),
                KeyColumn::make('key'),
                ValueColumn::make('value'),
                FqnColumn::make('fqn'),
                LostColumn::make('lost_at'),
            ])
            ->headerActions([
                DeleteBulkAction::make(),
            ])
            ->filters([
                //
            ]);
    }
}
