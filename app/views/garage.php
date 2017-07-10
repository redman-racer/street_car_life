<?php
require '../config/globals.php';

$sec = "5";
//header("Refresh: $sec; url='garage'");
?>
<html>
<?php include_once '../includes/header.php'; ?>
<body>
<div id="Main_Container">
	<?php include_once '../includes/navigation.php'; ?>
  <div id="content">
		<!--BEGIN car select thumbnail div - The left collumn that holds the car thumbnails -->
    <div id="cs_container">
      <?php
      //Get list of vehicles owned by currenty user
      $garage_stmt = $conn->prepare("SELECT * FROM  `users_cars` WHERE  `owner`=:owner_id");
      $garage_stmt->bindParam(':owner_id', $user_info["id"], PDO::PARAM_STR);
      $garage_stmt->execute();
      //count our results
      $garage_count = $garage_stmt->rowCount();

      //loop through the results and display them
      while($garage_row = $garage_stmt->fetch()) {

        if($garage_row['driving']){
					$selected_display   = "";
					$steering_wheel     = "display: none;";
          $ic_container_class = "ic_container_driving";
					$driving_id         = $garage_row['base_id'];
        }else{
          $ic_container_class = "ic_container";
					$selected_display   = "display: none;";
					$steering_wheel			= "";
        }
        //select base_car for year,make,model by base_id stored in users_cars
        $base_car_stmt = $conn->prepare("SELECT * FROM  `base_cars` WHERE  `id`=:base_id");
        $base_car_stmt->bindParam(':base_id', $garage_row["base_id"], PDO::PARAM_STR);
        $base_car_stmt->execute();
        $base_car = $base_car_stmt->fetch();
        ?>

				<!--currently selected div-->
				<div id="selected_<?php echo $garage_row['id']; ?>" class="select_highlight" style="<?php echo $selected_display; ?>"></div>
				<!--div that contains the cars thumbnail image-->
        <div id="user_car" class="<?= $ic_container_class; ?>" data-id="<?php echo $garage_row['id']; ?>">
					<!--cars thumbnail image-->
          <img src="<?php echo $IMAGE_ROOT; ?>cars/garage/<?= $base_car['photo_folder']; ?>/street-car-life-<?= $base_car['year']; ?>-<?= $base_car['make']; ?>-<?= $base_car['model']; ?>-thumb.jpg" data-id="<?php echo $garage_row['id']; ?>" />
          <?php
          if($garage_row['driving']){
						$currentlySelectedID = $garage_row['id'];
						?>
            <driving id="driving" data-id="<?php echo $garage_row['id']; ?>">DRIVING</driving>
          <?php
        }?>
        </div>
      <?php
        }
       ?>
		<currentlySelected data-id="<?php echo $currentlySelectedID; ?>"></currentlySelected>
    </div>
		<!--END car select thumbnail div-->
		<!--BEGIN selected car display div - the large right div that displays the vehicles information-->
		<div id="cd_container"> </div>
		<!--END selected car display div -->
	</div>
</div>
<script>
//scrolls the page to the selected car.
$(document).ready(function () {
	const element = document.getElementById('driving');
	const elementRect = element.getBoundingClientRect();
	const absoluteElementTop = elementRect.top + window.pageYOffset;
	const middle = absoluteElementTop - (window.innerHeight / 2);
	window.scrollTo(0, middle);
});


//Loads the selected cars stats when the page loads
$(document).ready(function(){
  var selected = $("driving").data("id");
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("cd_container").innerHTML = this.responseText;
      }
  };
  xmlhttp.open("GET", "app/models/garage_get.php?load-id=" + selected, true);
  xmlhttp.send();
});


//Loads the selected cars stats when the car is selected
$("body").on("click", "#user_car", function(e) {
  var selectedCarID				 = $(this).data("id");
	var selectedCarHighlight = $("currentlySelected").data("id");
	$("#selected_" + selectedCarHighlight).fadeOut(400);
	$("#selected_" + selectedCarID).fadeIn(400);
	$("currentlySelected").data( "id", selectedCarID );
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("cd_container").innerHTML = this.responseText;
      }
  };
  xmlhttp.open("GET", "app/models/garage_get.php?load-id=" + selectedCarID, true);
  xmlhttp.send();
});
</script>
</body>
</html>
