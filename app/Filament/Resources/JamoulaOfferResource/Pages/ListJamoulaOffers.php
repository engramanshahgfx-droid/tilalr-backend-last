<?php

namespace App\Filament\Resources\JamoulaOfferResource\Pages;

use App\Filament\Resources\JamoulaOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJamoulaOffers extends ListRecords
{
    protected static string $resource = JamoulaOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
