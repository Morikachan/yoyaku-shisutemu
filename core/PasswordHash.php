<?php

class PasswordHash {
    private static $instance = null;
    private $passwordHash;
    private $isVerified;
    
    public static function getInstance(){
        if(self::$instance === null) {
            self::$instance = new PasswordHash();
        }
        return self::$instance;
    }

    public function getPasswordHash($password){
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $this->passwordHash = $passwordHash;
        return $this->passwordHash;
    }
    public function getPasswordVerify($password, $hashPassword){
        $passwordVerify = password_verify($password, $hashPassword);
        $this->isVerified = $passwordVerify;
        return $this->isVerified;
    }
}

?>