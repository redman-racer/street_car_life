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
  background: url(images/background.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
	margin-top: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
}
#Main_Container{
  position:absolute;
  width: 100%;
  height: 100%;
}
#navigation{
  position:fixed;
  text-align: center;
  background-color: #000;
  color: #efefef;
  font-size: 25px;
  font-family: navigation;
  height:88px;
  width: 100%;
  top: 0px;
  left: 0px;
  z-index: 100;
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
#logo{
  position:fixed;
  background: url(images/banner_logo.png) no-repeat center center;
  height: 117px;
  width: 100%;
  top: 88px;
  left: 0px;
  z-index: 100;
}
#content{
  margin: 195px auto 0px auto;
  padding: 20px 10px 0px 10px;
  width: 80%;
  min-height: 75%;
  border: 1px solid #000;
  background-color:rgba(255, 255, 255, 0.5);
  z-index: 50;
  text-align: center;
}
-->
</style>
</head>
<body>
<div id="Main_Container">
  <div id="navigation">
    <div style="height:88px; margin-top:40px;">
      <a href="garage.php">My Garage  </a>|<a href="logout.php">  Logout</a>
    </div>
  </div>
  <div id="logo">
  </div>
  <div id="content">
  This is some test content.
  </div>
</div>
</body>
</html>
