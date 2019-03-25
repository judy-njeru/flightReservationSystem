<?php  
    session_start();
    session_destroy();
    
    // if( isset( $_SESSION['aUser']) || isset( $_SESSION['user']) ){
    //     session_destroy();
    // }
    // header("location: ../views/landing.php");
    echo '{"status": 1, "message": "success"}';
    exit;