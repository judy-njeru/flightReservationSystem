<?php
  ini_set('display_errors', 1);
  // check that the user has passed the expected values 
  if( !empty($_GET['txtUserEmail']) && 
      !empty($_GET['txtUserPassword']) && 
      filter_var($_GET['txtUserEmail'], FILTER_VALIDATE_EMAIL) &&
      strlen($_GET['txtUserPassword']) >= 6 &&
      strlen($_GET['txtUserPassword']) <= 20
  ){
    require_once "../database.php";

    try{
      //prepare query statement for an insert into table passengers
      $stmt = $db->prepare('SELECT * FROM passengers 
                            WHERE email = :sEmail AND password = :sPassword AND active = 1 LIMIT 1');

      //bind the values
      $stmt->bindValue( ':sEmail', $_GET['txtUserEmail'] );
      $stmt->bindValue( ':sPassword', $_GET['txtUserPassword'] );
      
      //execute the query
      $stmt->execute();
    
      //fetch the user who matches the query statement
      $aUser = $stmt->fetchAll();

      session_start();
 
      if( count($aUser) ){
        foreach ($aUser as $user) {
          // $_SESSION['userID'] = $aUser[0]['id'];
          unset($aUser[0]['password']); 
          $_SESSION['user'] = $aUser; 
        }
        
        echo '{"status":1, "message":"login success"}';
        exit;
        }
    
      echo '{"status": 0, "message": "sign up error"}';
    }catch( PDOException $ex ){
      echo '{"status": 0, "message": "cannot signup"}';
    }
  }
?>