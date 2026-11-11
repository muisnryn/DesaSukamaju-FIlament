<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'address',
        'phone',
        'whatsapp_number',
        'email',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'tiktok_url',
    ];

    public function whatsappUrl(): ?string
    {
        $number = preg_replace('/\D+/', '', (string) $this->whatsapp_number);

        if ($number === '') {
            return null;
        }

        if (str_starts_with($number, '0')) {
            $number = '62'.substr($number, 1);
        } elseif (! str_starts_with($number, '62')) {
            $number = '62'.$number;
        }

        return "https://wa.me/{$number}";
    }

    public function phoneUrl(): ?string
    {
        $number = preg_replace('/[^\d+]/', '', (string) $this->phone);

        return $number === '' ? null : "tel:{$number}";
    }
}
