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

    public static function makeRequest($loginInfo, $url,$params)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>$params,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization:".$loginInfo,
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
        return "cURL Error #:" . $err;
        } else {
        return $response;
        } 
    }

    public static function getIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
        $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
  
    public static function get_months()
            {
                $months = array(
                    '01' => 'January',
                    '02' => 'February',
                    '03' => 'March',
                    '04' => 'April',
                    '05' => 'May',
                    '06' => 'June',
                    '07' => 'July',
                    '08' => 'August',
                    '09' => 'September',
                    '10' => 'October',
                    '11' => 'November',
                    '12' => 'December',
                );

                $options = '<option value="">Month</option>';
                foreach ($months as $key => $value) {
                    $options .= sprintf('<option value="%s">%s</option>', $key, "($key) " . $value);
                }

                return $options;
            }
    public static function get_years()
            {
                $year = date('Y');
                $options = '<option value="">Year</option>';
                for ($i = $year; $i < $year + 20; $i++) {
                    $options .= sprintf('<option value="%s">%s</option>', substr($i, 2), $i);
                }
                return $options;
            }

            public static function get_states(){
                $states = array(
                    "AL"=> "Alabama",
                    "AK"=> "Alaska",
                    "AS"=> "American Samoa",
                    "AZ"=> "Arizona",
                    "AR"=> "Arkansas",
                    "CA"=> "California",
                    "CO"=> "Colorado",
                    "CT"=> "Connecticut",
                    "DE"=> "Delaware",
                    "DC"=> "District Of Columbia",
                    "FM"=> "Federated States Of Micronesia",
                    "FL"=> "Florida",
                    "GA"=> "Georgia",
                    "GU"=> "Guam",
                    "HI"=> "Hawaii",
                    "ID"=> "Idaho",
                    "IL"=> "Illinois",
                    "IN"=> "Indiana",
                    "IA"=> "Iowa",
                    "KS"=> "Kansas",
                    "KY"=> "Kentucky",
                    "LA"=> "Louisiana",
                    "ME"=> "Maine",
                    "MH"=> "Marshall Islands",
                    "MD"=> "Maryland",
                    "MA"=> "Massachusetts",
                    "MI"=> "Michigan",
                    "MN"=> "Minnesota",
                    "MS"=> "Mississippi",
                    "MO"=> "Missouri",
                    "MT"=> "Montana",
                    "NE"=> "Nebraska",
                    "NV"=> "Nevada",
                    "NH"=> "New Hampshire",
                    "NJ"=> "New Jersey",
                    "NM"=> "New Mexico",
                    "NY"=> "New York",
                    "NC"=> "North Carolina",
                    "ND"=> "North Dakota",
                    "MP"=> "Northern Mariana Islands",
                    "OH"=> "Ohio",
                    "OK"=> "Oklahoma",
                    "OR"=> "Oregon",
                    "PW"=> "Palau",
                    "PA"=> "Pennsylvania",
                    "PR"=> "Puerto Rico",
                    "RI"=> "Rhode Island",
                    "SC"=> "South Carolina",
                    "SD"=> "South Dakota",
                    "TN"=> "Tennessee",
                    "TX"=> "Texas",
                    "UT"=> "Utah",
                    "VT"=> "Vermont",
                    "VI"=> "Virgin Islands",
                    "VA"=> "Virginia",
                    "WA"=> "Washington",
                    "WV"=> "West Virginia",
                    "WI"=> "Wisconsin",
                    "WY"=> "Wyoming"
                );
                $options = '<option value="">Select State</option>';
                foreach ($states as $key => $value) {
                    $options .= sprintf('<option value="%s">%s</option>', $key, $value);
                }

                return $options;
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
