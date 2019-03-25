<?php

  if( !empty($_GET['flightID']) 
  ){
    
    require_once "../../database.php";
 
    try{
      //prepare query statement for deleting a record from flight_instance table
      $stmt = $db->prepare('DELETE FROM flight_instance
                            WHERE id = :sFlightID');

      //bind the values
      $stmt->bindValue( ':sFlightID', $_GET['flightID'] );

      //execute the query
      $stmt->execute();
   
      //Row count
      if( $stmt->rowCount()){
        echo '{"status": 1, "message": "flight was successfull cancelled"}';
        //get last user inserted id
        exit;
      }
      echo '{"status": 0, "message": "flight cancellation error"}';
    }catch( PDOException $ex ){
      echo '{"status": 0, "message": "cannot cancel flight"}';
    }
    exit;
  }

  
