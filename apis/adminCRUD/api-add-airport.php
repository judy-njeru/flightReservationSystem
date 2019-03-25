<?php

  if( !empty($_POST['txtAirportName']) &&
      !empty($_POST['txtAirportCode']) &&
      !empty($_POST['txtAirportCity']) &&
      !empty($_POST['txtAirportRegion'])
  ){
    
    require_once "../../database.php";
 
    try{
      //prepare query statement for an insert into table airport
      $stmt = $db->prepare('INSERT INTO airport
                            VALUES (NULL, :sAirportName, :sAirportCode, :sAirportCity, :sAirportRegion)');

      
      //bind the values
      $stmt->bindValue( ':sAirportName', $_POST['txtAirportName'] );
      $stmt->bindValue( ':sAirportCode', $_POST['txtAirportCode'] );
      $stmt->bindValue( ':sAirportCity', $_POST['txtAirportCity'] );
      $stmt->bindValue( ':sAirportRegion', $_POST['txtAirportRegion'] );
     
      //execute the query
      $stmt->execute();
   
      //Row count
      if( $stmt->rowCount()){
        echo '{"status": 1, "message": "insert was successfull"}';
        //get last user inserted id
  
        exit;
      }
      echo '{"status": 0, "message": "insert error"}';
    }catch( PDOException $ex ){
      echo '{"status": 0, "message": "cannot insert"}';
    }
    exit;
  }

  
