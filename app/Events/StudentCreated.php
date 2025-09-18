<?php

namespace App\Events;

use App\Models\Student;
use Illuminate\Foundation\Events\Dispatchable;

class StudentCreated
{
    use Dispatchable;

    public function __construct(public Student $student)
    {
    }
}