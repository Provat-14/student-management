<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class ViewStudent extends ViewRecord
{
    protected static string $resource = StudentResource::class;
    public function getHeading(): string|Htmlable
    {
        $record = $this->record;
        $shift = $record->shift;
        $semester = $record->semester;
        $deptMap = [
            65 => 'CT',
            67 => 'ET',
            68 => 'ENT',
            70 => 'MT',
            71 => 'PT',
            85 => 'CST',
            86 => 'EMT',
        ];
        $deptCode = $record->department->code ?? '';
        $deptShortName = $deptMap[$deptCode] ?? ($record->department->initial ?? 'DEPT');

        $section = strtoupper($record->section);

        $title = "{$record->name}__#{$semester}/{$shift}/{$deptShortName}-{$section}";
        return new HtmlString("<span style='color: #fbbf24; font-weight: bold;'>{$title}</span>");
    }
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
