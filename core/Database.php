<?php

class Database {

    private const SERVER_NAME = 'localhost';
    private const DB_NAME = 'reservationsystem_db';
    private const USER_NAME = 'root';
    private const PASSWORD = '';

    private $pdo;
    
    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=" . self::SERVER_NAME .
            ";dbname=" . self::DB_NAME, self::USER_NAME, self::PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo '接続失敗' . $e->getMessage();
            exit();
        }
    }

    public function getPDO(){
        return $this->pdo;
    }
}

?>