<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Session;
use Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\AdminUser;

class DashboardController extends Controller
{
    public function index()
    {
    	if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }
    	$users = DB::table('admin_users')->count();
        $prospects = DB::table('prospects')->count();
        $orders = DB::table('prospects')->where('order_place_status', 1)->count();

    	return view('dashboard/dashboard',compact('users','prospects','orders'));
    }

    public function profile(Request $request)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }
        //print_r(Session::get('userArray'));die;
        $userId = Session::get('userArray')['userId'];
        $userDetails = AdminUser::select('id','name','email','mobile','avatar')->where(array('id'=> $userId))->first()->toArray();

        return view('dashboard/profile',compact('userDetails'));
    }

    public function profileUpdate(Request $request)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

        $userId = Session::get('userArray')['userId'];

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admin_users,email,'.$userId,
            'mobile' => 'required'
        ]);

        $updateData = array(
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'updated_at' => Carbon::now()->toDateTimeString()
        );

        $file = $request->file('image');
        if($file)
        {
            $fileName = preg_replace('/\..+$/', '', $file->getClientOriginalName());
            $fullFilename = $fileName.time().'.'.$file->getClientOriginalExtension();
            
            $destinationPath = 'admin_user_images';
            $file->move($destinationPath, $fullFilename);

            $updateData['avatar'] = $fullFilename;

            $userArray['avatar'] = $fullFilename;
        }
        else
        {
            $userArray['avatar'] = $request->input('userAvatar');
        }

        DB::table('admin_users')->where('id', $userId)->update($updateData);

        $userArray['userId'] = $userId;
        $userArray['name'] = $validatedData['name'];
        Session::put('userArray', $userArray);

        Session::flash('successMessage','You have successfully updated your profile.');
        return redirect('/admin/dashboard');
    }

    public function changePassword(Request $request)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }
        $userId = Session::get('userArray')['userId'];

        return view('dashboard/change-password',compact('userId'));
    }

    public function changePasswordUpdate(Request $request)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

        $userId = Session::get('userArray')['userId'];

        $validatedData = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword'
        ]);

        $userData = AdminUser::select('password')->where(array('id'=> $userId))->first()->toArray();

        if(!Hash::check($validatedData['oldPassword'], $userData['password']))
        {
            Session::flash('errorMessage',"Your old password doesn't match.");
            return redirect('/admin/change-password');
        }
        else
        {
            $updateData = array(
                'password' => Hash::make($validatedData['newPassword']),
                'updated_at' => Carbon::now()->toDateTimeString()
            );

            DB::table('admin_users')->where('id', $userId)->update($updateData);
            Session::flash('successMessage',"You have successfully updated your password.");
            return redirect('/admin/dashboard');
        }
    }
}
