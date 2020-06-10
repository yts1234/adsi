<?php
class disbursement 
//class skeleton
{
 private $bank_code;
 private $account_number;
 private $amount;
 private $remark;

 public function __construct($bank_code, $account_number, 
                             $amount, $remark){
     $this->bank_code = $bank_code;
     $this->account_number = $account_number;
     $this->amount = $amount;
     $this->remark = $remark;
 }

 public function callAPI($method, $url, $data){
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
 
 public function getStatus(){
    $get_data=$this->callAPI('GET', 'https://nextar.flip.id/disburse/5535152564', false);
    $response = json_decode($get_data, true);
    print_r($response);//print the API response
 }

 public function postDisbursement(){
    $data_array = array(
        "bank_code"=>$this->bank_code,
        "account_number"=>$this->account_number,
        "amount"=>$this->amount,
        "remark"=>$this->remark
    );
    
    $url_data=http_build_query($data_array);//Urlify the array
    $make_call = $this->callAPI('POST', 'https://nextar.flip.id/disburse', $url_data);
    $response = json_decode($make_call, true);
    return $response;
 }
}


$disburse = new disbursement("bni",1234,10000,"Test Disburse");
print_r($disburse->postDisbursement());
//require 'm_disbursement.php';
//$trans2 = new M_disbursement($response);
//print_r($trans->getData());

?>