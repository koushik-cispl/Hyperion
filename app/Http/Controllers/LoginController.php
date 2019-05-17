<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\AdminUser;
use Mail;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        if(Session::get('userArray'))
        {
            return redirect('/admin/dashboard');
        }
    	return view('login/login');
    }

    public function loginSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $loginData = AdminUser::select('id','password','status')->where(array('email'=> $validatedData['email']))->get()->toArray();

        if(!empty($loginData))
        {
            if (Hash::check($validatedData['password'], $loginData[0]['password']))
            {
                if($loginData[0]['status'] == 1)
                {
                    $resultType = 1;
                    $resultMsg = "You have successfully logged in.";
                    $userId = $loginData[0]['id'];

                    $remember = $request->input('remember');
                    $time = time() + (86400 * 30); // 86400 = 1 day

                    if($remember == 1)
                    {
                        setcookie('userEmail', $validatedData['email'], $time, "/");
                        setcookie('userPassword', $validatedData['password'], $time, "/");
                    }
                    elseif ($remember == 0)
                    {
                        setcookie('userEmail', '', $time, "/");
                        setcookie('userPassword', '', $time, "/");
                    }
                }
                else
                {
                    $resultType = 2;
                    $resultMsg = "It seems your account is inactive.";
                    $userId = 0;
                }
            }
            else
            {
                $resultType = 0;
                $resultMsg = "It seems you have entered the wrong password.";
                $userId = 0;
            }
        }
        else
        {
            $resultType = 0;
            $resultMsg = "It seems you have entered the wrong email.";
            $userId = 0;
        }
        
        $jsonArray = json_encode(array('success' => $resultType,'messageType' => $resultMsg, 'userId' => $userId));
        echo $jsonArray;
        exit;
    }

    public function setSession(Request $request, $userId)
    {
        $loggedInUser = AdminUser::select('id','name','avatar')->where(array('id'=> $userId))->first()->toArray();
        //print_r($loggedInUser);die;
        $userArray = array(
            'userId' => $loggedInUser['id'],
            'name' => $loggedInUser['name'],
            'avatar' => $loggedInUser['avatar']
        );
        Session::flash('successMessage','You have successfully logged in.');
        Session::put('userArray', $userArray);

        return redirect('/admin/dashboard');
    }

    public function checkValueExist(Request $request)
    {
        $fieldType = $request->input('fieldType');
        $fieldValue = $request->input('fieldValue');

        $userDetailsCheck= DB::table('admin_users')->select($fieldType)->where($fieldType, $fieldValue)->first();

        if(!empty($userDetailsCheck)) {
            $result = "found";
        } else {
            $result = "notFound";
        }
        echo $result;die;
    }

    public function forgetPassword(Request $request)
    {
        if(Session::get('userArray'))
        {
            return redirect('/admin/dashboard');
        }
        return view('login/forget-password');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Session::flash('successMessage', 'You have successfully logged out from your account.');
    	return redirect('/admin/login');
    }
}
