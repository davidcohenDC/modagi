<?php

class BankingSimulator {
    
    public function __construct($cardOwner, $cardNumber, $cardExpiration, $cardCvv) {
        $this->$cardOwner = $cardOwner;
        $this->$cardNumber = $cardNumber;
        $this->$cardExpiration = $cardExpiration;
        $this->$cardCvv = $cardCvv;
    }

    public function isValidCard() {
        if(empty($_POST["cardName"]) || empty($_POST["cardNumber"]) || empty($_POST["cardExpiration"]) || empty($_POST["cardCVV"])) {
            return false;
        }
        return true;
    }

    public function requirePayment() {
        if($this->isValidCard()) {
            //sleep for simulate bank request
            sleep(3);
            return true;
        }
        return false;
    }
}


?>