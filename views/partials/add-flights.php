
<?php  
    $sLinkToMainCss = "main";
    $sLinkToPageCss = 'flights';
    $sLinkToScript = 'admin';
    $flightsLink ="./admin.php";
    $routesLink ="./view-routes.php";
    $aircraftsLink ="./view-aircrafts.php";
    $airportsLink ="./view-airports.php";
    $reservationsLink ="./reservations.php";
    require_once '../components/top.php';
?>

    <?php require_once '../components/topbar.php'; ?>

    <?php require_once '../components/sidebar.php'; ?>   
    <div id="registerFlight">
    <section class="routes">
        <div class="routeView">
            <div id=stop></div>
            <div id="wrapper">
                <div class="route-dropdown route_click">
                    <div class="selected">
                        <span id="routeID" class="flightRouteID">Please select</span>
                    </div>
                    <div class="drop-content route-content">
                        <ul>
                            <?php  
                                require_once '../../database.php';
                                try{
                                    $stmt = $db->prepare('select * from flight_routes_airport');

                                    $stmt->execute();
                                
                                    $aFlightRoutes = $stmt->fetchAll();
                                    
                                    foreach ($aFlightRoutes as $flightRoute) {
                                        // echo json_encode($airport);
                                        echo '<li class="flight-airport" data-value='.$flightRoute['flight_route_id'].'>
                                                <div class="flight-route">
                                                    <span class="country--abbreviation" id="'.$flightRoute['origin_airport_id'].'">'.$flightRoute['origin_airport_code'].'</span>
                                                    <hl>   &nbsp |</hl>
                                                    <span class="country--name" id="'.$flightRoute['destination_airport_id'].'">'.$flightRoute['destination_airport_code'].'</span>
                                                </div>
                                                
                                            </li>';
                                    }
                                    
                                } catch( PDOException $ex ){
                                    echo '{"status": 0, "message": "error"}';
                                }
                            ?>      
                        </ul>
                    </div>
                </div>

                <div class="aircraft_dropdown aircraft_click">
                    <div class="selected">
                        <span>Please select</span>
                    </div>
                    <div class="drop-content aircraft-content">
                        <ul>
                            <?php  

                                require_once '../../database.php';

                                try {
                                    $stmt = $db->prepare('select * from aircraft');
                                    $stmt->execute();
                                    $aAircrafts = $stmt->fetchAll();
                                    foreach ($aAircrafts as $aircraft) {
                                        echo ' <li id="'.$aircraft['aircraft_id'].'"><span>'.$aircraft['aircraft_type'].'</span></li>';
                                    }
                                }catch( PDOException $ex ){
                                    echo '{"status": 0, "message": "error"}';
                                }
                            ?>      
                        </ul>
                    </div>
                </div>

                <div class="carrier_dropdown carrier_click">
                    <div class="selected">
                        <span>Please select</span>
                    </div>
                    <div class="drop-content carrier-content">
                        <ul>
                            <?php  

                                require_once '../../database.php';

                                try {
                                    $stmt = $db->prepare('select * from carrier');
                                    $stmt->execute();
                                    $aCarrier = $stmt->fetchAll();
                                    foreach ($aCarrier as $carrier) {
                                        echo ' <li id="'.$carrier['carrier_id'].'"><span>'.$carrier['carrier_id'].'</span></li>';
                                    }
                                } catch( PDOException $ex ){
                                    echo '{"status": 0, "message": "error"}';
                                }
                            ?>      
                        </ul>
                    </div>
                </div>
            

            <div id="formInputs">

            <div class="input-effect">
                <input class="focus-transition" type="text" placeholder="" name="txtEconomyPrice" id="txtEconomyPrice" value="2400">
                <label>Enter Economy Price</label>
                <span class="focus-bg"></span>
            </div>

            <div class="input-effect">
                <input class="focus-transition" type="text" placeholder="" nname="txtBusinessPrice" id="txtBusinessPrice" value="5600">
                <label>Enter Business Price</label>
                <span class="focus-bg"></span>
            </div>

            <div class="input-effect">
                <input class="focus-transition" type="text" placeholder="" name="txtEconomyCapacity" id="txtEconomyCapacity" value="90">
                <label>Enter Economy Capacity</label>
                <span class="focus-bg"></span>
            </div>

            <div class="input-effect">
                <input class="focus-transition" type="text" placeholder="" name="txtBusinessCapacity" id="txtBusinessCapacity" value="34">
                <label>Enter Business Capacity</label>
                <span class="focus-bg"></span>
            </div>

            <div class="input-effect">
                <input class="focus-transition" type="text" placeholder="" name="txtDepartureTime" id="txtDepartureTime" value="15:10:00">
                <label>Enter Departure Time</label>
                <span class="focus-bg"></span>
            </div>

            <div class="input-effect">
                <input class="focus-transition" type="text" placeholder="" name="txtArrivalTime" id="txtArrivalTime" value="17:10:00">
                <label>Enter Arrival Time</label>
                <span class="focus-bg"></span>
            </div>

            <div class="input-effect">
                <input class="focus-transition" type="text" placeholder="" name="txtDepartureDay" id="txtDepartureDay" value="2019-05-20">
                <label>Enter Departure Day</label>
                <span class="focus-bg"></span>
            </div>

           
            </div>
            
        



                <button class="add-flight  mdc-button--raised addRoute" id="btnAddFlight"> Add Flight</button>
            </div>
        </section>
    </div> 
    

<?php  
    require_once ("../components/bottom.php");
?>

   