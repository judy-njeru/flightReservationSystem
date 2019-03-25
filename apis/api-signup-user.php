<?php


  // check that the user has passed the expected values 

  if( filter_var($_POST['txtUserEmail'], FILTER_VALIDATE_EMAIL) &&
      !empty($_POST['txtUserFirstName']) &&
      !empty($_POST['txtUserLastName']) &&
      !empty($_POST['txtUserPassword']) &&
      !empty($_POST['txtUserConfirmPassword'])&&
      strlen($_POST['txtUserPassword']) >= 2 &&
      strlen($_POST['txtUserPassword']) <= 20 &&
      ( $_POST['txtUserPassword'] == $_POST['txtUserConfirmPassword'] ) 
  ){
    require_once "../database.php";

    try{
      //prepare query statement for an insert into table passengers
      $stmt = $db->prepare('INSERT INTO passengers
                            VALUES (NULL, :sFirstName, :sLastName, :sEmail, :sPassword, 1,  CURRENT_TIMESTAMP);');

      
      //bind the values
      $stmt->bindValue( ':sFirstName', $_POST['txtUserFirstName'] );
      $stmt->bindValue( ':sLastName', $_POST['txtUserLastName'] );
      $stmt->bindValue( ':sEmail', $_POST['txtUserEmail'] );
      $stmt->bindValue( ':sPassword', $_POST['txtUserPassword'] );
     
      //execute the query
      $stmt->execute();
   
      //Row count
      if( $stmt->rowCount()){
        echo '{"status": 1, "message": "sign up successfull"}';
        //get last user inserted id
        $iUserID = $db->lastInsertId();

        try{
          //prepare query statement for an insert into table passengers
            $stmt = $db->prepare('SELECT * FROM passengers
                                  WHERE id= :sUserID LIMIT 1');


          //bind the values
          $stmt->bindValue( ':sUserID', $iUserID );

          //execute the query
          $stmt->execute();

          $aUser = $stmt->fetchAll();
         
        }catch(PDOException $ex ){
          echo '{"status": 0, "message": "error"}';
        }

        session_start();
        $_SESSION['aUser'] = $aUser;
        $_SESSION['userID'] = $iUserID;
        exit;
      }
      echo '{"status": 0, "message": "sign up error"}';
    }catch( PDOException $ex ){
      echo '{"status": 0, "message": "cannot signup"}';
    }
    exit;
  }

  
