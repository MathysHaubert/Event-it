<?php

namespace App\Trait;

trait ApiTrait{
    public static function get($url, $body = null, $token = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        if ($body !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
            $headers = ['Content-Type: application/json']; // Set content type to JSON
            if ($token) {
                $headers[] = 'Authorization: Bearer ' . $token;
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        } else if ($token) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token]);
        }

        $output = curl_exec($ch);
        if ($output === false) {
            $error = curl_error($ch);
            curl_close($ch);
            return ['error' => true, 'message' => $error];
        }

        curl_close($ch);

        if (substr($output, -2) === '""' && substr($output, -3, 1) === '}') {
            $output = substr($output, 0, -2);
        }

        return json_decode($output, true);
    }


    public static function post($url, $data, $token = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Content-Type: application/json'];
        if($token) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($ch);

        // Check if the cURL request failed
        if($output === false) {
            // Output the error message
            echo 'cURL error: ' . curl_error($ch) . "\n";
        }

        curl_close($ch);
        return json_decode($output, true);
    }

    public static function put($url, $data, $token = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Content-Type: application/json'];
        if($token) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }

    public static function delete($url, $token = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($token) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        }
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }

    public static function update($url, $data, $token = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Content-Type: application/json'];
        if($token) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }

    public static function patch($url, $data, $token = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Content-Type: application/json'];
        if($token) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($ch);
        curl_close($ch);
        error_log(print_r("Patch response ", true));
        error_log(print_r($output, true)); // Debug: Log patch response
        return json_decode($output, true);
    }
}
