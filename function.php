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
        } else {
            return "00:00";
        }
    }
?>