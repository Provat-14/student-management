<?php

namespace App\Observers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CaptainLoginDetails;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "updated" event.
     */
   
    public function updated(Student $student)
    {
        if ($student->wasChanged('student_role') && $student->student_role === 'captain') {
            Student::where('department_id', $student->department_id)
                ->where('semester', $student->semester)
                ->where('shift', $student->shift)
                ->where('section', $student->section)
                ->where('id', '!=', $student->id)
                ->where('student_role', 'captain')
                ->get()
                ->each(function ($oldCaptain) {
                    $oldCaptain->updateQuietly(['student_role' => 'general']);
                });
            $deptMap = [
                65 => 'CT',
                67 => 'ET',
                68 => 'ENT',
                70 => 'MT',
                71 => 'PT',
                85 => 'CST',
                86 => 'EMT',
            ];

            $deptCode = $student->department->code ?? '';
            $deptShortName = $deptMap[$deptCode] ?? ($student->department->initial ?? 'DEPT');
            $targetUserName = "captain-{$student->semester}/{$student->shift}/{$deptShortName}-{$student->section}";
            $newPassword = Str::random(10);
            $user = User::firstOrCreate(
                ['name' => $targetUserName], 
                [
                    'email' => $student->email, 
                    'password' => Hash::make($newPassword),
                ]
            );
            if (!$user->wasRecentlyCreated) {
                $user->update([
                    'email' => $student->email,
                    'password' => Hash::make($newPassword),
                ]);
            }
            $user->assignRole('captain'); 
            $student->updateQuietly(['user_id' => $user->id]);
            $details = [
                'name' => $student->name,
                'section' => "{$student->semester}/{$student->shift}/{$deptShortName}-{$student->section}",
                'email' => $student->email,
                'password' => $newPassword
            ];

            Mail::to($student->email)->send(new CaptainLoginDetails($details));
        }
    }
    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
