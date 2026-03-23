<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;
class TeacherInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Teacher Information')
                ->icon('heroicon-o-identification')
                ->description('Academic and professional details of the faculty member.')
                ->schema([
                    Grid::make(3)
                        ->schema([
                            TextEntry::make('name')
                                ->label('Teacher Name')
                                ->weight('bold')
                                ->color('primary')
                                ->size('lg')
                                ->icon('heroicon-m-user'),

                            TextEntry::make('designation')
                                ->label('Designation')
                                ->badge()
                                ->color(fn (string $state): string => match (strtolower($state)) {
                                    'chief instructor' => 'danger',
                                    'instructor' => 'success',
                                    'junior instructor' => 'info',
                                    default => 'warning',
                                })
                                ->icon('heroicon-m-briefcase'),

                            TextEntry::make('subjects.name')
                                ->label('Assigned Subjects')
                                ->badge()
                                ->color('success')
                                ->icon('heroicon-m-book-open')
                                ->placeholder('N/A'),
                        ]),

                    Grid::make(3)
                        ->schema([
                            TextEntry::make('email')
                                ->label('Email Address')
                                ->icon('heroicon-m-envelope')
                                ->copyable()
                                ->color('gray'),

                            TextEntry::make('phone')
                                ->label('Phone Number')
                                ->icon('heroicon-m-phone')
                                ->copyable(),

                            TextEntry::make('initial')
                                ->label('Teacher Initial')
                                ->badge()
                                ->color('gray'),
                        ]),
                ]),

            Section::make('Account Details')
                ->collapsed()
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextEntry::make('created_at')
                                ->label('Joining Date')
                                ->dateTime('d M, Y h:i A'),

                            TextEntry::make('updated_at')
                                ->label('Last Profile Update')
                                ->since(),
                        ]),
                ]),
        ]);
    }
}