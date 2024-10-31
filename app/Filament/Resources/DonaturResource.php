<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonaturResource\Pages;
use App\Models\Donatur;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class DonaturResource extends Resource
{
    protected static ?string $model = Donatur::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationLabel = 'Donatur';
    
    protected static ?string $slug = 'donatur';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->unique(Donatur::class, 'email'),
                Forms\Components\TextInput::make('telepon')
                    ->nullable()
                    ->maxLength(20),
                Forms\Components\Textarea::make('alamat')
                    ->nullable(),
                Forms\Components\FileUpload::make('foto')
                    ->nullable()
                    ->image(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('telepon')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('foto')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function (Donatur $record) {
                        // Menghapus donatur dan semua donasi yang terkait
                        $record->donasis()->delete(); // Hapus semua donasi terkait
                        $record->delete(); // Hapus donatur
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(function (array $records) {
                        foreach ($records as $record) {
                            $record->donasis()->delete(); // Hapus semua donasi terkait
                            $record->delete(); // Hapus donatur
                        }
                    })
                    ->requiresConfirmation(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonaturs::route('/'),
            'create' => Pages\CreateDonatur::route('/create'),
            'edit' => Pages\EditDonatur::route('/{record}/edit'),
        ];
    }
}
