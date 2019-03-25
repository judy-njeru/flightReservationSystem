// Search for flights
$(document).on("click", ".btnBookFlight", function(){
   var originAirport = $(this).parent().parent().siblings('.destinationAirport').attr('id');
   var flightDate = $(this).parent().parent().siblings('#flightDay').text();
   var flightPrice = $(this).parent().parent().siblings('#flightPrice').text();

   $.ajax({
       url: '../apis/api-get-flight.php',
       method: "GET",
       data: {
           origin:originAirport,
           date: flightDate,
           price: flightPrice
       }, 
       dataType: "JSON"
   }).done( function(jData){
       console.log(jData)
       if(jData.status === 0 ) {
           $("#flightNotFound").css("display","block");
           return;
       }
       location.href = "../views/book-flight.php";
   })
})

// Search home for flights
$(document).on("click", ".btnSearchFlight", function(){
    var originAirport = $('.originCity').children('.country--abbreviation').text();
    var destinationAirport = $('.destinationAirport').children('.country--abbreviation').text();
    var travelDate = $('.dateselect').val()

    var month = travelDate.split('/')[0];
    var day = travelDate.split('/')[1];
    var year = travelDate.split('/')[2];
    var flightDate = year + "-" + month + "-" + day;
    var iNumberOfPassengers = $('.select-styled').text();
 
    $.ajax({
        url: '../apis/api-search-flights.php',
        method: "GET",
        data: {
            origin:originAirport,
            destination: destinationAirport,
            date: flightDate,
            passengers: iNumberOfPassengers
        }, 
        dataType: "JSON"
    }).done( function(jData){
        console.log(jData)
        if(jData.status === 0 ) {
            $("#flightNotFound").css("display","block");
            return;
        }
        location.href = "../views/flights.php";
    })
})

// dropdown on  origin ariport click //
$(".origin_click .selected").on('click', function() {
    $('.origin-content').css('display', 'block');
    $('.origin-content ul').css('display', 'block');
});

$(".origin_click .drop-content ul li").on('click', function() {
    let parent = $(this)
    parent.parent().parent().parent().siblings('.selected').addClass('routeSelection')
    let routeID = parent.parent().attr("data-value")
    $(".origin_click .selected  span").html($(this).html());
    $(".origin_click .selected  span.flightRouteID").attr('id', routeID);
    $(".origin_click .drop-content ul").slideUp();
}); 

// /dropdown on  destination ariport click //
$(".destination_click .selected").on('click', function() {
    $('.destination-content').css('display', 'block');
    $('.destination-content ul').css('display', 'block');
});

$(".destination_click .drop-content ul li").on('click', function() {
    let parent = $(this)
    parent.parent().parent().parent().siblings('.selected').addClass('routeSelection')
    let routeID = parent.parent().attr("data-value")
    $(".destination_click .selected  span").html($(this).html());
    $(".destination_click .selected  span.flightRouteID").attr('id', routeID);
    $(".destination_click .drop-content ul").slideUp();
}); 


$('.dateselect').datepicker({
    format: 'mm/dd/yyyy',
});


//guest picker
$('select').each(function(){
    var $this = $(this), numberOfOptions = $(this).children('option').length;
  
    $this.addClass('select-hidden'); 
    $this.wrap('<div class="select"></div>');
    $this.after('<div class="select-styled"></div>');

    var $styledSelect = $this.next('div.select-styled');
    $styledSelect.text($this.children('option').eq(0).text());
  
    var $list = $('<ul />', {
        'class': 'select-options'
    }).insertAfter($styledSelect);
  
    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
    }
  
    var $listItems = $list.children('li');
  
    $styledSelect.click(function(e) {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function(){
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').toggle();
    });
  
    $listItems.click(function(e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
        //console.log($this.val());
    });
  
    $(document).click(function() {
        $styledSelect.removeClass('active');
        $list.hide();
    });
});


