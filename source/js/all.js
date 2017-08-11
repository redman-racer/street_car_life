$('document').ready(function () {
	// Fetch the user's cars
	loadUserStats();
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

// Function to check for errors
function checkErrors(data) {
	if (data['error'] !== false) {
		console.log(data['error']);
		return true;
	} else {
		return false;
	}
}
