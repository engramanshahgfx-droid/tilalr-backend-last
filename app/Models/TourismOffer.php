<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismOffer extends Model
{
    use HasFactory;

    protected $table = 'tourism_offers';

    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'long_description_en',
        'long_description_ar',
        'slug',
        'image',
        'gallery',
        'price',
        'original_price',
        'discount',
        'rating',
        'duration_en',
        'duration_ar',
        'location_en',
        'location_ar',
        'group_size_en',
        'group_size_ar',
        'features_en',
        'features_ar',
        'includes_en',
        'includes_ar',
        'not_includes_en',
        'not_includes_ar',
        'itinerary_en',
        'itinerary_ar',
        'basic_info',
        'contact_info',
        'payment_methods',
        'type',
        'active',
        'popular',
        'limited',
        'region',
        'country',
        'city',
        'meta_title_en',
        'meta_title_ar',
        'meta_description_en',
        'meta_description_ar',
        'meta_keywords_en',
        'meta_keywords_ar',
    ];

    protected $casts = [
        'gallery' => 'array',
        'features_en' => 'array',
        'features_ar' => 'array',
        'includes_en' => 'array',
        'includes_ar' => 'array',
        'not_includes_en' => 'array',
        'not_includes_ar' => 'array',
        'itinerary_en' => 'array',
        'itinerary_ar' => 'array',
        'basic_info' => 'array',
        'contact_info' => 'array',
        'payment_methods' => 'array',
        'active' => 'boolean',
        'popular' => 'boolean',
        'limited' => 'boolean',
    ];

    private function decodeJsonArray($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }

        return [];
    }

    private function prepareJsonValue($value): ?string
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $value;
            }
        }

        if (is_array($value) || is_object($value)) {
            return json_encode($value);
        }

        return null;
    }

    public function getBasicInfoAttribute($value): array
    {
        return $this->decodeJsonArray($value);
    }

    public function setBasicInfoAttribute($value): void
    {
        $this->attributes['basic_info'] = $this->prepareJsonValue($value);
    }

    public function getContactInfoAttribute($value): array
    {
        return $this->decodeJsonArray($value);
    }

    public function setContactInfoAttribute($value): void
    {
        $this->attributes['contact_info'] = $this->prepareJsonValue($value);
    }

    public function getPaymentMethodsAttribute($value): array
    {
        return $this->decodeJsonArray($value);
    }

    public function setPaymentMethodsAttribute($value): void
    {
        $this->attributes['payment_methods'] = $this->prepareJsonValue($value);
    }
}
