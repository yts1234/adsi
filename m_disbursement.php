<?php
/*In this class I used prepared PDO statement to prevent 
SQL Injection
*/
class M_disbursement{
    
    private $data;

    function __construct($initData){
        
        $this->data = $initData;
        
    }

    public function insertDB(){
        require 'connection.php';
    
        try {
            $sql = $conn->prepare("INSERT INTO transaction(
                id, amount, status, timestamp, bank_code, 
                account_number, beneficiary_name, remark, 
                receipt, time_served, fee) VALUES(:id, :amount, 
                :status, :timestamp, :bank_code, :account_number, 
                :beneficiary_name, :remark, 
                :receipt, :time_served, :fee)");

                $sql->bindParam(':id',$this->data['id']);
                $sql->bindParam(':amount',$this->data['amount']);
                $sql->bindParam(':status',$this->data['status']);
                $sql->bindParam(':timestamp',$this->data['timestamp']);
                $sql->bindParam(':bank_code',$this->data['bank_code']);
                $sql->bindParam(':account_number',$this->data['account_number']);
                $sql->bindParam(':beneficiary_name',$this->data['beneficiary_name']);
                $sql->bindParam(':remark',$this->data['remark']);
                $sql->bindParam(':receipt',$this->data['receipt']);
                $sql->bindParam(':time_served',$this->data['time_served']);
                $sql->bindParam(':fee',$this->data['fee']);

                $sql->execute();
                echo("Your transaction is being process, please kindly wait while we doing some magic");
                echo("\nYour transaction id is: ".$this->data['id']);
        } catch (PDOException $e) {
            echo("Error: ".$e->getMessage());
        }
        $conn = null;
    }

    function getData(){
        require 'connection.php';
        try {
            $sql = $conn->prepare("UPDATE transaction SET id=:id, amount=:amount, 
                status=:status, timestamp=:timestamp, bank_code=:bank_code, 
                account_number=:account_number, beneficiary_name=:beneficiary_name, 
                remark=:remark, receipt=:receipt, time_served=:time_served, 
                fee=:fee WHERE id=:id");

                $sql->bindParam(':id',$this->data['id']);
                $sql->bindParam(':amount',$this->data['amount']);
                $sql->bindParam(':status',$this->data['status']);
                $sql->bindParam(':timestamp',$this->data['timestamp']);
                $sql->bindParam(':bank_code',$this->data['bank_code']);
                $sql->bindParam(':account_number',$this->data['account_number']);
                $sql->bindParam(':beneficiary_name',$this->data['beneficiary_name']);
                $sql->bindParam(':remark',$this->data['remark']);
                $sql->bindParam(':receipt',$this->data['receipt']);
                $sql->bindParam(':time_served',$this->data['time_served']);
                $sql->bindParam(':fee',$this->data['fee']);

                $sql->execute();

                if($sql->rowCount()<=0){
                    echo("Sorry we can't update your transaction status, please check your id transaction");
                }else{
                    echo("Your transaction is: ".$this->data['status']);
                    echo("\nYour transaction id: ".$this->data['id']);
                }
                
                
        } catch (PDOException $e) {
            echo("Error: ".$e->getMessage());
        }
        $conn = null;
    }
}

?>