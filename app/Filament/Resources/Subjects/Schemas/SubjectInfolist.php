<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

use Filament\Infolists\Components\TextEntry;

class SubjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Subject Details')
                    ->icon('heroicon-o-book-open')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Subject Name')
                                    ->weight('bold')
                                    ->color('primary'),

                                TextEntry::make('subject_code')
                                    ->label('Subject Code')
                                    ->badge()
                                    ->color('info'),

                                TextEntry::make('credit')
                                    ->label('Credit')
                                    ->numeric()
                                    ->badge()
                                    ->color('success'),
                            ]),
                        TextEntry::make('departments.name')
                            ->label('Offered Departments')
                            ->badge()
                            ->color('warning')
                            ->separator(',')
                            ->placeholder('No departments assigned')
                            ->extraAttributes(['style' => 'border-bottom: 1px solid #ccc; padding-bottom: 15px;']),
                        TextEntry::make('teachers.name')
                            ->label('Teachers Name')
                            ->badge()
                            ->color('info')
                            ->separator(',')
                            ->placeholder('No departments assigned'),
                    ]),

                Section::make('Timestamps')
                    ->collapsed()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Added At')
                                    ->dateTime('d M, Y h:i A'),
                                    
                                TextEntry::make('updated_at')
                                    ->label('Last Modified')
                                    ->dateTime('d M, Y h:i A'),
                            ]),
                    ]),
            ]);
    }
}