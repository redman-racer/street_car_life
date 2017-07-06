<?php
require 'functions.php';
?>
<html>
<head>
<title>The Street Car Life Game</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
@font-face {
font-family: password;
src: url(/fonts/The_Gun.ttf);
}
@font-face {
font-family: thegun;
src: url(/fonts/The_GunR.ttf);
}
@font-face {
font-family: navigation;
src: url(/fonts/LaSpacinoLite-Regular.otf);
}
body{
	background-color: #000;
	margin-top: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	text-align: center;
}
.login_box{
	width: 100%;
	height: 100%;
	background: transparent;
	border: none;
	text-align: center;
	font-family: thegun;
	font-size: 28px;
}
#navigation{
	margin: 50px auto;
	color: #efefef;
	font-size: 25px;
	font-family: navigation;
}
#navigation a:link {
color: #efefef;
padding-left: 25px;
padding-right: 25px;
font-family: navigation;
text-decoration: none;
font-size: 35px;
}
#navigation a:visited{
color: #efefef;
font-family: navigation;
text-decoration: none;
}
#navigation a:hover {
text-shadow: 1px 1px 3px #989898;
font-family: navigation;
color: #fff;
text-decoration: none;
}
#navigation a:active {
color: #efefef;
font-family: navigation;
text-decoration: underlnine;
}
#Table_01 {
	position: absolute;
	margin: 0px auto;
	text-align: center;
	width: 100%;
	height:901px;
}

#login-page-1 {
	position:absolute;
	background-image: url(images/login-page_1.jpg);
	left:0px;
	top:0px;
	width:1891px;
	height:128px;
}

#login-page-2 {
	position:absolute;
	left:0px;
	top:128px;
	width:1891px;
	height:191px;
}

#login-page-3 {
	position:absolute;
	left:0px;
	top:319px;
	width:412px;
	height:582px;
}

#login-page-4 {
	position:absolute;
	background-image: url(images/login-page_4.jpg);
	left:412px;
	top:319px;
	width:300px;
	height:59px;
}

#login-page-5 {
	position:absolute;
	left:712px;
	top:319px;
	width:1179px;
	height:582px;
}

#login-page-6 {
	position:absolute;
	background-image: url(images/login-page_6.jpg);
	left:412px;
	top:378px;
	width:300px;
	height:59px;
}

#login-page-7 {
	position:absolute;
	left:412px;
	top:437px;
	width:300px;
	height:39px;
}

#login-page-8 {
	position:absolute;
	left:412px;
	top:476px;
	width:300px;
	height:425px;
}

-->
</style>
</head>
<body>
<div id="Table_01">
	<!--BANNER/NAVIGATION-->
	<div id="login-page-1">
		<div id="navigation">
			<a href="register.php">Register </a>|<a href="index.php"> Login </a>|<a href="contact.php"> Contact Us</a> | Test:
		</div>
	</div>
	<div id="login-page-2">
		<img src="images/login-page_2.jpg" width="1891" height="191">
	</div>
	<div id="login-page-3">
		<img src="images/login-page_3.jpg" width="412" height="582">
	</div>

		<form method="POST" name="user_login" id="user_login" autocomplete="off" title="Login using your full name" action="/login.php" >
			<!--USERNAME-->
			<div id="login-page-4">
				<input type="text" class="login_box" name="user_name" id="user_name" placeholder="Username" />
			</div>
			<div id="login-page-5">
				<img src="images/login-page_5.jpg" width="1179" height="582">
			</div>
			<!--PASSWORD-->
			<div id="login-page-6">
				<input type="password" class="login_box" name="user_password" id="user_password" placeholder="Password" style="font-family: password;" />
			</div>
			<!--GO-->
			<div id="login-page-7">
				<input type="image" src="images/login-page_7.jpg" alt="Login!" name="user_login_submit" id="user_login_submit" width="300" height="39" value="1" />
			</div>
		</form>

	<div id="login-page-8">
		<img src="images/login-page_8.jpg" width="300" height="425">
	</div>
</div>
</body>
</html>
