<?php 

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
}
