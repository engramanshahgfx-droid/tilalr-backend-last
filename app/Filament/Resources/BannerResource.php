<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $label = 'Banner';
    protected static ?string $pluralLabel = 'Banners';

    public static function canCreate(): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Banner Content')
                    ->schema([
                        FileUpload::make('background_image')
                            ->label('Background Image')
                            ->image()
                            ->directory('banners')
                            ->visibility('public')
                            ->nullable()
                            ->maxSize(5120)
                            ->helperText('Upload a high resolution image to be used as banner background'),

                        TextInput::make('url')
                            ->label('Redirect URL')
                            ->nullable()
                            ->maxLength(255)
                            ->placeholder('/tousimoffers or https://...'),

                        Toggle::make('active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(1),

                Section::make('Localization (English)')
                    ->schema([
                        TextInput::make('sentence_en')
                            ->label('Banner Text (English)')
                            ->nullable()
                            ->maxLength(255),

                        TextInput::make('button_text_en')
                            ->label('Button Text (English)')
                            ->nullable()
                            ->maxLength(100),
                    ])->columns(2),

                Section::make('Localization (Arabic)')
                    ->schema([
                        TextInput::make('sentence_ar')
                            ->label('Banner Text (Arabic)')
                            ->nullable()
                            ->maxLength(255),

                        TextInput::make('button_text_ar')
                            ->label('Button Text (Arabic)')
                            ->nullable()
                            ->maxLength(100),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('background_image')
                    ->label('Background')
                    ->square()
                    ->width(80),

                TextColumn::make('sentence_en')
                    ->label('Text (EN)')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('sentence_ar')
                    ->label('Text (AR)')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('url')
                    ->label('Redirect URL'),

                ToggleColumn::make('active')
                    ->label('Active'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('active'),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
