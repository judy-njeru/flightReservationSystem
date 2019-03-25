<?php

  if( !empty($_POST['flightID']) &&
      !empty($_POST['departureTime']) &&
      !empty($_POST['arrivalTime']) &&
      !empty($_POST['flightDay']) 
  ){
    
    require_once "../../database.php";
 
    try{
      //prepare query statement to update flight_instance table
      $stmt = $db->prepare('UPDATE flight_instance
                            SET departure_time = :sDepartureTime, arrival_time = :sArrivalTime, 
                            departure_day = :sDepartureDay
                            WHERE id = :sFlightID');

      //bind the values
      $stmt->bindValue( ':sFlightID', $_POST['flightID'] );
      $stmt->bindValue( ':sDepartureTime', $_POST['departureTime'] );
      $stmt->bindValue( ':sArrivalTime', $_POST['arrivalTime'] );
      $stmt->bindValue( ':sDepartureDay', $_POST['flightDay'] );

     
      //execute the query
      $stmt->execute();
   
      //Row count
      if( $stmt->rowCount()){
        echo '{"status": 1, "message": "update was successfull"}';
        //get last user inserted id
        exit;
      }
      echo '{"status": 0, "message": "update error"}';
    }catch( PDOException $ex ){
      echo '{"status": 0, "message": "cannot update"}';
    }
    exit;
  }

  
