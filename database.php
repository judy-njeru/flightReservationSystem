<?php
    try{

        // $sUserName = 'judynjer_judynje';
        // $sPassword = '1timberlake';
        // $sConnection = "mysql:host=50.87.144.123; dbname=judynjer_test_db; port=3306; charset=utf8mb4";
    
        $sUserName = 'root';
        $sPassword = 'root';
        $sConnection = "mysql:host=localhost; dbname=flight_reservation_system; charset=utf8mb4";

        $aOptions = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        $db = new PDO( $sConnection, $sUserName, $sPassword, $aOptions ); //php data object(PDO)
    
    }catch( PDOException $e){
        echo '{"status":"err","message":"cannot connect to database"}';
        exit();
    }



