<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Student;
use App\Models\Professor;
use App\Models\CourseStudent;

class DataLayer 
{
    public function listCourses() {
        $courses = Course::orderBy('title','asc')->paginate(10);
        return $courses;
    }

    public function listCoursesWithSearch($word, $search_type) {
        $courses = Course::where($search_type,'like','%'.$word.'%')->orderBy($search_type,'asc')->paginate(10);
        return $courses;
    }

    public function listCoursesMacroarea($macroarea) {
        $courses = Course::where('macroarea',$macroarea)->orderBy('title','asc')->paginate(10);
        return $courses;
    }

    public function listCoursesForStudent($student){
        $courses = Course::whereHas('students', function($q) use ($student) {
            $q->where('student_id', $student);
        })->orderBy('title','asc')->paginate(5);
        return $courses;
    }

    public function listStudentsForCourses($course){
        $students = Student::whereHas('courses', function($q) use ($course) {
            $q->where('course_id', $course);
        })->orderBy('username','asc')->paginate(5);
        return $students;
    }

    public function checkCompleted($course, $student) {
        $completed = CourseStudent::where('course_id', $course)->where('student_id', $student)->get(['completed']);
        return $completed[0]->completed;
    }

    public function listCoursesForProfessor($professor){
        $courses = Course::where('professor_id', $professor)->orderBy('title','asc')->paginate(5);
        return $courses;
    }

    public function getProfessorID($username) {
        $users = Professor::where('username',$username)->get(['id']);
        return $users[0]->id;
    }

    public function getStudentID($username) {
        $users = Student::where('username',$username)->get(['id']);
        return $users[0]->id;
    }

    public function addStudent($username, $password, $email) {
        Student::create(['username' => $username, 'password' => md5($password), 'email' => $email]);
    }

    public function addProfessor($username, $password, $email) {
        Professor::create(['username' => $username, 'password' => md5($password), 'email' => $email]);
    }

    public function addCourse($title, $macroarea, $info, $professor_id) {
        Course::create(['title' => $title, 'macroarea' => $macroarea, 'info' => $info ,'professor_id' => $professor_id]);
    }

    public function validUser($username, $password, $user_type){
        if ($user_type == 'professor') {
            $user = Professor::where('username',$username)->first();
        } else if ($user_type == 'student') {
            $user = Student::where('username',$username)->first();
        } else {
            return false;
        }

        if ($user && md5($password) == $user->password) {
            return $user_type;
        }

        return false;
        
    }

    public function getCourse($id){
        $course = Course::where('id',$id)->first();
        return $course;
    }

    public function getStudent($id){
        $student = Student::where('id',$id)->first();
        return $student;
    }

    public function getProfessor($id){
        $professor = Professor::where('id',$id)->first();
        return $professor;
    }

    public function deleteCourseFromPivot($course_id){
        $students = $this->listStudentsForCourses($course_id);

        foreach($students as $student){
            CourseStudent::where('course_id',$course_id)->where('student_id',$student->id)->delete();
        }
    }

    public function deleteCourse($id){
        Course::where('id',$id)->delete();
    }

    public function deleteStudentFromPivot($student_id){
        $courses = $this->listCoursesForStudent($student_id);

        foreach($courses as $course){
            CourseStudent::where('course_id',$course->id)->where('student_id',$student_id)->delete();
        }
    }


    public function deleteStudent($id){
        Student::where('id',$id)->delete();
    }

    public function deleteProfessor($id){
        Professor::where('id',$id)->delete();
    }

    public function updateCourse($id, $title, $macroarea, $info, $professor_id){
        Course::where('id',$id)->update(['title' => $title, 'macroarea' => $macroarea, 'info' => $info, 'professor_id' => $professor_id]);
    }

    public function updateProfessor($id, $name, $surname, $career, $username, $email){
        Professor::where('id',$id)->update(['name' => $name, 'surname' => $surname, 'career' => $career, 'username' => $username, 'email' => $email]);
    }

    public function updateProfessorPassword($id, $password){
        Professor::where('id',$id)->update(['password' => md5($password)]);
    }

    public function updateStudent($id, $name, $surname, $username, $email){
        Student::where('id',$id)->update(['name' => $name, 'surname' => $surname, 'username' => $username, 'email' => $email]);
    }

    public function updateStudentPassword($id, $password){
        Student::where('id',$id)->update(['password' => md5($password)]);
    }

    public function subscribe($course_id, $student_id){
        CourseStudent::create(['course_id' => $course_id, 'student_id' => $student_id, 'completed' => false]);
    }

    public function unsubscribe($course_id, $student_id){
        CourseStudent::where('course_id',$course_id)->where('student_id',$student_id)->delete();
    }

    public function checkExistence($user_type, $feature, $value){
        if ($user_type == 'student') {
            return Student::where($feature, $value)->exists();
        } else if ($user_type == 'professor') {
            return Professor::where($feature, $value)->exists();
        }
    }

}


