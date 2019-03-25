<?php  
    session_start();
    if( !$_SESSION['user'] ) {
    header( "location: landing.php");
    }
    $sLinkToCss = "reservedFlights";
    require_once '../components/top.php';
?>
    <div id="reservationsView">
        <section class="routes">
            <div class="routeView">
                <table>
                    <tr>
                        <th>Flight <br> ID</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Flight <br> Date</th>
                    </tr>

                    <?php  
                    session_start();
                    $sUser = '';
                    
                    foreach($_SESSION['user'] as $user ){
                        $sUser = $user['id'];
                    }
                        require_once '../database.php';
                        
                        try {
                            $stmt = $db->prepare('SELECT * FROM user_reservations
                                                WHERE passenger_id = :sUserID');
                            
                            $stmt->bindValue(':sUserID', $sUser);
                         
                            $stmt->execute();
                        
                            $aReservations = $stmt->fetchAll();

                            foreach ($aReservations as $reservation) {
                                echo    '<tr class="reservation">
                                            <td>'.$reservation['flight_id'].'</td>
                                            <td>'.$reservation['origin'].'</td>
                                            <td>'.$reservation['destination'].'</td>
                                            <td>'.$reservation['flight_date'].'</td>
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
