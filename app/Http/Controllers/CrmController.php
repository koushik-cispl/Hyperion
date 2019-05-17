<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helpers;
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
        $this->validate($request,[
            'crm_name' => 'required',
            'endpoint' => 'required',
            'crm_user' => 'required',
            'crm_password' => 'required',
        ]);

        $methodName = 'validate_credentials';
        //if (is_array($credential) && !empty($credential)) {
            $params = array(
                'username' => $request->crm_user,
                'password' => $request->crm_password,
                'method'   => $methodName,
            );
            //print_r($params);
            $url      = 'https://'.$request->endpoint. '/admin/membership.php';
            //echo $url;
           // $url = "https://greenvalley.limelightcrm.com/admin/membership.php";
            $response = Helpers::cradentialValidation($url, $params);
            if ($response == 100) {
                $crm = new CrmConfiguration();
                $crm->api_name = $request->crm_name;
                $crm->api_endpoint = $request->endpoint;
                $crm->api_username = $request->crm_user;
                $crm->api_password = $request->crm_password;

                $crm->save();
                return redirect()->route('crm.index')->with('successMessage','CRM added Successfully');
                
            } else if ($response == 200) {
                return redirect()->back()->with("errorMessage","Please try with correct Username and password!");
            }
            else{
                return redirect()->back()->with("errorMessage", "Credential are wrong, please try with correct credential!");

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
         $this->validate($request,[
            'crm_name' => 'required',
            'endpoint' => 'required',
            'crm_user' => 'required',
            'crm_password' => 'required',
        ]);

        $methodName = 'validate_credentials';
        //if (is_array($credential) && !empty($credential)) {
            $params = array(
                'username' => $request->crm_user,
                'password' => $request->crm_password,
                'method'   => $methodName,
            );
            //print_r($params);
            $url      = 'https://'.$request->endpoint. '/admin/membership.php';
            //echo $url;
           // $url = "https://greenvalley.limelightcrm.com/admin/membership.php";
            $response = Helpers::cradentialValidation($url, $params);
            if ($response == 100) {
                $crm = CrmConfiguration::find($id);
                $crm->api_name = $request->crm_name;
                $crm->api_endpoint = $request->endpoint;
                $crm->api_username = $request->crm_user;
                $crm->api_password = $request->crm_password;

                $crm->save();
                return redirect()->route('crm.index')->with('successMessage','CRM updated Successfully');
                
            } else if ($response == 200) {
                return redirect()->back()->with("errorMessage","Please try with correct Username and password!");
            }
            else{
                return redirect()->back()->with("errorMessage", "Credential are wrong, please try with correct credential!");

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
        $crm = CrmConfiguration::find($id);
        $crm->delete();
        return redirect()->back()->with('successMessage','CRM successfully deleted!');
    }
}
