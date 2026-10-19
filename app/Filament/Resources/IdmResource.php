<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IdmResource\Pages;
use App\Models\Idm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class IdmResource extends Resource
{
    protected static ?string $model = Idm::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

    protected static ?string $navigationLabel = 'IDM';

    protected static ?string $navigationGroup = 'Infografis Desa';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tahun')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue(date('Y') + 1) // +1 agar bisa input rencana tahun depan
                    ->unique(ignoreRecord: true),
                
                TextInput::make('status_idm')
                    ->required()
                    ->label('Status IDM')
                    ->placeholder('Contoh: Mandiri, Maju, Berkembang'),

                TextInput::make('skor_idm')
                    ->required()
                    ->numeric()
                    ->label('Skor IDM (Total)')
                    ->rules(['regex:/^\d{1,1}(\.\d{1,4})?$/'])
                    ->helperText('Gunakan titik (.) sebagai koma. Contoh: 0.7812'),

                TextInput::make('skor_iks')
                    ->required()
                    ->numeric()
                    ->label('Skor IKS (Sosial)')
                    ->rules(['regex:/^\d{1,1}(\.\d{1,4})?$/']),

                TextInput::make('skor_ike')
                    ->required()
                    ->numeric()
                    ->label('Skor IKE (Ekonomi)')
                    ->rules(['regex:/^\d{1,1}(\.\d{1,4})?$/']),

                TextInput::make('skor_ikl')
                    ->required()
                    ->numeric()
                    ->label('Skor IKL (Lingkungan)')
                    ->rules(['regex:/^\d{1,1}(\.\d{1,4})?$/']),

                // Menggunakan Textarea cocok jika tipe data di database adalah STRING/TEXT
                Textarea::make('indikator')
                    ->label('Keterangan / Indikator')
                    ->nullable() // PENTING: Agar tidak error jika dikosongkan
                    ->rows(3)
                    ->helperText('Masukkan catatan singkat mengenai indikator jika ada.')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tahun')
                    ->sortable()
                    ->searchable()
                    ->label('Tahun'),
                
                TextColumn::make('status_idm')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Mandiri' => 'success',
                        'Maju' => 'info',
                        'Berkembang' => 'warning',
                        'Tertinggal' => 'danger',
                        default => 'gray',
                    })
                    ->label('Status'),

                TextColumn::make('skor_idm')
                    ->label('Skor Total'),
                
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('tahun', 'desc')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIdms::route('/'),
            'create' => Pages\CreateIdm::route('/create'),
            'edit' => Pages\EditIdm::route('/{record}/edit'),
        ];
    }
}