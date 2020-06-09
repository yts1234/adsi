<?php

function callAPI($method, $url, $data){
    $curl = curl_init();
    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        break;

        default:
            if ($data)
                $url=sprintf("%s?%s", $url, http_build_query($data));            
    }

    //options
    $username="HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded',
    )); //The header
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $username.":"); //for basic auth credential
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    //Execute the task
    $result = curl_exec($curl);
    if(!$result){die("Connection Failure");}
    curl_close($curl);
    return $result;
}

//GET API
$get_data=callAPI('GET', 'https://nextar.flip.id/disburse/5535152564', false);
$response = json_decode($get_data, true);
$errors = $response['response']['errors'];
$data = $response['response']['data'][0];
print_r($response);

//POST API
?>