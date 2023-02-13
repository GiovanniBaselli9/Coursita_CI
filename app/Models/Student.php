<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "student";
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['username', 'password', 'email', 'name', 'surname'];

    public function courses() {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id');
    }
}
