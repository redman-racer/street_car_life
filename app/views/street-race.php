<?php
// Include Globals
require '../config/globals.php';
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<div id="Main_Container">
    <?php include_once '../includes/navigation.php'; ?>
    <div id="content">
		<div id="generic_container">
			<span id="streetRace" data-id="1">Race id 1</span><br />
			<span id="streetRace" data-id="2">Race id 2</span><br />
			<span id="streetRace" data-id="3">Race id 3</span><br />
			<span id="streetRace" data-id="4">Race id 4</span><br />
			<span id="streetRace" data-id="5">Race id 5</span><br />
			<span id="streetRace" data-id="6">Race id 6</span><br />
			<span id="streetRace" data-id="7">Race id 7</span><br /.
		</div>
	</div>
</div>
</body>
<footer>
<script>
// Street-Race Javascript Module
(function () {

	//Loads race results
	$("body").on("click", "#streetRace", function (e) {
		var raceWho = $(this).data("id");
		alert("You are trying to race id:" + raceWho);

		$.post('app/ajax-controllers/raceAjax.php', {
			action: 'race',
			raceWho: raceWho
		}, function (data) {
			// Check for errors
			if (checkErrors(data)) return false;

		});
	});

	// Function to check for errors
	function checkErrors(data) {
		if (data['error'] !== false) {
			console.log(data['error']);
			return true;
		} else {
			return false;
		}
	}
}


var wheelHP=true;
function calculate() {
 if(wheelHP){
  //document.input.et.value=Math.pow((document.input.weight.value/document.input.hp.value), (1/3))*5.7
  //document.input.trap.value=Math.pow((document.input.hp.value/document.input.weight.value), (1/3))*234

 }else{
   //document.input.et.value=Math.pow((document.input.weight.value/(document.input.hp.value*.86)), (1/3))*5.825
   //document.input.trap.value=Math.pow((document.input.hp.value/(document.input.weight.value*.86)), (1/3))*234

 }
 //document.input.et8.value=document.input.et.value*.655-.22
 //document.input.sixty.value=document.input.et.value*.126+.17
};
</script>
</footer>
