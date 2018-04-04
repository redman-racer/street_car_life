<?php
require '../config/globals.php';
?>

<html>
<head>
    <title>Kunden Force Automotive</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->

	<!--JQuery UI CSS-->
	<link rel="stylesheet" href="<?php echo $CSS_ROOT; ?>jquery-ui.css">

	<!--Include jquery-->
    <script src="<?php echo $JS_ROOT; ?>jquery-1.12.4.js"></script>
    <script src="<?php echo $JS_ROOT; ?>jquery-3.2.1.min.js"></script>
    <script src="<?php echo $JS_ROOT; ?>jquery-ui.js"></script>

	<!--Include site roots-->
	<script src="<?php echo$SITE_ROOT; ?>app/config/localhostJS.js"></script>

	<!-- Styles -->
	<style type="text/css">
		@font-face {
			font-family: calibri;
			src: url(../fonts/calibri.ttf);
		}
		body{
			color: #333;
			font-family: calibri;
		}
		table, table tr, table td { padding:none;border:none;border-spacing:0;}
	</style>
</head>
<body style="background-color: #ffcc99;">
<div id="container">
	<table style="margin: 0px auto;">
		<tr>
			<td style="background-color: #009933; width: 220px; height: 220px; border-top: 20px; border-right: 10px; border-bottom: 10px; border-left: 20px; border-style: solid; border-top-left-radius: 240px;">
				<!-- Green -->
			</td>
			<td style="background-color: #990000; width: 220px; height: 220px; border-top: 20px; border-right: 20px; border-bottom: 10px; border-left: 10px; border-style: solid; border-top-right-radius: 240px;">
				<!-- Red -->
			</td>
		</tr>
		<tr>
			<td style="background-color: #CC9900; width: 220px; height: 220px; border-top: 10px; border-right: 10px; border-bottom: 20px; border-left: 20px; border-style: solid; border-bottom-left-radius: 240px;">
				<!-- Yellow -->
			</td>
			<td style="background-color: #003399; width: 220px; height: 220px; border-top: 10px; border-right: 20px; border-bottom: 20px; border-left: 10px; border-style: solid; border-bottom-right-radius: 240px;">
				<!-- Blue -->
			</td>
		</tr>
	</table>

</div>
</table>
</body>
</html>
