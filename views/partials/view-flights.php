<?php  
    $sLinkToCss = 'partials';

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aerova</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,700,900|Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css" media="screen" href="../../css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/<?= $sLinkToCss; ?>.css"  />
</head>
<body>

 
        <div id="navbar">
            <li class="sub-menu-parent" tab-index="0">
                <a href=" ../admin.php">Administration</a>
                <ul class="sub-menu">
                    <li><a href="./add-flights.php">Add Flights</a></li>
                    <li><a href="#">Add Route</a></li>
                    <li><a href="#">Add Aircraft</a></li>
                    <li><a href="#">Add Airport</a></li>
                </ul>
            </li>
            <li class="sub-menu-parent" tab-index="0">
                <a href="#">Views</a>
                <ul class="sub-menu">
                    <li><a href="view-flights.php">View Flights</a></li>
                    <li><a href="view-routes.php">View Routes</a></li>
                    <li><a href="view-aircrafts.php">View Aircrafts</a></li>
                    <li><a href="view-airports.php">View Airports</a></li>
                    <li><a href="#">View Reservations</a></li>
                    <li><a href="#">View Passengers</a></li>
                </ul>
            </li>
            <li class="sub-menu-parent" tab-index="0">
                <a href="#">Account</a>
                <ul class="sub-menu">
                    <li><a href="#">View Account</a></li>
                    <li><a href="#">Add Admin</a></li>
                </ul>
            </li>
            <div><a href="../apis/api-logout-user.php">Logout</a></div>
        </div>

        <div id=pageWrapper>
       
            <div id="flights">
                <div class="flightsHeader">
                    <div>Flight <br>  Number</div>
                    <div>Origin <br> Airport</div>
                    <div>Destination <br> Airport</div>
                    <div>Departure <br> Time</div>
                    <div>Arrival <br>  Time</div>
                    <div>Flight Day</div>
                    <div>Economy <br> Price</div>
                    <div>Business <br> Price</div>
                    <div>Economy <br> Capacity</div>
                    <div>Business<br>  Capacity</div>
                </div>
                <?php  
                    require_once '../../database.php';
                    
                    try{
                        $stmt = $db->prepare('CALL getAllFlights()');

                        $stmt->execute();
                    
                        $aFlights = $stmt->fetchAll();
                        
                        foreach ($aFlights as $flight) {
                            // echo json_encode($flight);
                            echo '<div class="flight flightID" id="'.$flight['id'].'">
                                    <div>'.$flight['id'].'</div>
                                    <div>'.$flight['from_airport_code'].'</div>
                                    <div>'.$flight['to_airport_code'].'</div>
                                    <div class="editableDiv departureTime" contenteditable="false">'.$flight['departure_time'].'</div>
                                    <div class="editableDiv arrivalTime" contenteditable="false">'.$flight['arrival_time'].'</div>
                                    <div class="editableDiv flightDay" contenteditable="false">'.$flight['departure_day'].'</div>
                                    <div>'.$flight['economy_price'].'</div>
                                    <div>'.$flight['business_price'].'</div>
                                    <div>'.$flight['economy_capacity'].'</div>
                                    <div>'.$flight['business_capacity'].'</div>
                                    <button class="btnEditFlight">Edit Flight</button>
                                    <button class="btnCancelFlight">Cancel Flight</button>
                                </div>';
                        }
                        
                    }catch( PDOException $ex ){
                        echo '{"status": 0, "message": "error"}';
                    }
                ?>
                
            </div>


        </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/home.js"></script>
    <script src="../../js/admin.js"></script>
</body>
</html>
</body>
</html>

   