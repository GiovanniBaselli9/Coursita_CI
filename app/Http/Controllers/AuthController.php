<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function authentication() {
        session_start();
        if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
            return Redirect::to(route('user.accessdenied'));
        }
        return view('auth.auth');
    }

    public function logout() {

        session_start();
        session_destroy();
        return Redirect::to(route('home'));
    }
    
    // public function login(Request $request) {
        
    //     session_start();
    //     $dl = new DataLayer();
        
    //     if ($dl->validUser($request->input('username'), $request->input('password'))) 
    //     {
    //         $_SESSION['logged'] = true;
    //         $_SESSION['loggedName'] = $request->input('username');
    //         return Redirect::to(route('course.index'));

    //     }
       
    //     return view('auth.authErrorPage');
    // }
    
    public function login(Request $request) {
        session_start();
        $dl = new DataLayer();

        $validUser = $dl->validUser($request->username, $request->password, $request->user_type);

        if ($validUser == 'professor'){
            $_SESSION['logged'] = true;
            $_SESSION['loggedName'] = $request->username;
            $_SESSION['user_type'] = 'professor';

            return Redirect::to(route('professor.index'));
        }
        elseif ($validUser == 'student'){
            $_SESSION['logged'] = true;
            $_SESSION['loggedName'] = $request->username;
            $_SESSION['user_type'] = 'student';

            return Redirect::to(route('student.index'));
        }
        else{
            session()->flash('error');
            return Redirect::to(route('user.login'))->withInput();
        }
    }

    public function registration() {
        session_start();
        if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
            return Redirect::to(route('user.accessdenied'));
        }
        return view('auth.registration');
    }

    public function register(Request $request) {
        $dl = new DataLayer();
        $user_type = $request->user_type;

        try {

            $request->validate([
                'username' => 'required|unique:student,username|unique:professor,username',
                'password' => 'required|min:8',
                'email' => 'required|email|unique:student,email|unique:professor,email',
                'password-confirmation' => 'required|same:password'
            ]);

            if ($user_type == 'student'){
                $dl->addStudent($request->input('username'), $request->input('password'), $request->input('email'));
            } else {
                $dl->addProfessor($request->input('username'), $request->input('password'), $request->input('email'));
            }
           
            return Redirect::to(route('user.login'));


        }
        catch (ValidationException $e) {
            $errorMessages = $e->validator->getMessageBag()->getMessages();
            foreach ($errorMessages as $attribute => $messages) {
                foreach ($messages as $message) {
                    $translatedMessage = trans('validation.' . $message);
                }
            }
            return Redirect::to(route('user.register'))->withInput()->withErrors($errorMessages);
        }
        
    }

    // public function registrationProfessor(Request $request) {
    //     $dl = new DataLayer();
        
    //     $dl->addProfessor($request->input('username'), $request->input('password'), $request->input('email'));
       
    //     return Redirect::to(route('user.login'));
    // } 

    public function accessdenied(){
        return view('auth.accessDenied');    
    }

    public function pageNotFound(){
        return view('auth.pageNotFound');    
    }
}
