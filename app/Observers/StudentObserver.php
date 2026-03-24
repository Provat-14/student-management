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
            
            $user = User::where('name', $targetUserName)->first();

            if ($user) {
                $newPassword = Str::random(10);
                
                $user->update([
                    'email' => $student->email, 
                    'password' => Hash::make($newPassword),
                ]);

                $student->updateQuietly(['user_id' => $user->id]);

                $details = [
                    'name' => $student->name,
                    'section' => "{$student->semester}/{$student->shift}/{$student->section}",
                    'email' => $student->email,
                    'password' => $newPassword
                ];

                Mail::to($student->email)->send(new CaptainLoginDetails($details));
            }
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
