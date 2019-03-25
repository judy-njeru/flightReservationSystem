<?php

  
  if( !empty($_GET['origin']) && 
      !empty($_GET['date']) && 
      !empty($_GET['price'])
  ){

    require_once "../database.php";
    try{
      //prepare search query statement 
    
        $stmt = $db->prepare('SELECT * FROM flights
                              WHERE to_airport_code = :sDestinationAirport  AND economy_price = :sPrice AND departure_day =:sDepartureDay ORDER BY id ASC LIMIT 1');
    
        // bind the values
        $stmt->bindValue( ':sDestinationAirport', $_GET['origin']);
        $stmt->bindValue( ':sPrice', $_GET['price']);
        $stmt->bindValue( ':sDepartureDay', $_GET['date']);
        
        //execute the query
        $stmt->execute();
        
        //fetch the flight that matches the search query 
        $aBookNowFlights = $stmt->fetchAll();

            if( count($aBookNowFlights) ){
                echo '{"status": 1, "message": "flight found"}';
                // echo json_encode($aFlights);
                session_start();
                $_SESSION['flightBooking'] = $aBookNowFlights;
                // $_SESSION['passengerCount'] = $_GET['passengers'];
                exit;
            }
        
        echo '{"status": 0, "message": "no flight found"}';
    }catch( PDOException $ex ){
      echo '{"status": 0, "message": "error"}';
    }
  }
?>