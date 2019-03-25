<?php

  if( !empty($_POST['txtCarrierID']) &&
      !empty($_POST['txtAircraftModel']) &&
      !empty($_POST['txtTailNumber']) 
  ){
    
    require_once "../../database.php";
 
    try{
      //prepare query statement for an insert into table aircraft
      $stmt = $db->prepare('INSERT INTO aircraft
                            VALUES (NULL, :sCarrierID, :sAircraftModel, :sTailNumber)');

      
      //bind the values
      $stmt->bindValue( ':sCarrierID', $_POST['txtCarrierID'] );
      $stmt->bindValue( ':sAircraftModel', $_POST['txtAircraftModel'] );
      $stmt->bindValue( ':sTailNumber', $_POST['txtTailNumber'] );
     
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

  
