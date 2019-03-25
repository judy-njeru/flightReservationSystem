
// , (NULL, 'Aarhus Airport', 'AAR', 'Aarhus', 'Mid-Jutland');



$(document).on("submit", "#frmAddAirport", function(e) {
    e.preventDefault()
    $.ajax({
        url: '../../apis/adminCRUD/api-add-airport.php',
        method: "POST",
        data: $("#frmAddAirport").serialize(),
        // dataType: "JSON"
    }).done( function(jData) {
        console.log(jData)
        // if( jData.status === 1 ) {
        //     location.href = "../views/home.php";
        // }
    })
})


$(document).on("submit", "#frmAddAirCraft", function(e) {
    e.preventDefault()
    $.ajax({
        url: '../../apis/adminCRUD/api-add-aircraft.php',
        method: "POST",
        data: $("#frmAddAirCraft").serialize(),
        // dataType: "JSON"
    }).done( function(jData) {
        console.log(jData)
        // if( jData.status === 1 ) {
        //     location.href = "../views/home.php";
        // }
    })
})


$(document).on("click", "#btnAddFlight", function(e) {
    e.preventDefault()
    let flightRouteID = $('.routeSelection').children('span').attr('id')
    let aircraftID = $('.aircraftSelection').children('span').attr('id')
    let carrierID= $('.carrierSelection').children('span').attr('id')
    let originAirportID = $('.routeSelection').children().children('.country--abbreviation').attr('id')
    let destinationAirportID= $(".routeSelection").children().children('.country--name').attr('id')
    let originCityId = $('.routeSelection').children().children('.country--abbreviation').attr('id')
    let destinationCityId= $(".routeSelection").children().children('.country--name').attr('id')

    let economyPrice = $("#txtEconomyPrice").val()
    
    let businessPrice = $("#txtBusinessPrice").val()
    
    let economyCapacity = $("#txtEconomyCapacity").val()
    let businessCapacity = $("#txtBusinessCapacity").val()
    let departureTime = $("#txtDepartureTime").val()
    let arrivalTime = $("#txtArrivalTime").val()
    let flightDay= $("#txtDepartureDay").val()

    $.ajax({
                url: '../../apis/adminCRUD/api-add-flight.php',
                method: "POST",
                data: {
                    flightRouteID: flightRouteID,
                    aircraftID: aircraftID,
                    carrierID: carrierID,
                    originAirportID: originAirportID,
                    destinationAirportID: destinationAirportID,
                    originCityId: originCityId,
                    destinationCityId: destinationCityId,
                    economyPrice: economyPrice,
                    businessPrice: businessPrice, 
                    economyCapacity: economyCapacity,
                    businessCapacity: businessCapacity,
                    departureTime: departureTime,
                    arrivalTime: arrivalTime,
                    flightDay: flightDay
                },
                // dataType: "JSON"
            }).done( function(jData) {
                console.log(jData)
            })

   
})


// $(document).on('click', '#stop', function() {
//     $('.route-content').hide();
//     $('.aircraft-content').hide();
//     $('.carrier-content').hide();
// });


//dropdown on  route click //

$(".route_click .selected").on('click', function() {
    $('.route-content').css('display', 'block');
    $('.route-content ul').css('display', 'block');
    // $(".route_click .drop-content ul").slideToggle();
});

$(".route_click .drop-content ul li div").on('click', function() {
    let parent = $(this)

    parent.parent().parent().parent().siblings('.selected').addClass('routeSelection')
    let routeID = parent.parent().attr("data-value")
    
    
   
    // $(".aircraft_click .selected  span").attr('id', aircraftID);
    // $(".aircraft_click .selected  span").attr('id', aircraftID);
    $(".route_click .selected  span").html($(this).html());
    $(".route_click .selected  span.flightRouteID").attr('id', routeID);
    // $(".route_click .selected  .country--name").html($(this).html());
    $(".route_click .drop-content ul").slideUp();
}); 


//dropdown on  aircraft click //
$(".aircraft_click .selected").on('click', function() {
    $('.aircraft-content').css('display', 'block');
    $(".aircraft-content ul").slideToggle();
});

$(".aircraft_click .drop-content ul li span").on('click', function() {
    let parent = $(this)
    let aircraftID = parent.parent().attr('id')
    parent.parent().parent().parent().siblings('.selected').addClass('aircraftSelection')
    $(".aircraft_click .selected  span").html($(this).html());
    $(".aircraft_click .selected  span").attr('id', aircraftID);
    $(".aircraft_click .drop-content ul").slideUp();
}); 

//dropdown on  carrier //
$(".carrier_click .selected").on('click', function() {
    $('.carrier-content').css('display', 'block');
    $(".carrier_click .drop-content ul").slideToggle();
});

$(".carrier_click .drop-content ul li span").on('click', function() {
    let parent = $(this)
    let carrierID = parent.parent().attr('id')
    parent.parent().parent().parent().siblings('.selected').addClass('carrierSelection')
    $(".carrier_click .selected  span").html($(this).html());
    $(".carrier_click .selected  span").attr('id', carrierID);
    $(".carrier_click .drop-content ul").slideUp();
});


// $('select').change(function(){
//     $(this).find(':selected').addClass('selected')
//            .siblings('option').removeClass('selected');
// });



$(".origin-input").focus(function(event){
    // event.stopPropagation();
    // console.log('s')
    $('.flight-airport').removeClass('active');
    $(".origin-airport-container").addClass('visible')
    $(this).siblings(".input-arrow").css("transform", "rotate(180deg)")
});

$('.origin-input').on('focusout', function () {
    $(".origin-airport-container").removeClass('visible')
    $(this).siblings(".input-arrow").css("transform", "rotate(0deg)")
});


$(document).on("click", ".flight-airport", function(){
    $(this).addClass("active")
    let originAirport = $(this).children('span').siblings('.country--abbreviation').text()
    let destinationAirport = $(this).children('span').siblings('.country--name').text()

    let flightRoute = originAirport + " | " +  destinationAirport;
    
    $('.origin-input').val(flightRoute)

 
    // console.log('nn')
    
})


$(document).on("click", ".btnEditFlight", function(){
    $(this).siblings('.editableDiv').attr('contenteditable', true)
    $(this). text('Update Flight')
    $(this). removeClass('btnEditFlight').addClass('btnUpdateFlight')
})
//Edit Flight
$(document).on("click", '.editFlight', function(){    
    $(this).siblings('.editableDiv').attr('contenteditable', true)
    $(this). text('')
    $(this). removeClass('btnEditFlight').addClass('btnUpdateFlight')
})

$(document).on("click", ".btnUpdateFlight", function(){
    let flightID = $(this).parent().attr('id')
    let newDepartureTime = $(this).siblings(".departureTime").text()
    let newArrivalTime = $(this).siblings(".arrivalTime").text()
    let newFlightDay = $(this).siblings(".flightDay").text()
  
    $.ajax({
        url: '../../apis/adminCRUD/api-update-flight.php',
        method: "POST",
        data: {
            flightID: flightID,
            departureTime: newDepartureTime,
            arrivalTime: newArrivalTime,
            flightDay: newFlightDay
        }
        // dataType: "JSON"
    }).done( function(jData) {
        console.log(jData)
        // if( jData.status === 1 ) {
        //     location.href = "../views/home.php";
        // }
    })

    $(this). removeClass('btnUpdateFlight').addClass('btnEditFlight')
    $(this).html('<svg class="editFlight" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/><path d="M0 0h24v24H0z" fill="none"/></svg>')
})

$(document).on("click", ".btnCancelFlight", function(){
    let flightID = $(this).parent().attr('id')
    $.ajax({
        url: '../../apis/adminCRUD/api-cancel-flight.php',
        method: "GET",
        data: {
            flightID: flightID
        },
        dataType: "JSON"
    }).done( function(jData) {
        console.log(jData)
    })
})






//////
$('li').click(function(){
  
    $(this).addClass('active')
         .siblings()
         .removeClass('active');
      
  });

// $(document).on('click', '.cd-nav-trigger', function(){
//     console.log
// })

$(document).ready(function(){
	//cache DOM elements
	let mainContent = $('.cd-main-content'),
		header = $('.cd-main-header'),
		sidebar = $('.cd-side-nav'),
		sidebarTrigger = $('.cd-nav-trigger'),
		topNavigation = $('.cd-top-nav'),
		searchForm = $('.cd-search'),
		accountInfo = $('.account');

	//on resize, move search and top nav position according to window width
	let resizing = false;
	moveNavigation();
	$(window).on('resize', function(){
		if( !resizing ) {
			(!window.requestAnimationFrame) ? setTimeout(moveNavigation, 300) : window.requestAnimationFrame(moveNavigation);
			resizing = true;
		}
	});

	//on window scrolling - fix sidebar nav
	let scrolling = false;
	checkScrollbarPosition();
	$(window).on('scroll', function(){
		if( !scrolling ) {
			(!window.requestAnimationFrame) ? setTimeout(checkScrollbarPosition, 300) : window.requestAnimationFrame(checkScrollbarPosition);
			scrolling = true;
		}
	});

	//mobile only - open sidebar when user clicks the hamburger menu
	sidebarTrigger.on('click', function(event){
        console.log('ddd')
		event.preventDefault();
		$([sidebar, sidebarTrigger]).toggleClass('nav-is-visible');
	});

	//click on item and show submenu
	$('.has-children > a').on('click', function(event){
		let mq = checkMQ(),
			selectedItem = $(this);
		if( mq == 'mobile' || mq == 'tablet' ) {
			event.preventDefault();
			if( selectedItem.parent('li').hasClass('selected')) {
				selectedItem.parent('li').removeClass('selected');
			} else {
				sidebar.find('.has-children.selected').removeClass('selected');
				accountInfo.removeClass('selected');
				selectedItem.parent('li').addClass('selected');
			}
		}
	});

	//click on account and show submenu - desktop version only
	accountInfo.children('a').on('click', function(event){
		let mq = checkMQ(),
			selectedItem = $(this);
		if( mq == 'desktop') {
			event.preventDefault();
			accountInfo.toggleClass('selected');
			sidebar.find('.has-children.selected').removeClass('selected');
		}
	});

	$(document).on('click', function(event){
		if( !$(event.target).is('.has-children a') ) {
			sidebar.find('.has-children.selected').removeClass('selected');
			accountInfo.removeClass('selected');
		}
	});

	// on desktop - differentiate between a user trying to hover over a dropdown item vs trying to navigate into a submenu's contents
	sidebar.children('ul').menuAim({
        activate: function(row) {
        	$(row).addClass('hover');
        },
        deactivate: function(row) {
        	$(row).removeClass('hover');
        },
        exitMenu: function() {
        	sidebar.find('.hover').removeClass('hover');
        	return true;
        },
        submenuSelector: ".has-children",
    });

	function checkMQ() {
		//check if mobile or desktop device
		return window.getComputedStyle(document.querySelector('.cd-main-content'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
	}

	function moveNavigation(){
  		let mq = checkMQ();
        
        if ( mq == 'mobile' && topNavigation.parents('.cd-side-nav').length == 0 ) {
        	detachElements();
			topNavigation.appendTo(sidebar);
			searchForm.removeClass('is-hidden').prependTo(sidebar);
		} else if ( ( mq == 'tablet' || mq == 'desktop') &&  topNavigation.parents('.cd-side-nav').length > 0 ) {
			detachElements();
			searchForm.insertAfter(header.find('.cd-logo'));
			topNavigation.appendTo(header.find('.cd-nav'));
		}
		checkSelected(mq);
		resizing = false;
	}

	function detachElements() {
		topNavigation.detach();
		searchForm.detach();
	}

	function checkSelected(mq) {
		//on desktop, remove selected class from items selected on mobile/tablet version
		if( mq == 'desktop' ) $('.has-children.selected').removeClass('selected');
	}

	function checkScrollbarPosition() {
		let mq = checkMQ();
		
		if( mq != 'mobile' ) {
			let sidebarHeight = sidebar.outerHeight(),
				windowHeight = $(window).height(),
				mainContentHeight = mainContent.outerHeight(),
				scrollTop = $(window).scrollTop();

			( ( scrollTop + windowHeight > sidebarHeight ) && ( mainContentHeight - sidebarHeight != 0 ) ) ? sidebar.addClass('is-fixed').css('bottom', 0) : sidebar.removeClass('is-fixed').attr('style', '');
		}
		scrolling = false;
	}
});










