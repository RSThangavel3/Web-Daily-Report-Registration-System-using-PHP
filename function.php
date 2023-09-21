<?php
    //データベースに接続する
    function connect_db(){
        $param = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
        $pdo = new PDO($param, DB_USER, DB_PASSWORD);
        $pdo->query('SET NAMES utf8;');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }

    function time_format_dw($date) {
        $format_date = NULL;
        $week = array ('日','月','火','水','木','金','土');

        if($date) {
            $format_date = date('j('.$week[date('w',strtotime($date))].')',strtotime($date));
        }

        return $format_date;
    } 

    function format_time($timeString) {
        $timeComponents = explode(':', $timeString);
    
        if (count($timeComponents) >= 2) {
            $hour = (int)$timeComponents[0];
            $minute = (int)$timeComponents[1];
            return sprintf("%02d:%02d", $hour, $minute);
        } 
    }

    function encryptWithFixedKey($plaintext) {
        $key = 'ThisIsAStrongSecretKey123!'; // Replace with your actual secret key
        $iv = 'ndomIV1234567890';   // Replace with your actual IV value
    
        $cipher = "aes-256-cbc";
        $ciphertext = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($ciphertext);
    }
    
    
    function decryptWithFixedKey($ciphertext) {
        $key = 'ThisIsAStrongSecretKey123!'; // Replace with your actual secret key
        $iv = 'ndomIV1234567890';   // Replace with your actual IV value
    
        $cipher = "aes-256-cbc";
        $plaintext = openssl_decrypt(base64_decode($ciphertext), $cipher, $key, OPENSSL_RAW_DATA, $iv);
        return $plaintext;
    }

    function h($original_Str) {
        return htmlspecialchars($original_Str, ENT_QUOTES, 'UTF-8'); 
    }

    function set_token() {
        $token = sha1(uniqid(mt_rand(),true));
        $_SESSION['CSRF_TOKEN'] = $token;
    }

    function check_token() {
        if(empty($_SESSION['CSRF_TOKEN']) || ($_SESSION['CSRF_TOKEN'] != $_POST['CSRF_TOKEN'])) {
            unset($pdo);
            header('Location:  /error.php');
            exit;
        }
    }

?>