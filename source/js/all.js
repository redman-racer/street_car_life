$('document').ready(function () {
	// Fetch the user's cars
	loadUserStats();
	var navi_state = getCookie("navi");
	if ( navi_state == "up"){
		setTimeout(slideNavi, 200);
	}
});

function loadUserStats(){

	$.post(site_root+'app/ajax-controllers/userBarAjax.php', {
		action: "getStats"
	}, function (data) {
		// Check for errors
		if (checkErrors(data)) return false;

		if(!data['currentCar']){
			data['currentCar'] = {cars_year:"None", cars_make:"", cars_model:""};
		}

		// Create the HTML to enter into the User Bar DIV
		statsBar = 'Money:'+
					'<span style="color: #97d079;"> $' + data['money'] + '</span>'+
		   			'  |  Car: <span id="navCurCar"> ' + data['currentCar']['cars_year'] + ' ' + data['currentCar']['cars_make'] + ' ' + data['currentCar']['cars_model'] + '</span>';

		// Insert the userbar into the DIV
		$("#userBar").html(statsBar);

		// Sets the timer to re-load the user Bar Stats
		setTimeout(loadUserStats, 3000);
	});
}


// Hides the navigation
$( "body" ).on( "click", "#logoClickable", function (e) {
	slideNavi();
});

function slideNavi(){
	$( "#navigation").slideToggle(600);
	var logoTop = $( "#logo").css('margin-top');

	if ( logoTop == "5px" ){
		var new_lmt = "88px";
		var new_ubmt = "15px";
		var new_cmt = "200px";
		document.cookie = "navi=down";
	 }
	if ( logoTop == "88px" ){
		var new_lmt = "5px";
		var new_ubmt = "15px";
		var new_cmt = "120px";
		document.cookie = "navi=up";
	}

	$( "#logo").animate({	'margin-top': new_lmt	}, 600, function() {/* Animation complete.*/});
	$( "#userBar").animate({	'margin-top': new_ubmt	}, 600, function() {/* Animation complete.*/});
	$( "#content").animate({	'margin-top': new_cmt	}, 600, function() {/* Animation complete.*/});
}

// Function to check for errors
function checkErrors(data) {
	if (data['error'] !== false) {
		console.log(data['error']);
		return true;
	} else {
		return false;
	}
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
