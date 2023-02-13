<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use App\Models\DataLayer;
use App\Models\Professor;

class ProfessorController extends Controller
{
    // public function __construct()
    // {
    //     session_start();
    //     if(!isset($_SESSION['logged']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'professor'){
    //         return redirect()->intended('/');
    //     }
    // }

    public function index()
    {
        $dl = new DataLayer();
        $professor = $dl->getProfessorID($_SESSION['loggedName']);
        $listCourses = $dl->listCoursesForProfessor($professor);
        return view('professor.index')->with('loggedName', $_SESSION['loggedName'])->
                with('user_type', $_SESSION['user_type'])->with('logged', $_SESSION['logged'])->with('listCourses', $listCourses);
    }

    public function professorDetails($id)
    {
        $dl = new DataLayer();
        
        $professor = $dl->getprofessor($id);
        if ($professor == null) {
            return redirect()->route('pagenotfound');
        }
        
        if($_SESSION['user_type'] == 'professor')
            return view('professor.professordetails', ['professor' => $professor, 'loggedName' => $_SESSION['loggedName'], 'user_type' => $_SESSION['user_type'], 'logged' => $_SESSION['logged']]);
        else{
            return view('student.professordetails', ['professor' => $professor, 'loggedName' => $_SESSION['loggedName'], 'user_type' => $_SESSION['user_type'], 'logged' => $_SESSION['logged']]);
        }
    }

    public function settings()
    {
        $dl = new DataLayer();
        $professor = $dl->getProfessor($dl->getProfessorID($_SESSION['loggedName']));
        if ($professor == null) {
            return redirect()->route('pagenotfound');
        }
        return view('professor.settings')->with('professor', $professor)->with('loggedName', $_SESSION['loggedName'])->
                with('user_type', $_SESSION['user_type'])->with('logged', $_SESSION['logged']);
    }

    public function update(Request $request, $id)
    {
        $dl = new DataLayer();
        $professor= $dl->getProfessor($id);
        if ($professor == null) {
            return redirect()->route('pagenotfound');
        }
        $oldUsername = $professor->username;
        $oldEmail = $professor->email;

        if ($dl->getProfessorID($_SESSION['loggedName']) != $id) {
            return Redirect::to(route('user.accessdenied'));
        }

        try {

            $request->validate([
                'username' => [
                    'required',
                    'unique:student,username',
                    function ($attribute, $value, $fail) use ($oldUsername, $id) {
                        if ($value !== $oldUsername && $dl->checkExistence('professor', 'username', $value)) {
                            $fail(':attribute must be unique.');
                        }
                    },
                ],

                'email' => [
                    'required',
                    'email',
                    'unique:student,email',
                    function ($attribute, $value, $fail) use ($oldEmail, $id) {
                        if ($value !== $oldEmail && $dl->checkExistence('professor', 'email', $value)) {
                            $fail(':attribute must be unique.');
                        }
                    },
                ],
            ]);

            $dl->updateProfessor($id, $request->name, $request->surname, $request->career, $request->username, $request->email);
            $_SESSION['loggedName'] = $request->username;

            return redirect()->route('professor.settings');
        }
        catch (ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->getMessages();
            foreach ($errorMessages as $attribute => $messages) {
                foreach ($messages as $message) {
                    $translatedMessage = trans('validation.' . $message);
                }
            }
            return Redirect::to(route('professor.settings'))->withInput()->withErrors($errorMessages);
        } 
    }

    public function passwordUpdate(Request $request, $id){
        $dl = new DataLayer();
        $professor= $dl->getProfessor($id);
        if ($professor == null) {
            return redirect()->route('pagenotfound');
        }

        if ($dl->getProfessorID($_SESSION['loggedName']) != $id) {
            return Redirect::to(route('user.accessdenied'));
        }

        $oldPassword = $professor->password;
        if($oldPassword != md5($request->oldpassword)){
            $message=['oldpassword' => trans('validation.password_old')];
            return Redirect::to(route('professor.settings'))->withInput()->withErrors($message);
        }

        try{
            $request -> validate([
                'password' => 'required|min:8',
                'password-confirmation' => 'required|same:password'
            ]);

            $dl->updateProfessorPassword($id, $request->password);
            return redirect()->route('professor.settings');
        }
        catch (ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->getMessages();
            foreach ($errorMessages as $attribute => $messages) {
                foreach ($messages as $message) {
                    $translatedMessage = trans('validation.' . $message);
                }
            }
            return Redirect::to(route('professor.settings'))->withInput()->withErrors($errorMessages);
        } 

    }
    
    public function destroy($id)
    {
        $dl = new DataLayer();
        $professor = $dl->getProfessor($id);
        if ($professor == null) {
            return redirect()->route('pagenotfound');
        }

        if ($dl->getProfessorID($_SESSION['loggedName']) != $id) {
            return Redirect::to(route('user.accessdenied'));
        }

        foreach ($dl->listCoursesForProfessor($id) as $course) {
            $dl->deleteCourseFromPivot($course->id);
            $dl->deleteCourse($course->id);
        }

        $dl->deleteProfessor($id);
        session_destroy();
    
        return redirect()->route('home');
    }
    
        

}