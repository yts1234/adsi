<?php
class disbursement 
//class skeleton
{
 /*
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
*/
//Function to Call Slightly-big Flip API
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
 //Function to get the transaction status
 public function getStatus($idTransaction){
    $get_data=$this->callAPI('GET', 'https://nextar.flip.id/disburse/'.$idTransaction.'', false);
    $response = json_decode($get_data, true);
    return $response;
 }
//function to make a transaction
 public function postDisbursement($bank_code, $account_number, 
                                $amount, $remark){
    $data_array = array(
        "bank_code"=>$bank_code,
        "account_number"=>$account_number,
        "amount"=>$amount,
        "remark"=>$remark
    );
    
    $url_data=http_build_query($data_array);//Urlify the array
    $make_call = $this->callAPI('POST', 'https://nextar.flip.id/disburse', $url_data);
    $response = json_decode($make_call, true);
    return $response;
 }
}

//this code is for checking the argument passed from the terminal
if (isset($argc)){
    $disburse = new disbursement();
    if ($argv[1]=="disbursement") {
        print_r($disburse->postDisbursement((string)$argv[2],(int)$argv[3],(int)$argv[4],(string)$argv[5]));        
    }elseif($argv[1]=="status"){
        print_r($disburse->getStatus((string)$argv[2]));
    }else {
        echo("Please check your argument");
    }
}


//print_r($disburse->postDisbursement());
//print_r($disburse->getStatus(7315347024))
//require 'm_disbursement.php';
//$trans2 = new M_disbursement($response);
//print_r($trans->getData());

?>