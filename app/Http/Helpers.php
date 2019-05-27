<?php

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Role;
use App\AdminUser;

class Helpers
{
    public static function sample_helper()
    {
        return "Your helper is working fine";
    }

    public static function cradentialValidation($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return $response = curl_exec($ch);
        if (curl_error($ch)) {
            $errorMessage = curl_error($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return array(
                'curlError' => true,
                'errorMessage' => $errorMessage,
                'httpCode' => $httpCode,
            );
        }
        curl_close($ch);

    }

    private static function makeRequest()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://' . $limelight_crm_instance . '/admin/membership.php');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return $response = curl_exec($ch);
        if (curl_error($ch)) {
            $errorMessage = curl_error($ch);
            $httpCode     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return array(
                'curlError'    => true,
                'errorMessage' => $errorMessage,
                'httpCode'     => $httpCode,
            );
        }
        curl_close($ch);
    }

    public static function checkRolePermissions()
    {
        $userId = Session::get('userArray')['userId'];

        $userDetails = AdminUser::select('id','role_id','status')->where(array('id'=> $userId, 'status' => 1))->first()->toArray();
        if(!empty($userDetails))
        {
            $userRole = $userDetails['role_id'];
        }
        if(isset($userRole))
        {
            if($userRole == 1 || $userRole == 2)
            {
                $response = 1;
            }
            else
            {
                $response = 0;
            }
        }
        else
        {
            $response = 0;
        }
        
        return $response;
    }
}
