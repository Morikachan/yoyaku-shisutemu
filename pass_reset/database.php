<?php
//データベースの情報を記した処理です。

//データベース情報
const DB_SERVER_NAME = 'localhost';
const DB_USER_NAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'reservationsystem_db';
//ここまでデータベース情報
function getDb(){
        try {
            $pdo = new PDO("mysql:host=" . DB_SERVER_NAME .
            ";dbname=" . DB_NAME, DB_USER_NAME, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo '接続失敗' . $e->getMessage();
            exit();
        }
    }
?>