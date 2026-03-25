<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->required(),
                
            TextInput::make('roll_no')
                ->required(),
                
            TextInput::make('reg_no')
                ->required(),
                
            Select::make('shift')
                ->options(['1' => '1st', '2' => '2nd'])
                ->default(fn () => auth()->user()->student?->shift) 
                ->disabled(fn () => auth()->user()->hasRole('captain'))
                ->dehydrated()
                ->required(),

            Select::make('semester')
                ->options([1 => '1st', 2 => '2nd', 3 => '3rd', 4 => '4th', 5 => '5th', 6 => '6th', 7 => '7th', 8 => '8th'])
                ->default(fn () => auth()->user()->student?->semester)
                ->disabled(fn () => auth()->user()->hasRole('captain')) 
                ->dehydrated(),

            Select::make('section')
                ->options(['A' => 'A', 'B' => 'B'])
                ->default(fn () => auth()->user()->student?->section)
                ->disabled(fn () => auth()->user()->hasRole('captain'))
                ->dehydrated(),

            Select::make('department_id')
                ->relationship('department', 'name')
                ->default(fn () => auth()->user()->student?->department_id) 
                ->disabled(fn () => auth()->user()->hasRole('captain'))
                ->dehydrated()
                ->required(),
            Select::make('student_role')
                ->options([
                    'general' => 'General',
                    'captain' => 'Captain',
                ])
                ->default('general')
                ->disabled(fn () => auth()->user()->hasRole('captain'))
                ->dehydrated()
                ->required(),
            TextInput::make('phone_number')->tel(),
            TextInput::make('email')->email(),
            TextInput::make('portfolio')->url(),
            TextInput::make('cgpa')
                ->numeric()
                ->mask('9.99')
                ->placeholder('0.00')
                ->label('CGPA')
                ->disabled(fn ($record) => $record !== null && $record->cgpa !== null) 
                ->dehydrated()
        ]);
    }
}
