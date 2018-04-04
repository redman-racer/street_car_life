$('document').ready(function () {
	// Fetch the user's cars
	loadUserStats();

	var navi_state = getCookie("naviAct");
	document.cookie = "navi=1";

	if ( navi_state == "up"){
		setTimeout(slideNavi, 200);
	}

	setTimeout(function() { setNaviHeight(); }, 300); //setContentContainerHeight(); gets called at end of setNaviHeight();
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

function slideNavi(){ //TODO change this to adjust the heights automatically.
	$( "#navigation").slideToggle(600);
	navi_state = getCookie("navi");

	if( navi_state == "up" ){
		document.cookie = "navi=down";
		document.cookie = "naviAct=up";
	}
	if( navi_state == "down" ){
		document.cookie = "navi=up";
		document.cookie = "naviAct=down";
	}

		setTimeout(	updateCMT, 700 );

	function updateCMT(){

		var navi_height = $( "#nav_container" ).height();

		if ( navi_state == "up" ){
			navi_height = "118";
		}
		else{
			navi_height = $( "#nav_container" ).height();
		}

		$( "#content" ).animate({	'margin-top': navi_height + "px"	}, 600, function() {/* Animation complete.*/});
		return;
	}
}

function setNaviHeight(){
	navi_height = $( "#nav_container" ).height();
	$( "#content" ).css( 'margin-top', navi_height );
	setContentContainerHeight();
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

function setContentContainerHeight(){

	var nav_height = $( "#nav_container" ).height();
	var cd_height  = $( "#cd_container").height();
	var gc_height  = $( "#generic_container").height();

	$( "#cd_container").height(cd_height - nav_height);
	$( "#generic_container").height(gc_height - nav_height);
}

function userIDtUsername( user_id, div_id ){

	$.post(site_root+'app/ajax-controllers/userBarAjax.php', {
		action: "idToName",
		user_id: user_id
	}, function (data) {
		if( data['error'] === true ){

			return false;
		} else if ( data['error'] === false ){
			var username = data['user_info']['username'];
				$( "#" + div_id ).html(username);
			return username;
		}
	});
}


function getCurrentCarStats(){
	$.post(site_root+'app/ajax-controllers/userBarAjax.php', {
		action: "getCurrentCarStat"
	}, function (data) {
		if( data['error'] === true ){

			return false;
		} else if ( data['error'] === false ){
			var current_car = data['current_car'];
			return current_car;
		}
	});
}

var car_model = false;
function carIDToModel(car_id, div_id){
	$.post(site_root+'app/ajax-controllers/userBarAjax.php', {
		action: "carIDToModel",
		car_id: car_id
	}, function (data) {
		if( data['error'] === true ){
			car_model = "";
			return false;
		} else if ( data['error'] === false ){
			var car_model = data['current_car'];

			if( !car_model ){
				car_model = "";
			}
				$( "#" + div_id ).html(car_model);
			return car_model;
		}
	});

	if( !car_model ){
		car_model = "none";
	}
	return car_model;
}
