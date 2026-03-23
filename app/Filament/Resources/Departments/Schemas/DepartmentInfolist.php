<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

use Filament\Infolists\Components\TextEntry;


class DepartmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Department Overview')
                    ->description('General information about the technology department.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Technology Name')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-m-bookmark'),
                                TextEntry::make('code')
                                    ->label('Tech Code')
                                    ->badge()
                                    ->color('warning')
                                    ->icon('heroicon-m-hashtag'),
                                TextEntry::make('name')
                                    ->label('Short Form')
                                    ->badge()
                                    ->color('info')
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'CIVIL TECHNOLOGY' => 'CT',
                                        'ELECTRICAL TECHNOLOGY' => 'ET',
                                        'ELECTRONICS TECHNOLOGY' => 'ENT',
                                        'MECHANICAL TECHNOLOGY' => 'MT',
                                        'POWER TECHNOLOGY' => 'PT',
                                        'COMPUTER SCIENCE & TECHNOLOGY' => 'CST',
                                        'ELECTROMEDICAL TECHNOLOGY' => 'EMT',
                                        default => 'DEPT',
                                    }),
                            ]),
                    ]),
                Section::make('System Logs')
                    ->collapsed()
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Created On')
                                    ->dateTime('d M, Y h:i A')
                                    ->placeholder('-'),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->since()
                                    ->color('gray')
                                    ->placeholder('-'),
                            ]),
                    ]),
            ]);
    }
}