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
use App\UploadedCsv;
use App\Country;
use App\State;
use Helpers;

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
        
        $respone = Helpers::checkRolePermissions();

        if($respone == 1)
        {
            $allProspects = Prospect::sortable()->with('prospectCreatedUser')->select('id','fname','lname','address','state','city','zip_code','created_by','created_at')->orderBy('id', 'DESC')->simplePaginate(50)->toArray();
        }
        else if($respone == 0)
        {
            $userId = Session::get('userArray')['userId'];
            $allProspects = Prospect::sortable()->with('prospectCreatedUser')->select('id','fname','lname','address','state','city','zip_code','created_by','created_at')->where(array('created_by'=> $userId))->orderBy('id', 'DESC')->simplePaginate(50)->toArray();
        }
        
        return view('prospects/index',compact('allProspects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('prospects/create');
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

        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            /*'email' => 'required|email|unique:prospects,email',
            'mobile' => 'required',*/
            'address' => 'required',
            'address2' => '',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'plus4' => '',
            'deliveryP' => '',
            'crrt' => '',
            'check_digi' => '',
            'return_cod' => '',
            'dpv' => '',
            'lot' => '',
            'finder' => '',
            'p_key' => ''
        ]);

        $insertData = array(
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            /*'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),*/
            'address' => $request->input('address'),
            'address2' => $request->input('address2'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip'),
            'plus4' => $request->input('plus4'),
            'delivery_p' => $request->input('deliveryP'),
            'crrt' => $request->input('crrt'),
            'check_digi' => $request->input('check_digi'),
            'return_cod' => $request->input('return_cod'),
            'dpv' => $request->input('dpv'),
            'lot' => $request->input('lot'),
            'finder' => $request->input('finder'),
            'p_key' => $request->input('key'),
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
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

        $prospectDetails = Prospect::select('id','fname','lname','email','mobile','address','address2','state','city','zip_code','plus4','delivery_p','crrt','check_digi','return_cod','dpv','lot','finder','p_key')->where(array('id'=> $id))->first()->toArray();
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
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

        $prospectDetails = Prospect::select('id','fname','lname','email','mobile','address','address2','state','city','zip_code','plus4','delivery_p','crrt','check_digi','return_cod','dpv','lot','finder','p_key')->where(array('id'=> $id))->first()->toArray();

        return view('prospects/edit',compact('prospectDetails'));
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

        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            /*'email' => 'required|email|unique:prospects,email',
            'mobile' => 'required',*/
            'address' => 'required',
            'address2' => '',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'plus4' => '',
            'deliveryP' => '',
            'crrt' => '',
            'check_digi' => '',
            'return_cod' => '',
            'dpv' => '',
            'lot' => '',
            'finder' => '',
            'p_key' => ''
        ]);

        $updateData = array(
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            /*'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),*/
            'address' => $request->input('address'),
            'address2' => $request->input('address2'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip'),
            'plus4' => $request->input('plus4'),
            'delivery_p' => $request->input('deliveryP'),
            'crrt' => $request->input('crrt'),
            'check_digi' => $request->input('check_digi'),
            'return_cod' => $request->input('return_cod'),
            'dpv' => $request->input('dpv'),
            'lot' => $request->input('lot'),
            'finder' => $request->input('finder'),
            'p_key' => $request->input('key'),
            'status' => 1,
            'order_place_status' => 0,
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
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }

        if ($request->hasFile('file'))
        {
            $file = $request->file('file');
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // Check file extension
            if(in_array(strtolower($extension),$valid_extension))
            {
                // File upload location
                $location = 'csv_uploads';

                $filename = preg_replace('/\..+$/', '', $file->getClientOriginalName());
                $fullFilename = $filename.time().'.'.$file->getClientOriginalExtension();

                // Upload file
                $file->move($location,$fullFilename);

                // Import CSV to Database
                $filepath = public_path($location."/".$fullFilename);

                // Reading file
                $file = fopen($filepath,"r");

                $importData_arr = array();
                $i = 0;

                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    
                    $num = count($filedata );

                    // Skip first row (Remove below comment if you want to skip the first row)
                    if($i == 0){
                        $i++;
                        continue; 
                    }
                    for ($c=0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata [$c];
                    }
                    $i++;
                }
                fclose($file);

                // Insert to MySQL database
                $addToDb = $this->insertBatchData($importData_arr);

                $csvData = array(
                    'uploaded_by' => Session::get('userArray')['userId'],
                    'file_name' => $fullFilename,
                );

                UploadedCsv::create($csvData);

                $message = "file uploaded.";
                $status = 1;
            }
            else
            {
                $message = "Invalid File Extension.";
                $status = 0;
            }
        }
        else
        {
            $message = "file not uploaded.";
            $status = 0;
        }
        $jsonArray = json_encode(array('message' => $message, 'status' => $status));
        echo $jsonArray;
        exit;
    }

    function insertBatchData($importData_arr)
    {
        DB::connection()->disableQueryLog();
        //echo "first ".count($importData_arr)."---";
        foreach($importData_arr as $key => $importData)
        {
            if($key < 3000)
            {
                $insertData[] = array(
                    "fname" => $importData[0],
                    "lname" => $importData[1],
                    "p_key" => $importData[3],
                    "address" => $importData[4],
                    "address2" => $importData[5],
                    "city" => $importData[6],
                    "state" => $importData[7],
                    "zip_code" => $importData[8],
                    "plus4" => $importData[9],
                    "delivery_p" => $importData[10],
                    "crrt" => $importData[11],
                    "check_digi" => $importData[12],
                    "return_cod" => $importData[13],
                    "dpv" => $importData[14],
                    "lot" => $importData[15],
                    "finder" => $importData[16],
                    "status" => 1,
                    "order_place_status" => 0,
                    "created_by" => Session::get('userArray')['userId'],
                    "created_at" => new \DateTime(),
                    "updated_at" => new \DateTime()
                );
                unset($importData_arr[$key]);
            }
        }
        Prospect::insert($insertData);

        $importData_arr = array_values($importData_arr);
        //echo "second ".count($importData_arr)."---";
        //print_r($importData_arr);die;

        if(!empty($importData_arr))
        {
            $this->insertBatchData($importData_arr);
            //echo "then ".count($importData_arr)."---";
        }

        return "added";
    }

    public function searchProspect(Request $request)
    {
        if(!Session::get('userArray'))
        {
            return redirect('/admin/login');
        }
        
        $serachTerm = $_GET['search'];

        if($serachTerm == '')
        {
            return redirect('/admin/prospects');
        }

        $allProspects = Prospect::sortable()->with('prospectCreatedUser')->select('id','fname','lname','address','state','city','zip_code','created_by','created_at')->where('fname', 'LIKE', '%' . $serachTerm . '%')->orWhere('lname', 'LIKE', '%' . $serachTerm . '%')->orderBy('id', 'DESC')->simplePaginate(50)->toArray();
        //$allProspects->appends(['search' => $serachTerm]);
        //print_r($allProspects);die;
        return view('prospects/index',compact('allProspects'));
    }
}