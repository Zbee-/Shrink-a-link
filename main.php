<?php
//Self-Growing
$cq   = mysql_query("SELECT * FROM ".$db_preface."links");
$cnr  = mysql_num_rows($cq);
if ($cnr >= (pow(strlen($char_string),$length))) { $length += 1; }

$error = "";
$good = true;
$sgood = true;

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
	mysql_query("DELETE FROM ".$db_preface."links WHERE shrink='".$attempt."' LIMIT 1");
}

//Functions
function sanitize($sql, $formUse = true) {
	$sql = preg_replace("/(from|script|src|select|insert|delete|where|drop table|show tables|,|'|\*|--|\\\\)/i","",$sql);
	$sql = trim($sql);
	$sql = strip_tags($sql);
	if(!$formUse || !get_magic_quotes_gpc()) {
		$sql = addslashes($sql);
	}
	return $sql;
}

//Shrink
if (isset($_POST['url'])) {
	$shrink = substr(str_shuffle(str_repeat($char_string, 10)), 1, $length);

	if (strlen($shrunk) !== $length) {
		$shrink = substr(str_shuffle(str_repeat($char_string, 11)), 1, $length);
	}

	$url = sanitize($_POST['url']);
	if (empty($url)) {
		$error .= '<div class="ribbon">You have nothing in the url box.</div><br/>';
		$good = false;
	}
	
//If given url matches a url already in the table, simply return that url's shrink code
	$match_query = mysql_query("SELECT * FROM ".$db_preface."links WHERE link='".$_POST['url']."'");
	$numrows = mysql_num_rows($match_query);
	if ($numrows != 0) {
		while ($value = mysql_fetch_array($match_query)) {
			$good = false;
			$shrink = $value['shrink'];
			$error .= '<div class="ribbon">Link shrunk successfully! <a href="'.$root_url.'/'.$value['shrink'].'">'.$root_url.'/'.$value['shrink'].'</a></div><br>';
		}
	}

	$s_match_query = mysql_query("SELECT * FROM ".$db_preface."links WHERE shrink='".$shrink."'");
	$s_numrows = mysql_num_rows($s_match_query);
	if ($s_numrows != 0) {
		while ($value = mysql_fetch_array($s_match_query)) {
			$shrink = substr(str_shuffle(str_repeat($char_string, 12)), 1, $length);
		}
	}

	if ($good == true) {
		$query = mysql_query("INSERT INTO ".$db_preface."links (link, shrink) VALUES ('$url','$shrink')");
		if (!$query) {
			$error .= '<div class="ribbon">MySQL Error: ' . mysql_error() . '</div><br>';
		} else {
			$error .= '<div class="ribbon">Link shrunk successfully! <a href="'.$root_url.'/'.$shrink.'">'.$root_url.'/'.$shrink.'</a></div><br>';
		}
	}
}
?>