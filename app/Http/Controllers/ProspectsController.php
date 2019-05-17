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
use App\Prospect;
use App\Country;
use App\State;

class ProspectsController extends Controller
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
        
        $allProspects = Prospect::with('prospectsCountry','prospectsState')->select('id','fname','lname','email','mobile','address','country','state','created_at')->simplePaginate(10)->toArray();
        //print_r($allProspects);die;
        return view('prospects/index',compact('allProspects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryData = Country::all()->toArray();
        $stateData = State::all()->toArray();
        
        return view('prospects/create',compact('countryData','stateData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:prospects,email',
            'mobile' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required'
        ]);

        $insertData = array(
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'address' => $validatedData['address'],
            'country' => $validatedData['country'],
            'state' => $validatedData['state'],
            'city' => $validatedData['city'],
            'zip_code' => $validatedData['zip'],
            'status' => 1,
            'order_place_status' => 0,
            'created_by' => Session::get('userArray')['userId']
        );

        $saveData = Prospect::create($insertData);
        Session::flash('successMessage','You have successfully added a new prospect.');
        
        return redirect('/admin/prospects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prospectDetails = Prospect::with('prospectsCountry','prospectsState')->select('id','fname','lname','email','mobile','address','country','state','city','zip_code')->where(array('id'=> $id))->first()->toArray();
        //print_r($prospectDetails);die;
        return view('prospects/view',compact('prospectDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prospectDetails = Prospect::select('id','fname','lname','email','mobile','address','country','state','city','zip_code')->where(array('id'=> $id))->first()->toArray();

        $countryData = Country::all()->toArray();
        $stateData = State::select('id','name')->where(array('country_id'=> $prospectDetails['country']))->get()->toArray();
        return view('prospects/edit',compact('prospectDetails','countryData','stateData'));
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
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:prospects,email,'.$id,
            'mobile' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required'
        ]);

        $updateData = array(
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'address' => $validatedData['address'],
            'country' => $validatedData['country'],
            'state' => $validatedData['state'],
            'city' => $validatedData['city'],
            'zip_code' => $validatedData['zip'],
            'created_by' => Session::get('userArray')['userId'],
            'updated_at' => Carbon::now()->toDateTimeString()
        );

        DB::table('prospects')->where('id', $id)->update($updateData);
        Session::flash('successMessage','You have successfully updated the prospect.');
        
        return redirect('/admin/prospects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stateChange(Request $request)
    {
        $countryId = $request->input('countryId');
        $stateData = DB::table('states')->select('id','name')->where('country_id', $countryId)->get()->toArray();

        $selectbox="";
        $selectbox .='<option value="">Please select a state</option>';
        
        if(!empty($stateData))
        {
            foreach($stateData as $state)
            {
                $selectbox .='<option value="'.$state->id.'">'.$state->name.'</option>';
            }
        }

        $jsonArray = json_encode(array('options' => $selectbox, 'status' => 1));
        echo $jsonArray;
        exit;
        //print_r($stateData);die;
    }

    public function uploadcsv(Request $request)
    {
        print_r($_FILES);die;
        /* Getting file name */
        $filename = $_FILES['file']['name'];

        /* Getting File size */
        $filesize = $_FILES['file']['size'];

        echo $filename;die;
    }
}
