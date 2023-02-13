<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\DataLayer;
use App\Models\Professor;
use App\Models\Student;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'username' => 'giovanni',
            'email' => 'g.baselli@unibs.it',
            'password' => md5('baselli'),
            'name' => 'Giovanni',
            'surname' => 'Baselli'
        ]);

        Professor::create([
            'username' => 'devis',
            'email' => 'devis.bianchini@unibs.it',
            'password' => md5('bianchini')
        ]);

        $dl = new DataLayer();
        $student1 = $dl->getStudentID('giovanni');
        $professor1 = $dl->getProfessorID('devis');

        //10 corsi per il professore
        Course::factory()->count(10)->create(['professor_id' => $professor1]);
        
        Student::factory()->count(5)->create();
        $courses = Course::all();

        Student::all()->each(function ($student) use ($courses) { 
            $student->courses()->attach(
                $courses->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });


    }
}
