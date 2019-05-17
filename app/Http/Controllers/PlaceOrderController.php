<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helpers;
use App\CrmConfiguration;

class PlaceOrderController extends Controller
{
    public static function index(){

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
            
        return view('order.place_order', compact('campaign_id','campaign_name'));
    }

    public static function campaign_find($id){
        dd('camapignFInd');
    }
}
