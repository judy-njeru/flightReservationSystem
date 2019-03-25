//Sigunp User
$("#frmSignUpUser").on('submit', function(e) {
    e.preventDefault()
    $.ajax({
        url: '../apis/api-signup-user.php',
        method: "POST",
        data: $("#frmSignUpUser").serialize(),
        dataType: "JSON"
    }).done( function(jData) {
        console.log(jData)
        if( jData.status === 1 ) {
            location.href = "../views/home.php";
        }
    })
})

//Login User
$("#frmLoginUser").on('submit', function(e) {
    e.preventDefault()
    $.ajax({
        url: '../apis/api-login-user.php',
        method: "GET",
        data: $("#frmLoginUser").serialize(),
        dataType: "JSON"
    }).done( function(jData) {
        console.log(jData)
        if( jData.status === 1 ) {
            location.href = "../views/home.php";
        }
    })
})

$(document).ready(function(){
    $(".dropdown-trigger").dropdown();
})

$(document).on('click', '#btnLogoutUser', function(e){
    e.preventDefault()
    $.ajax({
        url: '../apis/api-logout-user.php',
        dataType: 'JSON'
    }).done( function(jData) {
        console.log(jData)
        if( jData.status === 1 ) {
            location.href = "../views/home.php";
        }
    })    
})