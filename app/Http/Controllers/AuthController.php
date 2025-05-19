<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\DataLayer;


class AuthController extends Controller
{
    public function authentication() {

        return view('auth.auth');
    }
    
    public function login(Request $request) {
        
        session_start();
        $dl = new DataLayer();
        if($dl->validUser($request->input('email'), $request->input('password')))
        {
            $_SESSION['logged'] = true;
            $_SESSION['loggedID'] = $dl->getUserID($request->input('email'));
            $_SESSION['loggedName'] = $dl->getUserName($request->input('email'));
            $_SESSION['role'] = $dl->getUserRole($request->input('email'));
            return Redirect::to(route('home'));
        } else 
        {
            return view('errors.auth')->with('message','Credenziali errate!');
        }
    }

    public function registration(Request $request) {
        $dl = new DataLayer();
        
        $dl->addUser($request->input('name'), $request->input('registration-password'), $request->input('registration-email'));

        session_start();
        $_SESSION['logged'] = true;
        $_SESSION['loggedID'] = $dl->getUserID($request->input('registration-email'));
        $_SESSION['loggedName'] = $dl->getUserName($request->input('registration-email'));
        $_SESSION['role'] = $dl->getUserRole($request->input('registration-email'));

        return Redirect::to(route('home'));
    }

    public function logout() {

        session_start();
        session_destroy();
        return Redirect::to(route('home'));
    }

    public function ajaxCheckForEmail(Request $request)
    {
        $dl = new DataLayer();
        
        if($dl->findUserByEmail($request->input('email')))
        {
            $response = array('found'=>true);
        } else {
            $response = array('found'=>false);
        }
        return response()->json($response);
    }
}
