<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helpers;
use Session;
use App\CrmConfiguration;

class CrmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }
        $crms =  CrmConfiguration::all();
        return view('crm.index',compact('crms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }
        return view('crm.crm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }
        $this->validate($request,[
            'crm_name' => 'required',
            'endpoint' => 'required',
            'crm_user' => 'required',
            'crm_password' => 'required',
        ]);
        $url = 'https://' . $request->input('endpoint') . '/api/v1/validate_credentials';
        $loginInfo = 'Basic '. base64_encode($request->input('crm_user').':'.$request->input('crm_password'));
        $response = Helpers::validate_data($loginInfo,$url);
        $content = json_decode($response);
        
        if ($content != NULL)
        {  dd($content);
          
            if ($content->response_code == 100) 
            {
                $crm = new CrmConfiguration();
                $crm->api_name = $request->crm_name;
                $crm->api_endpoint = $request->endpoint;
                $crm->api_username = $request->crm_user;
                $crm->api_password = $request->crm_password;
                $crm->save();
                return redirect()->route('crm.index')->with('successMessage','CRM added Successfully');
            } 
            else if ($content->response_code == 200) 
            {
                return redirect()->back()->with("errorMessage","Please try with correct Username and password!");
            }
            else
            {
                return redirect()->back()->with("errorMessage", "Credential is wrong, please try with correct credential!");
            }
        }
        else
        {
            return redirect()->back()->with("errorMessage", "Limelight Instance is wrong!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

        $crm = CrmConfiguration::find($id);
        return view('crm.edit',compact('crm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

        $this->validate($request,[
            'crm_name' => 'required',
            'endpoint' => 'required',
            'crm_user' => 'required',
            'crm_password' => 'required',
        ]);
        $url = 'https://' . $request->input('endpoint') . '/api/v1/validate_credentials';
        $loginInfo = 'Basic '. base64_encode($request->input('crm_user').':'.$request->input('crm_password'));
        $response = Helpers::validate_data($loginInfo,$url);
        $content = json_decode($response);
        if ($content != NULL) 
        { 
            if ($content->response_code == 100) 
            {
                $crm = CrmConfiguration::find($id);
                $crm->api_name = $request->crm_name;
                $crm->api_endpoint = $request->endpoint;
                $crm->api_username = $request->crm_user;
                $crm->api_password = $request->crm_password;
                $crm->save();
                return redirect()->route('crm.index')->with('successMessage','CRM updated Successfully');
            } 
            else if ($content->response_code == 200) 
            {
                return redirect()->back()->with("errorMessage","Please try with correct Username and password!");
            }
            else
            {
                return redirect()->back()->with("errorMessage", "Credential is wrong, please try with correct credential!");
            }
        }
        else
        {
            return redirect()->back()->with("errorMessage", "Limelight Instance is wrong!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }
        
        $crm = CrmConfiguration::find($id);
        $crm->delete();
        return redirect()->back()->with('successMessage','CRM successfully deleted!');
    }
}
