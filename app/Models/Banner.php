<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'background_image',
        'sentence_en',
        'sentence_ar',
        'button_text_en',
        'button_text_ar',
        'url',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
