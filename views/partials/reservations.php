<?php  
    $sLinkToAdminCss = 'admin';
    $sLinkToMainCss = "main";
    $sLinkToPageCss = 'reservations';
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
    <div id="reservationsView">
      
        <section class="routes">
            <div class="routeView">
                <table>
                    <tr>
                        <th>Flight <br> ID</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Flight <br> Date</th>
                        <th>CANCEL</th>
                    </tr>

                    <?php  
            
                        require_once '../../database.php';
                        try {
                            $stmt = $db->prepare('select * from reservations');

                            $stmt->execute();
                        
                            $aReservations = $stmt->fetchAll();

                            foreach ($aReservations as $reservation) {
                                echo    '<tr class="reservation">
                                            <td>'.$reservation['flight_id'].'</td>
                                            <td>'.$reservation['origin'].'</td>
                                            <td>'.$reservation['destination'].'</td>
                                            <td>'.$reservation['flight_date'].'</td>
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
