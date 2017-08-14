<?php

	if( isset($_POST['submit']) ){
		$time  = $_POST['time'];
		$money = $_POST['money'];
		$size  = $_POST['size'];
		$type  = $_POST['type'];
		$totalIngame  = $_POST['inGame'];
			$moneyDecider = $totalIngame*.000004;
		switch($type){

			case "turbocharger":
				$limit = $size * 20;
			break;

			case "exhaust":
				$limit = $size * 7;
			break;

			case "intake":
				$limit = $size * 4;
			break;
		}
					$limitH = $limit / 2;
					$timeDays      = $time / 10;
					$moneyNeeded   = $moneyDecider * $limit; //Money Needed
					$partCompleteP = $time * 100 / 3650; //Time percentage
					$partCompleteM = $money * 100 / $moneyNeeded; //Money Percentage
					$partCompleteMT = $partCompleteM / 100 / 2;
					$partCompleteT = $partCompleteP / 100 / 2;
					$partTimeMulti = $limit * $partCompleteT;
					$partMonMulti  = $limit * $partCompleteMT;
					if($partTimeMulti >= $limitH){
							$partTimeMulti = $limitH;
						}
					if($partMonMulti >= $limitH){
							$partMonMulti = $limitH;
					}
					$partTotal  = $partTimeMulti + $partMonMulti;
					//$partTotal     = $limit * $partComplete / 100;

					if($partTotal > $limit){
						$partTotal = $limit;
					}


	}
?>
<html>
<head>
	<title>Create a part</title>
</head>
<body>
	<div id="total">The part you created is going to create a maximum of <?= $partTotal ?>HP. The max HP you could of created is <?= $limit ?>HP. The time and money you should of used to get this amount of HP is, 3650 mins, and $<?= $moneyNeeded ?>. This is based off of your Total inGame Money, which was $<?= $totalIngame ?>.<br />


	</div><br /><br />
	<form method="POST" action="#">
		Total inGame Money: <input name="inGame" id="inGame" /> Since it is auto updated according to the total amount of ingame money, you must set how much money is ingame, to decide how much to charge for the part.<br />
		Time spent on part: <input name="time" id="time" />(in minutes, 10 mins is = to 1 day of R&D IRL<br />
		Money spent on part: <input name="money" id="money" /><br />
		Engine size (in liters): <input name="size" id="size" /><br />
		Part Type: <input name="type" id="type" />ATTENTION: The only parts added so far are, turbocharger, exhaust, and intake<br />
		<input type="submit" name="submit" id="submit" value="Create the part" />
	</form>
</body>
</html>
