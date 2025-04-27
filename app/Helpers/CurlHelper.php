<?php

namespace App\Helpers;

class CurlHelper
{
    /**
     * Send a cURL request.
     *
     * @param string $method  HTTP method: GET, POST, PUT, DELETE, etc.
     * @param string $url     Full URL to send request to.
     * @param array  $data    Payload data (optional).
     * @param array  $headers Extra headers (optional).
     * @param int    $timeout Request timeout in seconds.
     * @return array          Decoded JSON response or error info.
     */
    public static function request($method, $url, $data = [], $headers = [], $timeout = 30)
    {
        dump($data);
        $curl = curl_init();

        $defaultHeaders = [
            'Accept: application/json',
            'Content-Type: application/json',
        ];

        $mergedHeaders = array_merge($defaultHeaders, $headers);

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_HTTPHEADER => $mergedHeaders,
        ]);

        if (in_array(strtoupper($method), ['POST', 'PUT', 'PATCH'])) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            return [
                'success' => false,
                'message' => 'cURL Error: ' . $error,
            ];
        }

        return json_decode($response, true);
    }
}
