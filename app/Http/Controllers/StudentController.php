<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use App\Models\DataLayer;

class StudentController extends Controller
{
    public function index()
    {
        $dl = new DataLayer();
        $student = $dl->getStudentID($_SESSION['loggedName']);
        $enrolledCourses = $dl->listCoursesForStudent($student);
        return view('student.index')->with('loggedName', $_SESSION['loggedName'])->
                with('user_type', $_SESSION['user_type'])->with('logged', $_SESSION['logged'])->with('enrolledCourses', $enrolledCourses);
    }

    public function show()
    {
        return view('student.show')->with('loggedName', $_SESSION['loggedName'])->with('user_type', $_SESSION['user_type'])->with('logged', $_SESSION['logged']);
    }

    public function studentDetails($id)
    {
        $dl = new DataLayer();
        $student = $dl->getStudent($id);
        if ($student == null) {
            return redirect()->route('pagenotfound');
        }
        
        return view('professor.studentdetails')->with('student', $student)->with('loggedName', $_SESSION['loggedName'])->with('user_type', $_SESSION['user_type'])->with('logged',$_SESSION['logged']);

    }

    public function settings()
    {
        $dl = new DataLayer();
        $student = $dl->getStudent($dl->getStudentID($_SESSION['loggedName']));
        if ($student == null) {
            return redirect()->route('pagenotfound');
        }
        return view('student.settings')->with('student', $student)->with('loggedName', $_SESSION['loggedName'])->
                with('user_type', $_SESSION['user_type'])->with('logged', $_SESSION['logged']);
    }

    public function update(Request $request, $id)
    {
        $dl = new DataLayer();
        $student = $dl->getStudent($id);
        if ($student == null) {
            return redirect()->route('pagenotfound');
        }
        $oldUsername = $student->username;
        $oldEmail = $student->email;

        if ($dl->getStudentID($_SESSION['loggedName']) != $id) {
            return redirect()->route('user.accessdenied');
        }

        try {

            $request->validate([
                'username' => [
                    'required',
                    'unique:professor,username',
                    function ($attribute, $value, $fail) use ($oldUsername, $id) {
                        if ($value !== $oldUsername && $dl->checkExistence('student', 'username', $value)) {
                            $fail(':attribute must be unique.');
                        }
                    },
                ],

                'email' => [
                    'required',
                    'email',
                    'unique:professor,email',
                    function ($attribute, $value, $fail) use ($oldEmail, $id) {
                        if ($value !== $oldEmail && $dl->checkExistence('student', 'email', $value)) {
                            $fail(':attribute must be unique.');
                        }
                    },
                ],
            ]);

            $dl->updateStudent($id, $request->name, $request->surname, $request->username, $request->email);
            $_SESSION['loggedName'] = $request->username;

            return redirect()->route('student.settings');
        }
        catch (ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->getMessages();
            foreach ($errorMessages as $attribute => $messages) {
                foreach ($messages as $message) {
                    $translatedMessage = trans('validation.' . $message);
                }
            }
            return Redirect::to(route('student.settings'))->withInput()->withErrors($errorMessages);
        } 
    }


    public function passwordUpdate(Request $request, $id){
        $dl = new DataLayer();
        $student= $dl->getStudent($id);
        if ($student == null) {
            return redirect()->route('pagenotfound');
        }

        if ($dl->getStudentID($_SESSION['loggedName']) != $id) {
            return redirect()->route('user.accessdenied');
        }

        $oldPassword = $student->password;
        if($oldPassword != md5($request->oldpassword)){
            $message=['oldpassword' => trans('validation.password_old')];
            return Redirect::to(route('student.settings'))->withInput()->withErrors($message);
        }

        try{
            $request -> validate([
                'password' => 'required|min:8',
                'password-confirmation' => 'required|same:password'
            ]);

            $dl->updateStudentPassword($id, $request->password);
            return redirect()->route('student.settings');
        }
        catch (ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->getMessages();
            foreach ($errorMessages as $attribute => $messages) {
                foreach ($messages as $message) {
                    $translatedMessage = trans('validation.' . $message);
                }
            }
            return Redirect::to(route('student.settings'))->withInput()->withErrors($errorMessages);
        } 

    }


    public function destroy($id)
    {
        $dl = new DataLayer();
        $student = $dl->getStudent($id);
        if ($student == null) {
            return redirect()->route('pagenotfound');
        }

        if ($dl->getStudentID($_SESSION['loggedName']) != $id) {
            return redirect()->route('user.accessdenied');
        }

        $dl->deleteStudentFromPivot($id);
        $dl->deleteStudent($id);

        session_destroy();

        return redirect()->route('home');
    }

}
