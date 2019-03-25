// ..... SEARCHED FLIGHTS RESERVATIONS ...... //

//Economy Selection
$(document).on("click", ".economySelection", function(){
    // console.log("cc")
    var economyPrice = $(this).parent().siblings().children("#economyPrice").text()
    var flightClass = $(this).parent().parent().parent().parent().siblings(".flightsHeader").children("#economyClass").text()
    $("#reservedFlightClass").text(flightClass)
    $("#reservedFlightClass").attr("data-classID", 1)
    var passengerCount  = $("#passengers").text().substring(0,1);
    var totalPrice = economyPrice * passengerCount;
    $("#flightTotalPrice").text(totalPrice)
    $("#priceCurrency").css('display','block');
    
})

$(document).on('click', '#radio-1', function(){
    $('.btnReserveFlight').attr('disabled', false)
    var flightClass = $(this).parent().siblings('.class_type').children('h2').text()
    var economyPrice = $(this).parent().siblings('.class-price').children('p').text()
    var passengerCount  = $(".passengers").text();
    $("#reservedFlightClass").text(flightClass)
    $("#reservedFlightClass").attr("data-classID", 1)
    var totalPrice = economyPrice * passengerCount;
    $("#flightTotalPrice").text(totalPrice)
    $("#priceCurrency").css('display','block');

    console.log(totalPrice)
})

//Business Selection
$(document).on('click', '#radio-2', function(){
    $('.btnReserveFlight').attr('disabled', false)
    var flightClass = $(this).parent().siblings('.class_type').children('h2').text()
    var economyPrice = $(this).parent().siblings('.class-price').children('p').text()
    var passengerCount  = $(".passengers").text();
    $("#reservedFlightClass").text(flightClass)
    $("#reservedFlightClass").attr("data-classID", 2)
    var totalPrice = economyPrice * passengerCount;
    $("#flightTotalPrice").text(totalPrice)
    $("#priceCurrency").css('display','block');

})

$(document).on("click", ".businessSelection", function(){
    var businessPrice = $(this).parent().siblings().children("#businessPrice").text()
    var flightClass = $(this).parent().parent().parent().parent().siblings(".flightsHeader").children("#businessClass").text()
    $("#reservedFlightClass").text(flightClass)
    $("#reservedFlightClass").attr("data-classID", 2)
    var passengerCount  = $("#passengers").text().substring(0,1);
    // console.log(passengerCount)
    var totalPrice = businessPrice * passengerCount;
    $("#flightTotalPrice").text(totalPrice)
    $("#priceCurrency").css('display','block'); 
})

$(document).on("click", ".btnReserveFlight", function(){
    var flightID = $(this).parent().parent().siblings('#reservation-details').children().attr('data-flightid');
    var userID = $(this).parent().parent().siblings('#reservation-details').children().children('h1').attr('data-userID');
    var reservedFlightClass = $('#reservedFlightClass').attr('data-classid');
    var seatsReserved  = $(".passengers").text();
    var flightOrigin = $('#flightOrigin').text()
    var flightDestination = $('#flightDestination').attr('data-airportID');
    var flightDate = $('#flightDate').text();
    var totalPrice = $("#flightTotalPrice").text()

    $.ajax({
        url: '../apis/api-reserve-flight.php',
        method: "POST",
        data: {
            userID: userID,
            flightID: flightID,
            seatsReserved: seatsReserved,
            flightOrigin: flightOrigin,
            flightDestination: flightDestination,
            flightDate: flightDate,
            totalPrice: totalPrice,
            reservedFlightClass: reservedFlightClass
        },
        dataType: "JSON"
    }).done( function(jData) {
        console.log(jData)
        if( jData.status === 1 ) {
            swal({
                title: "Flight Reserved!",
                text: "Go to Reservations for details!",
                icon: "success"
            });
            return;
        }
        swal({
            title: "Flight Reservation Error!",
            text: "Please try again!",
            icon: "error"
        });
    })
})


// ..... BOOK NOW FLIGHT RESERVATIONS ...... //
//Booked Economy Selection
$(document).on('click', '.economy-select', function(){
    var originAirportCode = $(this).parent().parent().parent().parent().siblings('.row-1').children('.departure-airport-code').children('h1').text()
    var destinationAirportCode = $(this).parent().parent().parent().parent().siblings('.row-1').children('.arrival-airport-code').children('h1').text()
    var originAirport = $(this).parent().parent().parent().parent().siblings('.row-0').children('.departure-airport').text()
    var destinationAirport = $(this).parent().parent().parent().parent().siblings('.row-0').children('.destinationAirportID').text()
    var departureTime = $(this).parent().parent().parent().parent().siblings('.row-2').children('.flight_departure_time').children('p').text()
    var arrivalTime = $(this).parent().parent().parent().parent().siblings('.row-2').children('.flight_arrival_time').children('p').text()
    var flightClass = $(this).parent().siblings('.class_type').children('h2').text()
    var flightDay = $(this).parent().siblings('span').attr('id')
    var price = $(this).parent().siblings('.class-price').children('p').text()

    let destinationID = $('.destinationAirportID').attr('id')

    $('.origin_city_abbr').text(originAirportCode)
    $('.destination_city_abbr').text(destinationAirportCode)
    $('.destination_city_abbr').attr('data-airportID', destinationID)
    $('.origin_city_name').text(originAirport)
    $('.destination_city_name').text(destinationAirport)
    $('.destination_city_name').text(destinationAirport)
    $('.res_dep_time').text(departureTime)
    $('.res_arr_time').text(arrivalTime)
    $('#reservedFlightClass').text(flightClass)
    $('#reservedFlightClass').attr('data-class', 1)
    $('#flightDate').text(flightDay)
    $("#flightTotalPrice").text(price)
    $('.btnBookFlight').attr('disabled', false)
})


//Booked Business Selection
$(document).on('click', '.business-select', function(){
    var originAirportCode = $(this).parent().parent().parent().parent().siblings('.row-1').children('.departure-airport-code').children('h1').text()
    var destinationAirportCode = $(this).parent().parent().parent().parent().siblings('.row-1').children('.arrival-airport-code').children('h1').text()
    var originAirport = $(this).parent().parent().parent().parent().siblings('.row-0').children('.departure-airport').text()
    var destinationAirport = $(this).parent().parent().parent().parent().siblings('.row-0').children('.destinationAirportID').text()
    var departureTime = $(this).parent().parent().parent().parent().siblings('.row-2').children('.flight_departure_time').children('p').text()
    var arrivalTime = $(this).parent().parent().parent().parent().siblings('.row-2').children('.flight_arrival_time').children('p').text()
    var flightClass = $(this).parent().siblings('.class_type').children('h2').text()
  
    var flightDay = $(this).parent().siblings('span').attr('id')
    var price = $(this).parent().siblings('.class-price').children('p').text()

    $('.origin_city_abbr').text(originAirportCode)
    $('.destination_city_abbr').text(destinationAirportCode)
    $('.origin_city_name').text(originAirport)
    $('.destination_city_name').text(destinationAirport)
    $('.res_dep_time').text(departureTime)
    $('.res_arr_time').text(arrivalTime)
    $('#reservedFlightClass').text(flightClass)
    $('#reservedFlightClass').attr('data-class', 2)
    $('#flightDate').text(flightDay)
    $("#flightTotalPrice").text(price)
    $('.btnBookFlight').attr('disabled', false)

})

//BOOK NOW FLIGHT from bookings click
$(document).on("click", ".btnBookFlight", function(){
    
    var flightID = $(this).parent().parent().siblings('#reservation-details').children().attr('data-flightid');
    var userID = $(this).parent().parent().siblings('#reservation-details').children().children('h1').attr('data-userID');
    var reservedFlightClass = $('#reservedFlightClass').attr('data-class');
    var seatsReserved  = $(".passengers").text();
    var flightOrigin = $('#flightOrigin').text()
    var flightDestination = $('#flightDestination').attr('data-airportID');
    var flightDate = $('#flightDate').text();
    var totalPrice = $("#flightTotalPrice").text()

    $.ajax({
        url: '../apis/api-reserve-flight.php',
        method: "POST",
        data: {
            userID: userID,
            flightID: flightID,
            seatsReserved: seatsReserved,
            flightOrigin: flightOrigin,
            flightDestination: flightDestination,
            flightDate: flightDate,
            totalPrice: totalPrice,
            reservedFlightClass: reservedFlightClass
        },
        dataType: "JSON"
    }).done( function(jData) {
        console.log(jData)
        if( jData.status === 1 ) {
            swal({
                title: "Flight Reserved!",
                text: "Go to Reservations for details!",
                icon: "success"
            });
            return;
        }
        swal({
            title: "Flight Reservation Error!",
            text: "Please try again!",
            icon: "error"
        });
    })
})


$(document).ready(function(){
    var economyPrice = $("#economyPrice").text();
    economyPrice = Math.trunc(economyPrice);
    $("#economyPrice").text(economyPrice);

    var businessPrice = $("#businessPrice").text();
    businessPrice = Math.trunc(businessPrice);
    $("#businessPrice").text(businessPrice);
})


$(document).ready(function(){
    $(".dropdown-trigger").dropdown();
})