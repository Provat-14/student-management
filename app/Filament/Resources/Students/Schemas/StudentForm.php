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

            Select::make('semester')
                ->options([
                    1 => '1st', 2 => '2nd', 3 => '3rd', 4 => '4th',
                    5 => '5th', 6 => '6th', 7 => '7th', 8 => '8th',
                ])
                ->required()
                ->native(false),
                
            Select::make('shift')
                ->options([
                    '1' => '1st',
                    '2' => '2nd',
                ])
                ->required()
                ->native(false),

            Select::make('section')
                ->options([
                    'A' => 'A',
                    'B' => 'B',
                ])
                ->required()
                ->native(false),

            Select::make('department_id')
                ->label('Department')
                ->relationship('department', 'name') 
                ->searchable()
                ->preload() 
                ->required()
                ->native(false),
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
