<?php  
  $sLinkToScript = 'main';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aerova : : SignUp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="../css/signup.css">
  <link rel="stylesheet" href="../css/landing.css">
  <link rel="stylesheet" href="../css/main.css">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
</head>
<body>

  <div id="loginNav">
    <a href="landing.php"> 
        <div id="signUp">SIGNIN</div>
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

        <div class="signupContainer">
          <div id="boxSignUp">
            <form id="frmSignUpUser">
                <input name="txtUserFirstName" type="text" placeholder="First Name">
                <input name="txtUserLastName" type="text" placeholder="Last Name">
                <input name="txtUserEmail" type="text" placeholder="email">
                <input name="txtUserPassword" class="marginTop10" type="password" placeholder="password(2-20 characters)">
                <input name="txtUserConfirmPassword" class="marginTop10" type="password" placeholder="confirm password (2-20 characters)">
                <button class="marginTop10">signup</button>
            </form>
          </div>
        </div>
          
      </div>

  <?php  
    require_once ("../components/bottom.php");
  ?>

        
</body>
</html>