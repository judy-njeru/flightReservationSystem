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
         
                    <form  id="frmAddFlight" >

                        <div class="airportContainer"> 

                        <div id="origin_airport">
                        <div class="autocomplete-drop-down">
                            <div class="origin-input-container">
                                    <input class="origin-input" placeholder="Flight Route" type="text">
                                    <div class="input-underline"></div>
                                <span class="input-arrow">&#9662;</span>
                            </div>
                        </div>

                        <div class="origin-airport-container">  
                            <ul class="airports-list"> 
                                <?php  
                                    require_once '../../database.php';
                                    try{
                                        $stmt = $db->prepare('select * from flight_routes_airport');

                                        $stmt->execute();
                                    
                                        $aFlightRoutes = $stmt->fetchAll();
                                        
                                        foreach ($aFlightRoutes as $flightRoute) {
                                            // echo json_encode($airport);
                                            echo '<li class="flight-airport" data-value='.$flightRoute['flight_route_id'].'>
                                                    <span class="country--abbreviation" id="'.$flightRoute['origin_airport_id'].'">'.$flightRoute['origin_airport_code'].'</span>| &nbsp
                                                    <span class="country--name" id="'.$flightRoute['destination_airport_id'].'">'.$flightRoute['destination_airport_code'].'</span>
                                                </li>';
                                        }
                                        
                                    }catch( PDOException $ex ){
                                        echo '{"status": 0, "message": "error"}';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div><!--end origin airport-->

                        
                               

                           
                            <select id="aircraftIDSelect" style="width:66%; height: 30px;">
                                
                                <option value="0">Select Aircraft:</option>
                                <?php  
                                    require_once '../../database.php';
                                    try{
                                        $stmt = $db->prepare('select * from aircraft');

                                        $stmt->execute();
                                    
                                        $aAircrafts = $stmt->fetchAll();
                                        
                                        foreach ($aAircrafts as $aircraft) {
                                            // echo json_encode($aircraft);
                                            echo '
                                            
                                            <option class="selectOption" value="'.$aircraft['aircraft_id'].'">'.$aircraft['aircraft_type'].'</option><a href="#"></a>';
                                
                                        }
                                        
                                    }catch( PDOException $ex ){
                                        echo '{"status": 0, "message": "error"}';
                                    }
                                ?>      
                            </select>
                     


            
                            <select id="carrierIDSelect" style="width:66%; height: 30px;">
                                
                                <option value="0">Select Carrier ID:</option>
                                <?php  
                                    require_once '../../database.php';
                                    try{
                                        $stmt = $db->prepare('select * from carrier');

                                        $stmt->execute();
                                    
                                        $aCarrier = $stmt->fetchAll();
                                        
                                        foreach ($aCarrier as $carrier) {
                                            // echo json_encode($airport);
                                            echo '
                                            <option value="'.$carrier['carrier_id'].'">'.$carrier['carrier_id'].'</option><a href="#"></a>';
                                
                                        }
                                        
                                    }catch( PDOException $ex ){
                                        echo '{"status": 0, "message": "error"}';
                                    }
                                ?>      
                            </select>
                           

                            <div>
                                <!-- <label for="economy_price"><b>Economy Price</b></label> -->
                                <input type="text" placeholder="Enter Economy Price" name="txtEconomyPrice" id="txtEconomyPrice">
                            </div>
                            
                            <div>
                                <!-- <label for="business_price"><b>Business Price</b></label> -->
                                <input type="text" placeholder="Enter Business Price" name="txtBusinessPrice" id="txtBusinessPrice">
                            </div>

                            <div>
                                <!-- <label for="economy_capacity"><b>Economy Capacity</b></label> -->
                                <input type="text" placeholder="Enter Economy Capacity" name="txtEconomyCapacity" id="txtEconomyCapacity">
                            </div>

                            <div>
                                <!-- <label for="business_capacity"><b>Business Capacity</b></label> -->
                                <input type="text" placeholder="Enter Business Capacity" name="txtBusinessCapacity" id="txtBusinessCapacity">
                            </div>
                            
                            <div>
                                <!-- <label for="departure_time"><b>Departure Time</b></label> -->
                                <input type="text" placeholder="Enter Departure Time" name="txtDepartureTime" id="txtDepartureTime">
                            </div>

                            <div>
                                <!-- <label for="arrival_time"><b>Arrival Time</b></label> -->
                                <input type="text" placeholder="Enter Arrival Time" name="txtArrivalTime" id="txtArrivalTime">
                            </div>

                           <div>
                                <!-- <label for="departure_day"><b>Departure Day</b></label> -->
                                <input type="text" placeholder="Enter Departure Day" name="txtDepartureDay" id="txtDepartureDay">
                            </div> 

                        </div>        
                            
                    
                            <button id="btnAddFlight">Add Flight</button>
                  

                 </div>

            </form>
        </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/admin.js"></script>
</body>
</html>
</body>
</html>

   