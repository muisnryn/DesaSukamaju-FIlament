<?php

namespace App\Filament\Pages;

use App\Models\ContactSetting as ContactSettingModel;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ContactSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';

    protected static ?string $navigationGroup = 'Informasi Publik';

    protected static ?string $navigationLabel = 'Kontak & Media Sosial';

    protected static ?string $title = 'Kontak & Media Sosial';

    protected static string $view = 'filament.pages.contact-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(
            ContactSettingModel::query()->find(1)?->attributesToArray() ?? []
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Kontak')
                    ->description('Informasi ini ditampilkan di footer dan halaman publik.')
                    ->schema([
                        Textarea::make('address')
                            ->label('Alamat')
                            ->rows(3)
                            ->maxLength(2000)
                            ->columnSpanFull(),
                        TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->maxLength(30),
                        TextInput::make('whatsapp_number')
                            ->label('Nomor WhatsApp')
                            ->tel()
                            ->maxLength(30)
                            ->helperText('Boleh menggunakan format lokal, misalnya 0812..., atau kode negara 62812....'),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Section::make('Media Sosial')
                    ->description('Kosongkan tautan yang tidak ingin ditampilkan.')
                    ->schema([
                        TextInput::make('facebook_url')
                            ->label('Facebook')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('instagram_url')
                            ->label('Instagram')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('youtube_url')
                            ->label('YouTube')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('tiktok_url')
                            ->label('TikTok')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        ContactSettingModel::query()->updateOrCreate(['id' => 1], $data);

        Notification::make()
            ->title('Pengaturan kontak berhasil disimpan')
            ->success()
            ->send();
    }
}
