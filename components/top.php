<?php  
    session_start();

    if( !$_SESSION['user'] ) {
        header("location: ../views/landing.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aerova Airline</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../css/main.css">

      <link rel="stylesheet" href="../css/<?= $sLinkToCss; ?>.css">
      <style>
          .nav-wrapper {
            background-color: #6610f2;
          }
      </style>
</head>
<body id="<?= $sBodyID; ?>">

<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="">Profile</a></li>
  <li><a href="reservations.php">Reservations</a></li>
  <li class="divider"></li>
  <li><a id="btnLogoutUser" href="">Logout</a></li>
</ul>
<nav>
  <div class="nav-wrapper">
    <a href="../views/landing.php" class="brand-logo">
        <img src="../images/aerova-white.png" alt="logo image">
    </a>
    <ul class="right hide-on-med-and-down">
      <li>
          <h1>Welcome   <?php 
                $aUser = $_SESSION['user'];
                foreach ($aUser as $user) {
                    echo $user['first_name'];
                }
            ?></h1>
      </li>
      <!-- Dropdown Trigger -->
      <li>
            <a class="dropdown-trigger" href="" data-target="dropdown1">
            <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" class="rounded-circle z-depth-0" alt="avatar image">

              <i class="material-icons right">arrow_drop_down</i>
            </a>
        </li>
    </ul>
  </div>
</nav>
<!-- <nav>
 <div class="nav-wrapper">
  <a href="#!" class="brand-logo">Logo</a>
  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
  <ul class="right hide-on-med-and-down">
   <li><a href="sass.html">Sass</a></li>
   <li><a href="badges.html">Components</a></li>
   <li>Welcome,  
            <?php 
                $aUser = $_SESSION['user'];
                foreach ($aUser as $user) {
                    echo $user['first_name'];
                }
            ?></li>
   <li><div><a href="../apis/api-logout-user.php">Logout</a></div></li>
  </ul>
  <ul class="side-nav" id="mobile-demo">
   <li><a href="sass.html">Sass</a></li>
   <li><a href="badges.html">Components</a></li>
   <li><a href="collapsible.html">Javascript</a></li>
   <li><div><a href="../apis/api-logout-user.php">Logout</a></div></li>
  </ul>
 </div>
</nav> -->
