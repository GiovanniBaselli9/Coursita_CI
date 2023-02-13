<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "course";
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['title', 'macroarea', 'info', 'professor_id'];

    public function students() {
        return $this->belongsToMany(Student::class, 'course_student', 'course_id', 'student_id');
    }

    public function professor(){
        return $this->belongsTo(Professor::class);
    }
}
