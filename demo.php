<!DOCTYPE html>
<html>
  <head>
		<title>Shrink-a-Link</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
	
<?php
require "config.php";
require "main.php";
?>
	
		<div id="header">Shrink-a-Link</div>
		
		<div id="ribbon-container">
				<div class="ribbon git"><a href="http://s.zbee.me/lob">SaL is on Github!</a></div>
				<?php echo $error; ?>
		</div>

		<form action="#" method="post" id="main">
				<em>Insert a link to have it shrunk</em><br>
				<input type="text" name="url">
				<br>
				<input class="punch" type="submit" value="Shrink!">
		</form>

	
		<div id="footer">Shrink-a-link made by Zbee 2014</div>
		
	</body>
</html>
