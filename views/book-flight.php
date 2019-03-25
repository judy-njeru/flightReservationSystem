
<?php 
  session_start();
  if( !$_SESSION['user'] ) {
    header( "location: landing.php");
  }
  $sBodyID = 'flight';
  $sLinkToCss = 'reservedFlights';
  $sLinkToScript = 'flights';
  require_once ("../components/top.php");
?>

<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 mb-4 flightDetails">
      <?php 
        session_start();
        $className = 'radio-1';
        $aFlights=  $_SESSION['flightBooking'];
        foreach ($aFlights as $flight) {
          echo '<div class="card">
                  <div class="row-0">
                    <div class="col-lg-4 mb-4">departure</div>
                    <div class="col-lg-4 mb-4">Flight</div>
                    <div class="col-lg-4 mb-4">arrival</div>
                  </div>
                  <div class="row row-1">
                    <div class="col-lg-4 mb-4 departure-airport-code">
                      <h1 class="departure">'.$flight['from_airport_code'].'</h1>
                    </div>
                    <div class="col-lg-4 mb-4">
                    <div class="airplane-icon">
                      <svg width="50px" height="50px" viewBox="0 0 9 7" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g id="friend-profile" transform="translate(-160.000000, -784.000000)" fill="#000000" fill-rule="nonzero">
                                  <g id="noun_Planes_429707" transform="translate(164.000000, 787.000000) rotate(45.000000) translate(-164.000000, -787.000000) translate(160.000000, 783.000000)">
                                      <g id="Group" transform="translate(4.000000, 4.000000) scale(-1, 1) rotate(-180.000000) translate(-4.000000, -4.000000) ">
                                          <g transform="translate(-0.000000, 0.000000)" id="Shape">
                                              <g transform="translate(-0.000000, 0.000000)">
                                                  <path class="icon" d="M2.867,0.531 L2.554,1.563 C2.277,1.404 2.045,1.318 1.968,1.397 L1.966,1.397 C1.879,1.482 1.99,1.751 2.178,2.061 L1.068,2.398 C0.996,2.439 0.956,2.503 0.998,2.543 L1.164,2.688 C1.232,2.724 1.311,2.759 1.389,2.757 L2.663,2.751 C2.795,2.919 2.925,3.067 3.031,3.173 L4.19,4.331 L3.975,4.546 L1.684,4.997 C1.408,5.053 1.128,5.062 1.281,5.288 L1.421,5.475 C1.506,5.589 1.667,5.657 1.809,5.657 L5.517,5.657 L6.514,6.653 C6.944,7.085 7.454,7.277 7.649,7.08 L7.651,7.08 C7.846,6.885 7.655,6.375 7.223,5.943 L6.226,4.946 L6.226,1.157 C6.226,1.015 6.158,0.854 6.044,0.769 L5.857,0.629 C5.631,0.476 5.622,0.756 5.566,1.032 L5.093,3.427 L4.9,3.62 L3.742,2.462 C3.616,2.335 3.428,2.175 3.221,2.016 L3.226,0.852 C3.228,0.774 3.193,0.695 3.157,0.627 L3.012,0.461 C2.972,0.419 2.908,0.459 2.867,0.531 Z"></path>
                                              </g>
                                          </g>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </svg>
                    </div>
                  </div>
                  <div class="col-lg-4 mb-4 arrival-airport-code">
                    <h1 class="arrival">'.$flight['to_airport_code'].'</h1>
                  </div>
                </div>

                <div class="row-0">
                  <div class="col-lg-4 mb-4 departure-airport">'.$flight['origin_city'].'</div>
                  <div class="col-lg-4 mb-4">Flight No. '.$flight['id'].'</div>
                  <div class="col-lg-4 mb-4 destinationAirportID" id="'.$flight['destination_city_id'].'">'.$flight['destination_city'].'</div>
                </div>

                <div class="row row-2">
                  <div class="col-lg-6 mb-6 flight_departure_time">
                      <h1 class="departure_time">Departure time</h1>
                      <p>'.$flight['departure_time'].'</p>
                  </div>
                  
                  <div class="col-lg-6 mb-6 flight_arrival_time">
                      <h1 class="arrival_time">Departure date</h1>
                      <p>'.$flight['arrival_time'].'</p>
                  </div>
                </div>
        
                <div class="row row-4 class-selection">
                  <div class="row">
                    <div class="col-lg-6 mb-6 economy-class">
                      <span  class="res-flight_day" id="'.$flight['departure_day'].'"></span>
                      <div class="row class_type">
                          <h2>Economy</h2>
                      </div>
                      <div class="row economy_selection">
                          <input type="checkbox" id="economy" class="radio economy-select" onclick="document.getElementById(\'business_seat\').checked = false"/><label class="class-type" for="economy"></label>
                      </div>
                      <div class="row class-price">
                          <p>'.$flight['economy_price'].'</p>
                      </div>
                    </div>

                    <div class="col-lg-6 mb-6 business_class">
                      <span  class="res-flight_day" id="'.$flight['departure_day'].'"></span>
                      <div class="row class_type">
                          <h2>Business</h2>
                      </div>
                      <div class="row business_selection" id="business"> 
                          <input type="checkbox" id="business_seat" class="radio business-select" onclick="document.getElementById(\'economy\').checked = false"/><label class="class-type" for="business_seat"></label>
                      </div>
                      <div class="row class-price">
                          <p>'.$flight['business_price'].'</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>';
            }
          ?>
        </div><!--close flightDetails -->
        <div class="col-lg-4 mb-4">
          <?php 
            session_start();
            $aFlights = $_SESSION['flightSearch'];
            $user = $_SESSION['userID'];
            $iUser = '';
            foreach ($aUser as $user) {
                $iUser =  $user['id'];
            }
            echo '<div class="card reservation-ticket">
                    <div class="row">
                      <div class="col-lg-12 mb-12" id="reservation-details">   
                        <div class="ticket" data-flightID="'.$flight['id'].'">
                          <h1 class="header" data-userID="'.$iUser.'">Your Reservation</h1>
                            <div class="ticket-header">
                              <div class="ticket-departure">
                                <h1 class="city-abbr origin_city_abbr"></h1><span class="city-name origin_city_name" id="flightOrigin"></span>
                              </div>
                              <svg class="separator" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewbox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve">
                                <g id="flights"></g>
                                <path d="M510,255c0-20.4-17.85-38.25-38.25-38.25H331.5L204,12.75h-51l63.75,204H76.5l-38.25-51H0L25.5,255L0,344.25h38.25    l38.25-51h140.25l-63.75,204h51l127.5-204h140.25C492.15,293.25,510,275.4,510,255z" fill="currentColor"></path>
                              </svg>
                              <div class="ticket-destination">
                                <h1 class="city-abbr destination_city_abbr"></h1><span class="city-name destination_city_name" id="flightDestination" data-airportID="'.$flight['destination_city_id'].'"></span>
                              </div>
                            </div>

                            <div class="ticket-header">
                              <div class="ticket-departure">
                                <h1 class="city-abbr ">Departure</h1><span class="city-name res_dep_time"></span>
                              </div>
                            
                              <div class="ticket-destination">
                                <h1 class="city-abbr">Arrival</h1><span class="city-name res_arr_time"></span>
                              </div>
                            </div>
                            <div class="ticket-body">
                              <div class="row">
                                <div class="col item">
                                  <h2 class="name">Passenger(s)</h2><span class="value passengers">1</span>
                                </div>
                                <div class="col item reservedClass">
                                  <h2 class="name ">Class</h2><span id="reservedFlightClass" class="value" ></span>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col item">
                                  <h2 class="name reserved-date">Date</h2><span class="value" id="flightDate"></span>
                                </div>
                              </div>

                              <div class="row ">
                                <div class="col item flight_price">
                                  <h2 class="name ">Total Price:</h2>
                                </div>
                                <div class="col item flight_price" id="reservedPrice">
                                  <span id="priceCurrency">DKK</span>
                                  <h2 class="price" id="flightTotalPrice"></h2>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-12 mb-12 ">
                            <div class="searchFlight">
                              <button class="btnBookFlight btn-lightBlue ripple-effect" disabled>Reserve</button>
                            </div>
                        </div>
                      </div>
                    </div>';
                  ?>
                </div>
              </div>
            <!-- /.row -->
            </div>
            <!-- /.container -->

<?php  
  require_once ("../components/bottom.php");
?>



