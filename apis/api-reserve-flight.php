<?php

  if( !empty($_POST['userID']) &&
      !empty($_POST['flightID']) &&
      !empty($_POST['seatsReserved']) &&
      !empty($_POST['flightOrigin']) &&
      !empty($_POST['flightDestination']) &&
      !empty($_POST['flightDate']) &&
      !empty($_POST['totalPrice'])  &&
      !empty($_POST['reservedFlightClass'])
      ){
    

    
    require_once "../database.php";

    $db->beginTransaction();

    try{
      //prepare query statement for an insert into table reservations table
      $stmt = $db->prepare('INSERT INTO flight_reservations
                            VALUES (NULL, :sPassengerID, :sFlightID, :sSeatClass, :sPassengerCount, :sOriginCity, :sDestinationCity, :sFlightDay, :sTotalPrice)');

      //bind the values
      $stmt->bindValue( ':sPassengerID', $_POST['userID'] );
      $stmt->bindValue( ':sFlightID', $_POST['flightID'] );
      $stmt->bindValue( ':sSeatClass', $_POST['reservedFlightClass'] );
      $stmt->bindValue( ':sPassengerCount', $_POST['seatsReserved'] );
      $stmt->bindValue( ':sOriginCity', $_POST['flightOrigin'] );
      $stmt->bindValue( ':sDestinationCity', $_POST['flightDestination'] );
      $stmt->bindValue( ':sFlightDay', $_POST['flightDate'] );
      $stmt->bindValue( ':sTotalPrice', $_POST['totalPrice'] );
      
      //execute the query
      $stmt->execute();
   
    }catch( PDOException $ex ){
      echo '{"status": 0, "message": "cannot insert error"}';
      $db->rollBack();
      exit;
    }


    try{
        //prepare query statement for an insert into table reservations table
        $stmt = $db->prepare('INSERT INTO seats_booked
                              VALUES (NULL, :sPassengerID, :sFlightID, :sSeatClass, :sSeatsReserved)');
                              
        //bind the values
        $stmt->bindValue( ':sPassengerID', $_POST['userID'] );
        $stmt->bindValue( ':sFlightID', $_POST['flightID'] );
        $stmt->bindValue( ':sSeatClass', $_POST['reservedFlightClass'] );
        $stmt->bindValue( ':sSeatsReserved', $_POST['seatsReserved'] );
      
        //execute the query
        $stmt->execute();
       
        //Row count
        if( $stmt->rowCount()){
            $db->commit();
            echo '{"status": 1, "message": "insert was successfull"}';
            //get last user inserted id
            exit;
        }
        $db->rollBack();
        echo '{"status": 0, "message": "insert error"}';
      }catch( PDOException $ex ){
        echo '{"status": 0, "message": "cannot insert error"}';
        
        exit;
      }
   
}

  
