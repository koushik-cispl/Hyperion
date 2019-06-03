<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Helpers;
use Session;
use App\CrmConfiguration;
use App\State;
use App\Prospect;

class PlaceOrderController extends Controller
{

    public function __construct(){
        
    }
    
    public function index($prospectId)
    {
        $prospectDetails = Prospect::select('id','fname','lname','email','mobile','address','address2','state','city','zip_code','order_place_status','order_id','p_key')->where(array('id'=> $prospectId))->first()->toArray();

        if($prospectDetails['order_place_status'] == 1)
        {
            Session::flash('orderErrorMessage','It seems order is already placed for this prospect. Order Id is : '.$prospectDetails['order_id']);
            return redirect('/admin/prospects');
        }
        $crm = CrmConfiguration::find(1);
        $methodName = 'campaign_find_active';
        $params = array(
            'username' => $crm->api_username,
            'password' => $crm->api_password,
            'method'   => $methodName,
        );
        $url = 'https://' .$crm->api_endpoint . '/admin/membership.php';
         
        $respone = Helpers::cradentialValidation($url, $params);
        $campaign_data = explode("&",$respone);
        $campaigns = explode('=', $campaign_data[1]);
        $campaignsName = explode('=', $campaign_data[2]);
        $campaign_id = explode(',', $campaigns[1]);
        $campaign_name = explode(',', urldecode($campaignsName[1]));

        return view('order.place_order', compact('campaign_id','campaign_name','prospectDetails'));
    }

    public function campaignchange(Request $request)
    {
       try 
       {
            $campaignId = $request->input('campaign');
            $crm = CrmConfiguration::find(1);
            $shipping_ids = "";
            $url = 'https://'.$crm->api_endpoint.'/api/v1/offer_view';
            $loginInfo = 'Basic '. base64_encode($crm->api_username.':'.$crm->api_password);
            $criteria = "{\n\t\"campaign_id\":\"$campaignId\"\n}";
            $response = Helpers::makeRequest($loginInfo,$url,$criteria);
            $content = json_decode($response);
            //dd($content);
            if ($content->response_code=='100') 
            {
                $campaign_view_url = 'https://'.$crm->api_endpoint.'/api/v1/campaign_view';
                $campaign_data = Helpers::makeRequest($loginInfo,$campaign_view_url,$criteria);
            
                $campaignview_data = json_decode($campaign_data);
                
                if(!empty($campaignview_data->shipping))
                {
                    $shipp_arr = $campaignview_data->shipping;
                    $ship_price = $campaignview_data->shipping['0']->shipping_initial_price;
                }
                if (!empty($shipp_arr))
                {
                    for ($i=0; $i < count($shipp_arr); $i++)
                    { 
                        $shipping_ids .= '<option value='.$campaignview_data->shipping[$i]->shipping_id.'>('.$campaignview_data->shipping[$i]->shipping_id.') '.$campaignview_data->shipping[$i]->shipping_name.'</option>';
                    }
                }
            
                $offer_id = $content->data['0']->id;
                $offer_name = $content->data['0']->name;
                $products = $content->data['0']->products;
                $billing_models = $content->data['0']->billing_models;
                $offer_ids="";
                $product_ids="";
                $product_ids .= '<option value="">Select Product</option>';
                $billing_model_ids="";

                if(!empty($offer_id))
                {
                    $offer_ids .='<option value="'.$offer_id.'">('.$offer_id.') '.$offer_name.'</option>';
                }
                else
                {
                    $offer_ids .= '<option value="">No offer added to this campiagn</option>';
                }

                if(!empty($products))
                {
                    foreach ($products as $key => $value)
                    {   
                        $product_ids .= '<option value="' . $key . '">('. $key .') ' . $value . '</option>';
                    }      
                }
                else
                {
                    $product_ids .= '<option value="">No Product added to this campiagn</option>';

                }

                if(!empty($billing_models))
                {
                    foreach ($billing_models as $key => $value)
                    {
                        $billing_model_ids .= '<option value="' . $key . '">('. $key .')' . $value . '</option>';
                    }      
                }
                else
                {
                    $billing_model_ids .= '<option value="">No Billing profile added to this campiagn</option>';

                }
                    
                $jsonArray = json_encode(array('offer_ids' => $offer_ids, 'product_ids' => $product_ids, 
                'billing_model_ids' => $billing_model_ids,'shipping_ids'=>$shipping_ids,'ship_price'=>$ship_price));
                echo $jsonArray; exit;
            }
            else
            {
                $error_massages = $content->error_message;
            
                $error = $error_massages['0'];
                $error_massage = explode('{',$error);
                    
                $jsonArray = json_encode(array('errors' => 'yes', 'error_massage'=> $error_massage[0]));
                echo $jsonArray; 
                exit;
            }
        } 
        catch (Exception $ex) 
        {
            $jsonArray = json_encode(array('errors' => 'yes', 'error_massage' => $ex->getMessage()));
            echo $jsonArray;
            exit;

        }
    }

    public function productchange(Request $request)
    {
        $productId = $request->input('product');
        
        $crm = CrmConfiguration::find(1);
        $url = 'https://'.$crm->api_endpoint.'/api/v1/product_index';
        $loginInfo = 'Basic '. base64_encode($crm->api_username.':'.$crm->api_password);
        $criteria = "{\n\t\"product_id\":\"$productId\"\n}";
        $response = Helpers::makeRequest($loginInfo,$url,$criteria);
        $response = json_decode($response);
        $product_id = $response->product_id['0'];
        $pname = $response->products->$product_id->product_name;
        $pprice = $response->products->$product_id->product_price;
        
        $jsonArray = json_encode(array('product_id' => $product_id, 'pname' => $pname, 'pprice' => $pprice));
        echo $jsonArray;
        exit;
    }

    public function shippingChange(Request $request)
    {
        $shipping_id = $request->input('shipping_id');
        $crm = CrmConfiguration::find('1');

        $url = 'https://'.$crm->api_endpoint.'/api/v1/shipping_method_view';
        $loginInfo = 'Basic '. base64_encode($crm->api_username.':'.$crm->api_password);
        $criteria = "{\n\t\"shipping_id\":\"$shipping_id\"\n}";
        $response = Helpers::makeRequest($loginInfo,$url,$criteria);
        //dd($response);
        //$response = json_decode($response);
        echo $response;
        exit;
    }

    public function placeOrder(Request $request)
    {
        $crm = CrmConfiguration::find('1');
        $BillasShipp = $request->input('BillasShipp');
        $ip = Helpers::getIP();
        if (($request->input('campaignId')!='') && ($request->input('product_id')!='')) 
        {
            $this->validate($request,[
                'ShippingFirstName' => 'required',
                'ShippingLastName' => 'required',
                'ShippingAddress' => 'required',
                'ShippingCity' => 'required',
                'ShippingZipCode' => 'required',
                'Phone' => 'required',
                'Email' => 'required',
                'CardType' => 'required',
                'CreditCard' => 'required',
                'ExpMonth' => 'required',
                'ExpYear' => 'required',
                'Cvv' => 'required',
            ]);

            if ($BillasShipp == "no") 
            {
                $this->validate($request,[
                    'BillingFirstName' => 'required',
                    'BillingLastName' => 'required',
                    'BillingAddress' => 'required',
                    'BillingCity' => 'required',
                    'BillingZipCode' => 'required',
                ]);
            }

            $ShippingFirstName = $request->input('ShippingFirstName');
            $ShippingLastName = $request->input('ShippingLastName');
            $ShippingAddress = $request->input('ShippingAddress');
            $ShippingAddress2 = $request->input('ShippingAddress2');
            $ShippingCity = $request->input('ShippingCity');
            $ShippingZipCode = $request->input('ShippingZipCode');
            $ShippingState = $request->input('ShippingState');
            $ShippingCountry = $request->input('ShippingCountry');
            $Phone = $request->input('Phone');
            $Email = $request->input('Email');
            $CardType = $request->input('CardType');
            $CreditCard = $request->input('CreditCard');
            $ExpMonth = $request->input('ExpMonth');
            $ExpYear = $request->input('ExpYear');
            $Cvv = $request->input('Cvv');
            if ($BillasShipp == "no") 
            {
                $BillasShipp = 'no';
                $BillingFirstName = $request->input('BillingFirstName');
                $BillingLastName = $request->input('BillingLastName');
                $BillingAddress = $request->input('BillingAddress');
                $BillingCity = $request->input('BillingCity');
                $BillingZipCode = $request->input('BillingZipCode');
                $BillingState = $request->input('BillingState');
                $BillingCountry = $request->input('BillingCountry');  
            }
            else
            {
                $BillasShipp = 'yes' ;
                $BillingFirstName = '';
                $BillingLastName = '';
                $BillingAddress = '';
                $BillingCity = '';
                $BillingZipCode = '';
                $BillingState = '';
                $BillingCountry = ''; 
            }
            // CRM Info
            $campaignId = $request->input('campaignId');
            $shippingId = $request->input('shippingId');
            $product_id = $request->input('product_id');
            $offer_id = $request->input('offer_id');
            $billing_model_id = $request->input('billing_model_id');
            $quantity = $request->input('quantity');
            $prospectId = $request->input('prospectId');
            $step_num = '1';

            $jsonParams = array (
                'firstName' => $ShippingFirstName,
                'lastName' => $ShippingLastName,
                'email' => $Email,
                'phone' => $Phone,
                'shippingAddress1' => $ShippingAddress,
                'shippingAddress2' => $ShippingAddress2,
                'shippingZip' => $ShippingZipCode,
                'shippingCity' => $ShippingCity,
                'shippingState' => $ShippingState,
                'shippingCountry' => $ShippingCountry,
                'billingSameAsShipping' => $BillasShipp,
                'billingFirstName' => $BillingFirstName,
                'billingLastName' => $BillingLastName,
                'billingAddress1' => $BillingAddress,
                'billingZip' => $BillingZipCode,
                'billingCity' => $BillingCity,
                'billingState' => $BillingState,
                'billingCountry' => $BillingCountry,
                'ipAddress' => $ip,
                'campaignId' => $campaignId,
                'AFID' => $request->input('AFID') ? $request->input('AFID') : '',
                'SID' => $request->input('SID') ? $request->input('SID') : '',
                'AFFID' => $request->input('AFFID') ? $request->input('AFFID') : '',
                'C1' => $request->input('C1') ? $request->input('C1') : '',
                'C2' => $request->input('C2') ? $request->input('C2') : '',
                'C3' => $request->input('C3') ? $request->input('C3') : '',
                'offers' => 
                    array (
                        0 => array (
                            'offer_id' => $offer_id,
                            'billing_model_id' => $billing_model_id,
                            'quantity' => $quantity,
                            'product_id' => $product_id,
                            'step_num' => 1,
                        ),
                    ),
                'shippingId' => $shippingId,
                'creditCardType' => $CardType,
                'creditCardNumber' => $CreditCard,
                'CVV' => $Cvv,
                'expirationDate' => $ExpMonth.$ExpYear,
                'tranType' => 'Sale',
                'notes' => $request->input('notes') ? $request->input('notes') : '',
            );
     
            $url = 'https://' . $crm->api_endpoint . '/api/v1/new_order';
            $loginInfo = 'Basic ' . base64_encode($crm->api_username . ':' . $crm->api_password);
            $jsonParams = json_encode($jsonParams);
            $response = Helpers::makeRequest($loginInfo, $url, $jsonParams);
            $content = json_decode($response);
            // dd($content);
            if ($content->response_code == 100) 
            {
                $order_id = $content->order_id;
                $prospect = Prospect::find($prospectId);
                $prospect->order_place_status = 1;
                $prospect->order_id = $order_id;
                $prospect->save();
                return redirect('admin/prospects')->with('orderSuccessMessage','Order has been created successfully, Order Id: '. $order_id);
            }
            else
            {
                $error = $content->error_message;
                $decline_reason = $content->decline_reason;
                return redirect()->back()->with('orderErrorMessage', 'Your order has been declined, '.$decline_reason);
            }
        }
        else
        { 
            // If not select CID & PID
            return redirect()->back()->with('orderErrorMessage','Please select Campaign & Products Properly');
        }
    }

}
