<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;

class StudentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // 🔷 MAIN INFO
                Section::make('Student Overview')
                    ->description('Personal & academic snapshot')
                    ->icon('heroicon-o-user-circle')
                    ->columns(1)
                    ->schema([

                        Grid::make(1)
                            ->schema([
                                TextEntry::make('name')
                                    ->hiddenLabel()
                                    ->weight(FontWeight::SemiBold)
                                    ->size('lg')
                                    ->color('primary')
                                    ->icon('heroicon-m-user'),
                            ]),
                        Grid::make(4)
                            ->schema([
                                TextEntry::make('roll_no')
                                    ->label('Roll No')
                                    ->copyable()
                                    ->badge()
                                    ->color('info')
                                    ->icon('heroicon-m-hashtag'),

                                TextEntry::make('reg_no')
                                    ->label('Registration')
                                    ->copyable()
                                    ->badge()
                                    ->color('gray'),
                                TextEntry::make('semester')
                                    ->label('Semester')
                                    ->badge()
                                    ->color('warning')
                                    ->formatStateUsing(fn ($state) => match ($state) {
                                        1 => '1st',
                                        2 => '2nd',
                                        3 => '3rd',
                                        4 => '4th',
                                        5 => '5th',
                                        6 => '6th',
                                        7 => '7th',
                                        8 => '8th',
                                        default => $state,
                                    }),
                                TextEntry::make('section')
                                    ->label('Section')
                                    ->badge()
                                    ->color('gray'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextEntry::make('department.name')
                                    ->label('Department')
                                    ->badge()
                                    ->icon('heroicon-m-building-office')
                                    ->color(fn (string $state): string => match ($state) {
                                        'CIVIL TECHNOLOGY' => 'info',
                                        'ELECTRICAL TECHNOLOGY' => 'warning',
                                        'ELECTRONICS TECHNOLOGY' => 'danger',
                                        'MECHANICAL TECHNOLOGY' => 'success',
                                        'POWER TECHNOLOGY' => 'black',
                                        'COMPUTER SCIENCE & TECHNOLOGY' => 'primary', 
                                        'ELECTROMEDICAL TECHNOLOGY' => 'gray',
                                        default => 'primary',
                                    }),
                                TextEntry::make('shift')
                                    ->label('Shift')
                                    ->badge()
                                    ->color('purple')
                                    ->formatStateUsing(fn ($state) =>
                                        $state == '1' ? 'Morning' : 'Evening'
                                    ),
                            ]),
                    ]),

                //  ACADEMIC RESULTS
                Section::make('Academic Results')
                    ->description('Recent performance overview')
                    ->icon('heroicon-o-academic-cap')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('cgpa')
                            ->label('Current CGPA')
                            ->badge()
                            ->color(fn (string $state): string => 
                                floatval($state) >= 3.50 ? 'success' : 'warning'
                            ),
                            
                        TextEntry::make('status')
                            ->label('Academic Status')
                            ->badge()
                            ->color('info'),
                    ]),
                // 📞 CONTACT INFO
                Section::make('Contact Information')
                    ->description('How to reach the student')
                    ->icon('heroicon-o-phone')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('phone_number')
                            ->label('Mobile Number')
                            ->icon('heroicon-m-phone')
                            ->copyable()
                            ->color('success'),

                        TextEntry::make('email')
                            ->label('Email Address')
                            ->icon('heroicon-m-envelope')
                            ->copyable()
                            ->color('info'),

                        TextEntry::make('portfolio')
                            ->label('Portfolio Site')
                            ->icon('heroicon-m-globe-alt')
                            ->url(fn ($state) => $state)
                            ->openUrlInNewTab()
                            ->color('primary')
                            ->placeholder('No portfolio link'),
                    ]),

                // ⏱ TIMESTAMPS
                Section::make('Activity')
                    ->icon('heroicon-o-clock')
                    ->collapsed()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Created')
                                    ->dateTime('d M Y, h:i A')
                                    ->color('success')
                                    ->icon('heroicon-m-check-circle')
                                    ->placeholder('-'),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->dateTime('d M Y, h:i A')
                                    ->color('warning')
                                    ->icon('heroicon-m-arrow-path')
                                    ->placeholder('-'),
                            ]),
                    ]),
            ]);
    }
}