
<?php 

    session_start();
    if( !$_SESSION['user'] ) {
       header( "location: landing.php");
    }
    $sBodyID = 'home';
    $sLinkToCss = 'styles';
    $sLinkToScript = 'home';
    require_once ("../components/top.php");
    
?>

<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-4 mb-4">
      <div class="card h-100">
        <div class="row">
          <div class="col-lg-12 mb-12">
            <div class="origin-dropdown origin_click">
              <div class="selected">
                <span id="routeID" class="flightRouteID originCity">Please select</span>
              </div>
              <div class="drop-content origin-content">
                <ul>
                  <?php  
                    require_once '../database.php';
                    try{
                      $stmt = $db->prepare('select * from airport');

                      $stmt->execute();
                  
                      $aAirports = $stmt->fetchAll();
                      
                      foreach ($aAirports as $airport) {
                          // echo json_encode($airport);
                          echo '<li class="origin-airport" data-value='.$airport['id'].'>
                                  <span class="country--abbreviation">'.$airport['airport_code'].'</span> 
                                  <span class="country--name">'.$airport['city'].'</span>
                              </li>';
                    }
                          
                    } catch ( PDOException $ex ){
                      echo '{"status": 0, "message": "error"}';
                    }
                  ?>      
                </ul>
              </div>
            </div>
          </div><!-- close col-->

          <div class="col-lg-12 mb-12">
            <div class="destination-dropdown destination_click">
              <div class="selected">
                  <span id="routeID" class="flightRouteID destinationAirport">Please select</span>
              </div>
              <div class="drop-content destination-content">
                <ul>
                  <?php  
                    require_once '../database.php';
                    try{
                      $stmt = $db->prepare('select * from airport');

                      $stmt->execute();
                  
                      $aAirports = $stmt->fetchAll();
                      
                      foreach ($aAirports as $airport) {
                          echo '<li class="destination-airport" data-value='.$airport['id'].'>
                                  <span class="country--abbreviation">'.$airport['airport_code'].'</span> 
                                  <span class="country--name">'.$airport['city'].'</span>
                                </li>';
                      }
                        
                    } catch ( PDOException $ex ){
                        echo '{"status": 0, "message": "error"}';
                    }
                  ?>      
                </ul>
              </div>
            </div>
          </div><!-- close col-->
          <div class="col-lg-12 mb-12 datePicker">
            <label>
              <input type="text" class="dateselect" required="required"/>
              <span>Date</span>
            </label>
          </div>

          <div class="col-lg-12 mb-12 ">
            <select id="year">
              <option value="hide">-- Guests --</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>

          <div class="col-lg-12 mb-12 ">
            <div class="searchFlight">
              <button class="btnSearchFlight btn-lightBlue ripple-effect">Search</button>
            </div>
          </div>
        </div><!-- close cardrow-->
      </div> <!-- close card-->
    </div><!-- close col-->
    <div class="col-lg-8 mb-4 flightOffers">
      <div class="row">
        <div class="col-lg-12 mb-12 card-title">
          <h1>Best flight offers in Denmark!</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 mb-12 flights_list">
          <div class="flight_information">
            <?php  
              require_once '../database.php';
              try{
                $stmt = $db->prepare('SELECT id,destination_city, origin_city, to_airport_code, from_airport_code, destination_city_id, economy_price, departure_day FROM flights LIMIT 4');

                $stmt->execute();
            
                $aFlights = $stmt->fetchAll();
                
                foreach ($aFlights as $flight) {
                  echo  '<ul data-value='.$flight['id'].'>
                          <li class="destinationAirport" id="'.$flight['to_airport_code'].'" data-cityId="'.$flight['destination_city_id'].'">'.$flight['destination_city'].'</li>
                          <li id="flightPrice">'.$flight['economy_price'].'</li>
                          <li id="flightDay">'.$flight['departure_day'].'</li>
                          <li>
                            <div class="searchFlight">
                              <span id="'.$flight['from_airport_code'].'" data-cityId="'.$flight['origin_city'].'"></span>
                              <button class="btnBookFlight btn-lightBlue ripple-effect">Book Now</button>
                            </div>
                          </li>
                        </ul>';
                }
                
              } catch ( PDOException $ex ){
                  echo '{"status": 0, "message": "error"}';
              }
            ?>      
          </div>
        </div>
      </div>
      <div class="row flight_policy">
        <div class="col-lg-6 mb-6">
          <p> * One-way trip including all taxes, fees and carrier charges</p>
        </div>
        <div class="col-lg-6 mb-6">
          <p>See all</p>
        </div>
      </div>
    </div>
  </div>
  <!-- /.row -->
  <section id="reservations">
    <div class="row">
      <div class="col-lg-4 mb-4">
        <div class="row ">
          <div class="col-lg-12 mb-12">
            <h2>My Reservations</h2>
          </div>
        
          <div class="row input-details">
            <div class="col-lg-6 mb-6">
              <fieldset class="material">
                <input type="text" name="txtfirstName" placeholder="" autocomplete="off" required>
                <hr>
                <label>First Name</label>
              </fieldset>
            </div>
            <div class="col-lg-6 mb-6">
            <fieldset class="material">
                <input type="text" name="txtReservationID" placehoder="ReservationID" autocomplete="off" required>
                <hr>
                <label>Reservation ID</label>
              </fieldset>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 mb-8">
        <div class="row reservationList">
          <?php  
            require_once '../database.php';
            try{
              $stmt = $db->prepare('select * from booked_reservations limit 3');

              $stmt->execute();
          
              $Reservations = $stmt->fetchAll();
              
              foreach ($Reservations as $reservation) {
                  // echo json_encode($airport);
                  echo '<div class="col-lg-4 mb-4 card-city">
                          <div class="card">
                            <img src="'.$reservation['image_url'].'" alt="billund">
                          </div>
                          <h3>'.$reservation['city'].'</h3>
                        </div>';
              }
                
            }catch( PDOException $ex ){
                echo '{"status": 0, "message": "error"}';
            }
          ?> 
        </div>
      </div>
      <div class="row">
          <div class="col-lg-12 mb-12 goto-booking">
            <h4>Go</h4>
            <div class="arrow"></div>
          </div> 
        </div>
    </div>
  </section>
</div>
<!-- /.container -->

<?php  
  require_once ("../components/bottom.php");
?>