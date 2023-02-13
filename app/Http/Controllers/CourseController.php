<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class CourseController extends Controller
{
    public function index()
    {
        $dl = new DataLayer();
        $studentID = $dl->getStudentID($_SESSION["loggedName"]);
        //$professorID = $dl->getStudentID($_SESSION["loggedName"]);

        $courses_student = $dl->listCoursesForStudent($studentID);
        //$courses_professor = $dl->listCoursesForProfessor($professorID);

        if(count($courses_student)==0){
            return view('course.courseBootstrap')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])
            ->with('CoursesList', $courses_professor);
        }
        else{
            return view('course.courseBootstrap')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])
            ->with('CoursesList', $courses_student);
        }
        
    }

    public function courseDetailsStudent($id){
        $dl = new DataLayer();
        $course = $dl->getCourse($id);
        if($course == null){
            return redirect()->route('pagenotfound');
        }
        $professor = $dl->getProfessor($course->professor_id);
        $student = $dl->getStudent($dl->getStudentID($_SESSION["loggedName"]));

        return view('student.coursedetails', [
            'course' => $course,
            'professor' => $professor,
            'student' => $student,
        ])->with('loggedName', $_SESSION['loggedName'])->
        with('user_type', $_SESSION['user_type'])->with('logged', $_SESSION['logged']);

    }

    public function courseDetailsProfessor($id){
        $dl = new DataLayer();
        $course = $dl->getCourse($id);
        if ($course == null) {
            return redirect()->route('pagenotfound');
        }
        $enrolledStudents = $dl->listStudentsForCourses($id);
        $professor = $dl->getProfessor($course->professor_id);

        return view('professor.coursedetails', [
            'course' => $course,
            'professor' => $professor,
            'enrolledStudents' => $enrolledStudents,
        ])->with('loggedName', $_SESSION['loggedName'])->
        with('user_type', $_SESSION['user_type'])->with('logged', $_SESSION['logged']);
    }

    public function create(){
        return view('course.createcourse')->with('loggedName', $_SESSION['loggedName'])->
        with('user_type', $_SESSION['user_type'])->with('logged', $_SESSION['logged']);
    }

    public function store(Request $request){
        $dl = new DataLayer();
        $professor = $dl->getProfessorID($_SESSION["loggedName"]);
        $course = $dl->addCourse($request->title, $request->macroarea, $request->info, $professor);
        return redirect()->route('professor.index');
    }

    public function destroyCourse($id){
        $dl = new DataLayer();

        if ($dl->getCourse($id) == null) {
            return redirect()->route('pagenotfound');
        }

        if ($dl->getCourse($id)->professor_id !== $dl->getProfessorID($_SESSION["loggedName"])){ 
            return redirect()->route('user.accessdenied');
        }

        $dl->deleteCourseFromPivot($id);
        $dl->deleteCourse($id);

        return redirect()->route('professor.index');
    }

    public function researchCourse(Request $request){
        $dl = new DataLayer();
        $keyword = $request->q;
        $search_type = $request->search_type;
        

        if($search_type == "macroarea"){
            $courses = $dl->listCoursesMacroarea($request->macroarea);
            if($keyword){
                $courses = $dl->listCoursesWithSearch($keyword, 'title');
            }
        }
        else{
            $courses = $dl->listCourses();
            if($keyword){
                $courses = $dl->listCoursesWithSearch($keyword, $search_type);
            }
        }

        return view('course.researchcourse')->with('loggedName', $_SESSION['loggedName'])->
            with('user_type', $_SESSION['user_type'])->with('logged', $_SESSION['logged'])-> with('courses', $courses);
    }
    
    public function subscribe($id){
        $dl = new DataLayer();
        if ($dl->getCourse($id) == null) {
            return redirect()->route('pagenotfound');
        }
        $studentID = $dl->getStudentID($_SESSION["loggedName"]);
        $dl->subscribe($id, $studentID);
        return redirect()->route('student.index');
    }

    public function unsubscribe($id){
        $dl = new DataLayer();
        if ($dl->getCourse($id) == null) {
            return redirect()->route('pagenotfound');
        }
        $studentID = $dl->getStudentID($_SESSION["loggedName"]);
        $dl->unsubscribe($id, $studentID);
        return redirect()->route('student.index');
    }

    public function update(Request $request, $id){
        $dl = new DataLayer();

        if ($dl->getCourse($id) == null) {
            return redirect()->route('pagenotfound');
        }

        if ($dl->getProfessorID($_SESSION['loggedName']) != $dl->getCourse($id)->professor_id) {
            return Redirect::to(route('user.accessdenied'));
        }

        $dl->updateCourse($id, $request->title, $request->macroarea, $request->info, $dl->getCourse($id)->professor_id);
        return redirect()->route('professor.index');
    }

    public function edit($id){
        $dl = new DataLayer();
        $course = $dl->getCourse($id);
        if ($course == null) {
            return redirect()->route('pagenotfound');
        }
        return view('course.editcourse')->with('loggedName', $_SESSION['loggedName'])->
        with('user_type', $_SESSION['user_type'])->with('logged', $_SESSION['logged'])->with('course', $course);
    }

}
