<?php

  
  if( !empty($_GET['origin']) && 
      !empty($_GET['destination']) && 
      !empty($_GET['date']) && 
      !empty($_GET['passengers'])
  ){

    require_once "../database.php";
    try{
      //prepare search query statement 
    
        $stmt = $db->prepare('SELECT * FROM flights
                              WHERE from_airport_code = :sOriginAirport  AND to_airport_code = :sDestinationAirport AND departure_day =:sDepartureDay ORDER BY id ASC');
    
        // bind the values
        $stmt->bindValue( ':sOriginAirport', $_GET['origin']);
        $stmt->bindValue( ':sDestinationAirport', $_GET['destination']);
        $stmt->bindValue( ':sDepartureDay', $_GET['date']);
        
        //execute the query
        $stmt->execute();
        
        //fetch the flight that matches the search query 
        $aFlights = $stmt->fetchAll();

            if( count($aFlights) ){
                echo '{"status": 1, "message": "flight found"}';
                // echo json_encode($aFlights);
                session_start();
                $_SESSION['flightSearch'] = $aFlights;
                $_SESSION['passengerCount'] = $_GET['passengers'];
                exit;
            }
        
        echo '{"status": 0, "message": "no flight found"}';
    }catch( PDOException $ex ){
      echo '{"status": 0, "message": "error"}';
    }
  }
?>