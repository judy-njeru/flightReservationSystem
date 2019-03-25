<?php  
    $sLinkToCss = 'landing';
    $sLinkToScript = 'main';
    session_start();
    if( $_SESSION['user'] ) {
       header( "location: home.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aerova</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,700,900|Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/<?= $sLinkToCss; ?>.css"  />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/login.css"  />
</head>
<body>
    <div id="loginNav">
        <a href="signup.php"> 
            <div id="signUp">SIGNUP</div>
        </a>
        <a href="">
            <div id="adminLogin">ADMIN</div>
        </a>
        
    </div>
    <div class="container">
    
        <div id="fullHeightContainer">
            <div id="leftAlign">
                <h1>AE<span>ROVA</span></h1>
            </div>

            <div class="loginContainer">
                <div id="boxLogin">
                    <form id="frmLoginUser">
                        <input name="txtUserEmail" type="text" placeholder="email" value="j@gmail.com">
                        <input name="txtUserPassword" class="marginTop10" type="password" placeholder="password" value="1234567">
                        <button class="marginTop10">login</button>
                    </form>
                </div>
            </div>
           
        </div>
        
    


<?php  
    require_once ("../components/bottom.php");
?>
