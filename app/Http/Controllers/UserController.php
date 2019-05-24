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
use App\Role;
use App\AdminUser;

class UserController extends Controller
{
    public function index()
    {
    	if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }
        //dd(Session::all());
    	$allUsers = AdminUser::with('userRoles')->select('id','name','email','mobile','avatar','role_id','status')->simplePaginate(10)->toArray();
    	
    	return view('users/users',compact('allUsers'));
    }

    public function newUser()
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

    	$roleData = Role::select('id','name')->where(array('status'=> 1))->get()->toArray();
    	return view('users/new-user',compact('roleData'));
    }

    public function newUserCreate(Request $request)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

    	$validatedData = $request->validate([
    		'name' => 'required',
            'email' => 'required|email|unique:admin_users,email',
            'mobile' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

    	$file = $request->file('image');
    	if($file)
    	{
    		$fileName = preg_replace('/\..+$/', '', $file->getClientOriginalName());
			$fullFilename = $fileName.time().'.'.$file->getClientOriginalExtension();
			
			$destinationPath = 'admin_user_images';
			$file->move($destinationPath, $fullFilename);
    	}
    	else
    	{
    		$fullFilename = '';
    	}

    	$insertData = array(
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'avatar' => $fullFilename,
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role'],
            'status' => $request->input('status')
        );

        $saveData = AdminUser::create($insertData);
        Session::flash('successMessage','You have successfully registered a new user.');
        
        return redirect('/admin/users');
    }

    public function editUser(Request $request, $id)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

        $userDetails = AdminUser::select('id','name','email','mobile','role_id','status','avatar')->where(array('id'=> $id))->first()->toArray();
        $roleData = Role::select('id','name')->where(array('status'=> 1))->get()->toArray();

        return view('users/edit-user',compact('userDetails','roleData'));
    }

    public function editUserUpdate(Request $request)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

        $userId = $request->input('userId');

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admin_users,email,'.$userId,
            'mobile' => 'required',
            'role' => 'required'
        ]);
        
        $updateData = array(
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'role_id' => $validatedData['role'],
            'status' => $request->input('status'),
            'updated_at' => Carbon::now()->toDateTimeString()
        );

        if($request->input('password'))
        {
            $updateData['password'] = Hash::make($request->input('password'));
        }

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

        $loggedInUserId = Session::get('userArray')['userId'];
        if($loggedInUserId == $userId)
        {
            $userArray['userId'] = $loggedInUserId;
            $userArray['name'] = $validatedData['name'];
            Session::put('userArray', $userArray);
        }

        Session::flash('successMessage','You have successfully updated the user.');
        return redirect('/admin/users');
    }

    public function viewUser(Request $request, $id)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

        $userDetails = AdminUser::with('userRoles')->select('name','email','mobile','avatar','role_id','status')->where(array('id'=> $id))->first()->toArray();
        //print_r($userDetails);die;
        return view('users/view-user',compact('userDetails'));
    }

    public function deleteUser(Request $request)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }
        
        $userId = $request->input('uId');

        DB::table('admin_users')->where('id', $userId)->delete();

        Session::flash('successMessage','You have successfully deleted the user.');
        return redirect('/admin/users');
    }
}
