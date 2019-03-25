
<?php  
    $sLinkToAdminCss = 'admin';
    $sLinkToMainCss = "main";
    $sLinkToPageCss = 'routes';
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
    <div id="viewRoutes">
    <button class="create mdc-button--raised addRoute"> CREATE</button>
    <section class="routes">
        <div class="routeView">
            <table>
                <tr>
                    <th>Flight <br> Route ID</th>
                    <th>Origin <br> Airport</th>
                    <th>Destination <br> Airport</th>
                    <th>Flight <br> Duration</th>
                    <th>Distance</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </tr>

                <?php  
        
                    require_once '../../database.php';
                    try {
                        $stmt = $db->prepare('select * from flight_routes');

                        $stmt->execute();
                    
                        $aRoutes = $stmt->fetchAll();
                        
                        foreach ($aRoutes as $route) {
                            echo    '<tr class="airpo">
                                        <td>'.$route['flight_route_id'].'</td>
                                        <td>'.$route['origin_city'].'</td>
                                        <td>'.$route['destination_city'].'</td>
                                        <td>'.$route['flight_duration'].'</td>
                                        <td>'.$route['distance'].'</td>
                                        <td class="editFlight"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/><path d="M0 0h24v24H0z" fill="none"/></svg></td>
                                        <td class="deleteFlight"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/><path d="M0 0h24v24H0z" fill="none"/></svg></td>
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
        require_once ("../../../components/bottom.php");
    ?>















