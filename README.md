#Shrink-a-link
=============
A Link shrinker made in PHP, it's very light and easy to use.

##Setup

Use this SQL code to create a table to house all the links.
``` bash
CREATE TABLE `links` (
  `link` VARCHAR(512) NULL,
	`shrink` VARCHAR(255) NULL
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM;
````

##Use
To use it, you can simply download Shrink-a-Link as a .zip and replace all the ***REPLACE ME***'s with valid code.

If you wanna go into the details, stay here.


###PHP (Generation and Error checking)

This code is made with the assumption that the table you just made was named links, with the columns of "link" and "shrink".

Please replace the value of $root_url with your website (if you own cows.com make $root_url = "http://cows.com";)

``` bash
<?php
    $root_url = "http://**YOUR SITE**.com"; //No trailing slash. Bad: http://example.com/. Good: http://example.com.
    
  	$error = "";
		$good = true;
		$sgood = true;

//MySQL connect
	mysql_connect("localhost", "**DATABASE USERNAME**", "**DATABASE PASSWORD**") or die(mysql_error());
	mysql_select_db("**DATABASE NAME**");

//Non-existant links
		if (isset($_GET['exist'])) {
			$exist = $_GET['exist'];
		} else {
			$exist = "yes";
		}

		if (isset($_GET['attempt'])) {
			$attempt = $_GET['attempt'];
		} else {
			$attempt = "";
		}

		if ($exist == "no" && $attempt != "") {
			$deleted = yes;
			$error .= '<div class="ribbon">Sorry, '.$root_url.'/'.$attempt.' does not exist.</div><br>';
		}

		if ($exist == "no" && $deleted != yes) {
			$error .= '<div class="ribbon">Sorry, the shrunken url you tried to visit does not exist.</div><br>';
		}

		if ($exist = "no") {
			mysql_query("DELETE FROM links WHERE shrink='".$attempt."' LIMIT 1");
		}

//Functions
		function sanitize($sql, $formUse = true) {
			$sql = preg_replace("/(from|script|src|select|insert|delete|where|drop table|show tables|`|,|'|\*|\\\\)/i","",$sql);
			$sql = trim($sql);
			$sql = strip_tags($sql);
			if(!$formUse || !get_magic_quotes_gpc()) {
				$sql = addslashes($sql);
			}
			return $sql;
		}
		
		function genshrink() {
			$chars = "abcdefghijklmnopqrstuvwxyz-_0123456789";	
			$length = 5;
			$size = strlen( $chars );
			for( $i = 0; $i < $length; $i++ ) {
				$str .= $chars[ rand( 0, $size - 1 ) ];
			}
		
			return $str;
		}
		
//Shrink
		if (isset($_POST['url'])) {
			$shrink = genshrink();
			
			if (strlen($shrunk) !== 5) {
				$shrink = genshrink();
			}

			$url = sanitize($_POST['url']);
			if (empty($url)) {
				$error .= '<div class="ribbon">You have nothing in the url box.</div><br/>';
				$good = false;
			}

//If given url matches a url already in the table, simply return that url's shrink code
			$match_query = mysql_query("SELECT * FROM links WHERE link='".$_POST['url']."'");
			$numrows = mysql_num_rows($match_query);
			if ($numrows == 1) {
				while ($value = mysql_fetch_array($match_query)) {
					$good = false;
					$error .= ''.$numrows.'';
					$shrink = $value['shrink'];
					$error .= '<div class="ribbon">Link shrunk successfully! <a href="'.$root_url.''.$value['shrink'].'">'.$root_url.''.$value['shrink'].'</a></div><br>';
				}
			}

			if ($good == true) {
				$query = mysql_query("INSERT INTO links (link, shrink) VALUES ('$url','$shrink')");
				if (!$query) {
					$error .= '<div class="ribbon">MySQL Error: ' . mysql_error() . '</div><br>';
				} else {
					$error .= '<div class="ribbon">Link shrunk successfully! <a href="'.$root_url.''.$shrunk.'">'.$root_url.''.$shrunk.'</a></div><br>';
				}
			}
		}
?>
````

###.htaccess file
Since you're not actually going to generate a page that simple redirects example.com/oupn to example.com/reallylongurlyou/dontwant?to=type&your=self, the .htacces file
(which should actually be called '.htaccess' when you're making the file) will redirect errors (shrunk URLs) to error.php, which will see if the
url you just tried to visit has a link attached to it; if it doesn't it makes sure to delete it.

``` bash
ErrorDocument 400 /error.php
ErrorDocument 401 /error.php
ErrorDocument 403 /error.php
ErrorDocument 404 /error.php
ErrorDocument 500 /error.php
````

###PHP (error.php -- redirection)
This area of code redirects the shrunken url to the attached link in the table. If it isn't attached to a link, then your user gets redirected to the creator of the shrunken 
links (your link shrinker) where the shrinker will attempt to delete the bad link.

``` bash
<!DOCTYPE html>
<html>
  <head>
		<title>Shrink-a-Link Redirecting</title>
	</head>
	<body>
	
	<?php
  
    $root_url = "http://**YOUR SITE**.com"; //No trailing slash. Bad: http://example.com/. Good: http://example.com.

//MySQL connect
	mysql_connect("localhost", "**DATABASE USERNAME**", "**DATABASE PASSWORD**") or die(mysql_error());
	mysql_select_db("**DATABASE NAME**");

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    $start  = $length * -1; //negative
    return (substr($haystack, $start) === $needle);
}

$page = substr($_SERVER['REQUEST_URI'], 1);

if (endsWith($page, "/")) {

    $page = substr_replace($page, "", -1);
}

if ($page == "" || empty($page)) {
    echo '<script type="text/javascript">
	<!--
	window.location="'.$root_url.'?exist=no";
	// -->
	</script>';
}

$query = mysql_query("SELECT original FROM links WHERE shrink='".$page."'");
$num_rows = mysql_num_rows($query);

if ($num_rows == 1) {
	while ($value = mysql_fetch_array($query)) {
		echo '<script type="text/javascript">
		<!--
		window.location="'.$value['link'].'";
		// -->
		</script>';
	}
} else {
    echo '<script type="text/javascript">
	<!--
	window.location="'.$root_url.?exist=no&attempt='.$page.'";
	// -->
	</script>';
}
?>
		Redirecting . . .
	</body>
</html>
````

###Theme

For sake of space, I'm not putting the theme css on this readme, just go copy the style.css file.

##Features
>URL Comparison - If there's already a shrunken link with the URL the user just inputed, it simply returns the shrunken URL.

>URL Variety - ~8 million possible shrunken URLs with the default 5 character shrink code

>Simplicity - Takes the user's URL, stores it, generates a code, and returns it as a link; simple as that

>Input Sanitization - Sanitizes user inputs by removing nast SQL code such as DELETE and DROP, keeping your table(s) safe

>Error Detection - Checks to make sure that the user input something so you don't wind up with a table half empty

>Self Cleansing - When a user visits a shrunken url (example.com/uopn2, per se) and that link doesn't have a redirect url attached to it, the shrinker deletes the shrink

>Themed - Comes with a nice 100% liquid CSS3 theme compatible with most browsers

>Free - It's made by me, and therefore free :)

>Non-space consuming - Only requires 4 files

>Tiny - Coded in less than 300 lines of code

## License
Author: Zbee <http://zbee.me> <zbee@zbee.me>

Licensed under AOL <http://zbee.me/aol>
