<?php

namespace App\Filament\Resources\Subjects\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label('Subject Name')
                ->required(),

            TextInput::make('subject_code')
                ->label('Subject Code')
                ->required()
                ->unique(ignoreRecord: true),

            TextInput::make('credit')
                ->numeric()
                ->required(),
            Select::make('departments') 
                ->label('Departments')
                ->multiple()
                ->relationship('departments', 'name') 
                ->searchable()
                ->preload()
                ->required(),
        ]);
    }
}