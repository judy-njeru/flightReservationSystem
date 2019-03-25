<?php

  if( !empty($_POST['flightRouteID']) &&
      !empty($_POST['aircraftID']) &&
      !empty($_POST['carrierID']) &&
      !empty($_POST['originAirportID']) &&
      !empty($_POST['destinationAirportID']) &&
      !empty($_POST['originCityId']) &&
      !empty($_POST['destinationCityId']) &&
      !empty($_POST['economyPrice']) &&
      !empty($_POST['businessPrice']) &&
      !empty($_POST['economyCapacity']) &&
      !empty($_POST['businessCapacity']) &&
      !empty($_POST['departureTime']) &&
      !empty($_POST['arrivalTime']) &&
      !empty($_POST['flightDay']) 
  ){

    require_once "../../database.php";
    
    $db->beginTransaction();
    
    try{
      //prepare query statement for an insert into flight_instance table
      $stmt = $db->prepare('INSERT INTO flight_instance
                            VALUES (NULL, :sFlightRouteID, :sAircraftID, :sCarrierID, :sOriginCity, 
                            :sDestinationCity, :sOriginAirport, :sDestinationAirport, 
                            :sEconomyPrice, :sBusinessPrice, :sEconomyCapacity, :sBusinessCapacity, 
                            :sFlightIDEconomySeatAvailability, :sFlightIDBusinessSeatAvailability, 
                            :sDepartureTime, :sArrivalTime, :sDepartureDay)');
      
      //bind the values
      $stmt->bindValue( ':sFlightRouteID', $_POST['flightRouteID'] );
      $stmt->bindValue( ':sAircraftID', $_POST['aircraftID'] );
      $stmt->bindValue( ':sCarrierID', $_POST['carrierID'] );
      $stmt->bindValue( ':sOriginCity', $_POST['originAirportID'] );
      $stmt->bindValue( ':sDestinationCity', $_POST['destinationAirportID'] );
      $stmt->bindValue( ':sOriginAirport', $_POST['originCityId'] );
      $stmt->bindValue( ':sDestinationAirport', $_POST['destinationCityId'] );
      $stmt->bindValue( ':sEconomyPrice', $_POST['economyPrice'] );
      $stmt->bindValue( ':sBusinessPrice', $_POST['businessPrice'] );
      $stmt->bindValue( ':sEconomyCapacity', $_POST['economyCapacity'] ); 
      $stmt->bindValue( ':sBusinessCapacity', $_POST['businessCapacity'] );
      $stmt->bindValue( ':sFlightIDEconomySeatAvailability', $_POST['flightRouteID'] ); 
      $stmt->bindValue( ':sFlightIDBusinessSeatAvailability', $_POST['flightRouteID'] );
      $stmt->bindValue( ':sDepartureTime', $_POST['departureTime'] );
      $stmt->bindValue( ':sArrivalTime', $_POST['arrivalTime'] );
      $stmt->bindValue( ':sDepartureDay', $_POST['flightDay'] );
     
     
      //execute the query
      $stmt->execute();

      $iFlightId = $db->lastInsertId();

      // //Row count
      // if( $stmt->rowCount()){
      //   echo '{"status": 1, "message": "insert was successfull"}';
      //   //get last user inserted id
      //   exit;
      // }
      // echo '{"status": 0, "message": "insert error"}';
    }catch( PDOException $ex ){
      echo '{"status": 0, "message": "cannot insert"}';
      $db->rollBack();
      exit;
    }

    try{
      //prepare query statement for an insert into table reservations table
      $stmt = $db->prepare('INSERT INTO economy_seat_available
                            VALUES (NULL, :sSeatClass, :sFlightID, :sEconomySeatCapacity)');
                            
      //bind the values
      $stmt->bindValue( ':sSeatClass', 1 );
      $stmt->bindValue( ':sFlightID', $iFlightId);
      $stmt->bindValue( ':sEconomySeatCapacity', $_POST['economyCapacity'] );
      
      //execute the query
      $stmt->execute();
      $iclassId = $db->lastInsertId();
  
    }catch( PDOException $ex ){
      echo '{"status": 0, "message": "cannot insert error"}';
      $db->rollBack();
      exit;
    }


    try{
      //prepare query statement for an insert into table reservations table
      $stmt = $db->prepare('INSERT INTO business_seats_available
                            VALUES (NULL, :sSeatClass, :sFlightID, :sBusinessSeatCapacity)');
                            
      //bind the values
      $stmt->bindValue( ':sSeatClass', 2 );
      $stmt->bindValue( ':sFlightID', $iFlightId);
      $stmt->bindValue( ':sBusinessSeatCapacity', $_POST['businessCapacity'] );
      
      //execute the query
      $stmt->execute();
     
      //Row count
      if( $stmt->rowCount()){
          $db->commit();
          echo '{"status": 1, "message": "insert was successfull"}';
          exit;
      }
      $db->rollBack();
    }catch( PDOException $ex ){
      echo '{"status": 0, "message": "cannot insert error"}';
      $db->rollBack();
      exit;
    }
    
  }

  
