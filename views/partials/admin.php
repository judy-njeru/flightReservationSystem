<?php  
    // $sLinkToAdminCss = 'admin';
    $sLinkToMainCss = "main";
    $sLinkToPageCss = 'flights_view';
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
    <a href="./add-flights.php">
        <button class="create mdc-button--raised addsFlight"> CREATE</button>
    </a>
    
   
    <div id="flightsView">
    <section class="flights">
        <div class="flightView">
            <table id="testy">
                <tr>
                    <th>Flight <br>  Number</th>
                    <th>Origin <br> Airport</th>
                    <th>Destination <br> Airport</th>
                    <th>Departure <br> Time</th>
                    <th>Arrival <br>  Time</th>
                    <th>Flight Day</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </tr>
      
                <?php  
                    require_once '../../database.php';
                    
                    try {
                        $stmt = $db->prepare('CALL getAllFlights()');

                        $stmt->execute();
                    
                        $aFlights = $stmt->fetchAll();
                        
                        foreach ($aFlights as $flight) {
                            echo   '<tr class="flight flightID" id="'.$flight['id'].'">
                                        <td>'.$flight['id'].'</td>
                                        <td>'.$flight['from_airport_code'].'</td>
                                        <td>'.$flight['to_airport_code'].'</td>
                                        <td class="editableDiv departureTime">'.$flight['departure_time'].'</td>
                                        <td class="editableDiv arrivalTime">'.$flight['arrival_time'].'</td>
                                        <td class="editableDiv flightDay">'.$flight['departure_day'].'</td>
                                        <td class="editFlight"><svg class="editFlight" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/><path d="M0 0h24v24H0z" fill="none"/></svg></td>
                                        <td class="btnCancelFlight"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/><path d="M0 0h24v24H0z" fill="none"/></svg></td>
                                    </tr>';
                        }
                        
                    }catch( PDOException $ex ){
                        echo '{"status": 0, "message": "error"}';
                    }
                ?>
            </table>
        </div>
    </section>

    </div>
    

<?php  
    require_once ("../components/bottom.php");
?>













