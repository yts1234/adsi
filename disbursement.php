<?php
class disbursement 
{
 //class skeleton
 public function callAPI()
 
 public function getStatus()

 public function postDisbursement()
}

//function to process the API call
function callAPI($method, $url, $data){
    $curl = curl_init();
    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, true);
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
/* 
$get_data=callAPI('GET', 'https://nextar.flip.id/disburse/5535152564', false);
$response = json_decode($get_data, true);
print_r($response);//print the API response
*/
//POST API

$data_array = array(
    "bank_code"=>"bni",
    "account_number"=>"123456",
    "amount"=>"10000",
    "remark"=>"Transfer to Josh"
);

$url_data=http_build_query($data_array);//Urlify the array
$make_call = callAPI('POST', 'https://nextar.flip.id/disburse', $url_data);
$response = json_decode($make_call, true);
print_r($response);
print_r($url_data)

?>