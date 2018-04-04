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
<body>
<table style="width: 670px; max-height: 11in; margin: 0px auto;">
	<!--HEADER-->
		<!-- Logo && Contact Info -->
		<tr>
			<td>
					<img src="<?php echo $IMAGE_ROOT; ?>kunden_force/kf_colour_white.png" width="90%" />
			</td>
			<td style="font-size: .9em; font-family: calibri; text-align: center;">
				<span style="font-weight: bold;">(316) 554-6301</span> <br />
				www.<span style="color: #3FA9F5; font-weight: bold;">KUNDENFORCE</span>.com <br />
					<table style="width: 100%;">
						<tr>
							<td style="font-weight: bold;text-align: right; padding-right: 5px;">
								Repair Order:
							</td>
							<td style="font-size: .9em; padding-top: 2px;">
								000001929
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; text-align: right; padding-right: 5px;">
								Repair&nbsp;&nbsp;&nbsp;Date:
							</td>
							<td style="font-size: .9em; padding-top: 2px;">
								<?php echo date('n/j/Y'); ?>
							</td>
						</tr>
					</table>
			</td>
		</tr>
		<!-- TECH INFO -->
		<tr>
			<td style="width: 70%; padding-left: 70px; margin: 0px auto;">
				<table style="width: 65%;">
					<tr style="border-style: solid; border-width: 2px 0px 2px 0px;">
						<td style="width: 40%; padding-right: 5px; margin: 0px auto; border-style: solid; border-width: 1px 0px 1px 0px; font-size: .9em; font-family: calibri; text-align: right;">
							Tech Name:
						</td>
						<td style="width: 60%; padding-left: 5px; margin: 0px auto; border-style: solid; border-width: 1px 0px 1px 0px; font-size: .9em; font-family: calibri; text-align: left;" contenteditable>

						</td>
					</tr>
					<tr>
						<td style="width: 40%; padding-right: 5px; margin: 0px auto; border-style: solid; border-width: 0px 0px 1px 0px; font-size: .9em; font-family: calibri; text-align: right;">
							Tech Phone:
						</td>
						<td style="width: 60%; padding-left: 5px; margin: 0px auto; border-style: solid; border-width: 0px 0px 1px 0px; font-size: .9em; font-family: calibri; text-align: left;" contenteditable>

						</td>
					</tr>
				</table>
			</td>
			<td style="width: 30%;">
			</td>
		</tr>
	<!--BODY-->
		<tr>
			<td colspan="2" style="/*background-color: rgba(63,169,245, 0.25);*/">
				<table style="width: 100%;">
					<tr style="background-color: rgba(63,169,245, 0.25); border: 1px solid rgba(63,169,245); border-radius: 5px;">
						<td  style="font-family: calibri; width: 50%;">
							<table style="margin-top: 8px; margin-left: 5px; padding: 3px; width: 98%; background-color: #fff; border: 1px solid #000; border-radius: 4px;">
								<tr>
									<td style="width: 15%; text-align: right; font-weight: bold;">
										VIN:
									</td>
									<td colspan="3" style="width: 85%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 15%; text-align: right; font-weight: bold;">
										Year:
									</td>
									<td style="width: 25%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
									<td style="width: 15%; text-align: right; font-weight: bold;">
										Make:
									</td>
									<td style="width: 55%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 15%; text-align: right; font-weight: bold;">
										Eng:
									</td>
									<td style="width: 25%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
									<td style="width: 15%; text-align: right; font-weight: bold;">
										Model:
									</td>
									<td style="width: 55%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
							</table>
						</td>
						<td  style="font-family: calibri; width: 50%;">
							<table style="margin-top: 8px; margin-left: 5px; padding: 3px; width: 98%; background-color: #fff; border: 1px solid #000;  border-radius: 4px;">
								<tr>
									<td style="width: 15%; text-align: right; font-weight: bold;">
										Name:
									</td>
									<td colspan="3" style="width: 85%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 15%; text-align: right; font-weight: bold;">
										Home:
									</td>
									<td style="width: 35%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
									<td style="width: 15%; text-align: right; font-weight: bold;">
										Cell:
									</td>
									<td style="width: 40%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 15%; text-align: right; font-weight: bold;">
										Address:
									</td>
									<td colspan="3" style="width: 85%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
							</table>

						</td>
					</tr>
				</table>
				<table style="margin-top: 3px; padding: 3px; width: 100%; border-top: 2px solid #333; border-bottom: 2px solid #333;  border-radius: 2px; background-color: rgba(63,169,245, 1);">
					<tr>
						<th style="color: #fff; width: 50%; text-align: center; border-right: 2px solid #333; font-size: 2.5em; font-weight: bold;">
							NOTES
						</th>
						<th style="color: #fff; width: 50%; text-align: center; font-size: 2.5em; font-weight: bold;">
							REPAIRS
						</th>
					</tr>
				</table>
				<table style="width: 100%;">
					<tr>
						<td  style="font-family: calibri; width: 50%;">
							<table style="margin-top: 8px; margin-left: 5px; padding: 3px; width: 98%; background-color: #fff; border-right: 1px solid #000;">
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
								<tr>
									<td style="width: 99%; border-bottom: 1px solid #000; padding-left: 4px; padding-top: 3px; font-size: .87em;" contenteditable>
										<!--Edit Content-->
									</td>
								</tr>
							</table>
						</td>
						<td  style="font-family: calibri; width: 50%;">
							<table style="margin-top: 8px; margin-left: 5px; padding: 3px; width: 98%; background-color: #fff; border-left: 1px solid #000;">
								<tr>
									<th style="width: 80%; font-weight: bold; border-bottom: 1px solid #333; border-right: 1px solid #333;">
										Description
									</th>
									<th style="width: 20%; font-weight: bold; border-bottom: 1px solid #333;">
										Cost
									</th>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
								<tr>
									<td style="width: 80%; border-bottom: 1px solid #333; border-right: 1px solid #333;" contenteditable>
									</td>
									<td style="width: 20%; border-bottom: 1px solid #333;" contenteditable>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table style="margin-top: 3px; margin-bottom: 3px; padding: 3px; width: 100%; border-top: 2px solid #333; border-bottom: 2px solid #333; border-radius: 2px; background-color: rgba(63,169,245, 1);">
					<tr>
						<th style="width: 50%; text-align: center; font-size: 2.5em; font-weight: bold;">
						</th>
						<th style="width: 50%; text-align: center; font-size: 2.5em; font-weight: bold;">
						</th>
					</tr>
				</table>
				<table style="width: 100%;">
					<tr>
						<td style="width: 50%;">
							<table style="margin-left: 5px; padding: 5px; width: 98%; height: 200px; max-height: 200px; background-color: #fff;">
								<tr>
									<td style="text-align: justify; font-size: .8em;">
										I hear by authorize the above repair work to be done along with the necessary materials and hereby grant you and/or your employees permission to operate the vehicle herein described streets, highways or elsewhere for the sole purpose of test and/or inspection. An express mechanics lien is hereby acknowledged on above vehicle to secure the amount of repairs thereto. You are entitled to entitled to a price estimate for the repairs you have authorized. The repair price may be less than the estimate but will not exceed the estimate without your permission. Your signature will indicate your agreement.
									</td>
								</tr>
							</table>
						</td>
						<td style="width: 50%;">
							<table style="margin-left: 5px; padding: 3px; width: 98%; height: 200px; background-color: #fff;">
								<tr>
									<td>
										<table style="width: 100%;">
											<tr>
												<td style="width: 35%;">
													<table style="width: 100%; font-size: .7em; ">
														<tr>
															<td style="text-align: right;">
																Cash:
															</td>
															<td style="width: 40%; border-bottom: 1px solid #000;" contenteditable>
															</td>
														</tr>
														<tr>
															<td style="text-align: right;">
																Card:
															</td>
															<td style="width: 40%; border-bottom: 1px solid #000;" contenteditable>

															</td>
														</tr>
														<tr>
															<td style="text-align: right;">
																Date:
															</td>
															<td style="width: 40%; border-bottom: 1px solid #000;" contenteditable>

															</td>
														</tr>
														<tr>
															<td style="text-align: right;">
																Work Finish:
															</td>
															<td style="width: 40%; border-bottom: 1px solid #000;" contenteditable>

															</td>
														</tr>
													</table>
												</td>
												<td style="width: 65%;">
													<table style="width: 100%;">
														<tr>
															<td style="font-size: .8em; text-align: right; font-weight: bold; width: 50%;">
																DISCOUNTS.
															</td>
															<td style="border-bottom: 1px solid #000; font-size: .8em;" contenteditable>
															</td>
														</tr>
														<tr>
															<td style="font-size: .8em; text-align: right; font-weight: bold; width: 50%;">
																SUB TOTAL.
															</td>
															<td style="border-bottom: 1px solid #000; font-size: .8em;" contenteditable>
															</td>
														</tr>
														<tr>
															<td style="font-size: .8em; text-align: right; font-weight: bold; width: 50%;">
																TAX AMOUNT.
															</td>
															<td style="border-bottom: 1px solid #000; font-size: .8em;" contenteditable>
															</td>
														</tr>
														<tr>
															<th style="font-size: 1.5em; text-align: right; font-weight: bold; width: 50%;" contenteditable>
																TOTAL:
															</th>
															<th contenteditable>
															</th>
														</tr>
												</td>
											</tr>
										</table>

									</td>
								</tr>
							</table>
						</td>
					</tr>


					<tr>
						<td colspan="2" style="widht: 100%; height: 50px; border-bottom: 2px solid #000;">
							<span style="margin-top: 25px; float: left; position: relative;">X</span>
							<span style="float: right; position: relative; color: red; font-size: 2em;">*</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
</table>
</body>
</html>
