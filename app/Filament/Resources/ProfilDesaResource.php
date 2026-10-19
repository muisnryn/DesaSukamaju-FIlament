<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilDesaResource\Pages;
use App\Filament\Resources\ProfilDesaResource\RelationManagers;
use App\Models\ProfilDesa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;

class ProfilDesaResource extends Resource
{
    protected static ?string $model = ProfilDesa::class;

    // REVISI: Menggunakan ikon home-modern untuk merepresentasikan profil wilayah/kantor desa
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Profil Desa')
                    ->tabs([
                        Tabs\Tab::make('Sejarah & Visi')
                            ->schema([
                                RichEditor::make('sejarah')->required(),
                                RichEditor::make('visi')->required(),
                                RichEditor::make('misi')->required(),
                            ]),
                        Tabs\Tab::make('Wilayah & Peta')
                            ->schema([
                                Textarea::make('iframe_peta')
                                    ->helperText('Tempelkan kode iframe dari Google Maps di sini'),
                                RichEditor::make('deskripsi_wilayah'),
                            ]),
                    ])->columnSpanFull()
            ]);
    }

    public static function canCreate(): bool
    {
        return \App\Models\ProfilDesa::count() < 1;
    }

   public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('sejarah')
                    ->limit(50) 
                    ->html()    
                    ->label('Cuplikan Sejarah'),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d M Y H:i') 
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListProfilDesas::route('/'),
            'create' => Pages\CreateProfilDesa::route('/create'),
            'edit' => Pages\EditProfilDesa::route('/{record}/edit'),
        ];
    }
}