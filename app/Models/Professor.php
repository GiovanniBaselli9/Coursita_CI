<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = "professor";
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['username', 'password', 'email', 'name', 'surname', 'career'];

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
