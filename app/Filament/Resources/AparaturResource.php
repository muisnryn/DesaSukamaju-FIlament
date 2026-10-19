<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AparaturResource\Pages;
use App\Filament\Resources\AparaturResource\RelationManagers;
use App\Models\Aparatur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class AparaturResource extends Resource
{
    protected static ?string $model = Aparatur::class;

    // REVISI: Ikon diganti menjadi grup pengguna agar lebih profesional
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Aparatur Desa')
                ->schema([
                    TextInput::make('nama')
                        ->required()
                        ->placeholder('Nama Lengkap beserta Gelar'),
                    
                    TextInput::make('jabatan')
                        ->required()
                        ->placeholder('Contoh: Kepala Desa / Sekretaris Desa'),
                    
                    FileUpload::make('foto')
                        ->image() 
                        ->directory('aparatur') 
                        ->disk('public') 
                        ->required(),
                    
                    TextInput::make('urutan')
                        ->numeric()
                        ->default(0)
                        ->helperText('Angka lebih kecil akan muncul di urutan teratas (misal: Kades diisi 1)'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->circular()
                    ->disk('public'),
                
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('jabatan')
                    ->badge()
                    ->color('success'),
                
                TextColumn::make('urutan')
                    ->sortable()
                    ->label('Posisi'),
            ])
            ->defaultSort('urutan', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAparaturs::route('/'),
            'create' => Pages\CreateAparatur::route('/create'),
            'edit' => Pages\EditAparatur::route('/{record}/edit'),
        ];
    }
}