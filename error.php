<!DOCTYPE html>
<html>
  <head>
    <title>Shrink-a-Link Redirecting</title>
  </head>
  <body>

<?php
require "config.php";

function endsWith($haystack, $needle) {
  $length = strlen($needle);
  $start  = $length * -1;
  return (substr($haystack, $start) === $needle);
}

$page = substr($_SERVER['REQUEST_URI'], 1);

if (endsWith($page, "/")) {
  $page = substr_replace($page, "", -1);
}

if ($page === "" || empty($page)) {
  echo '<script type="text/javascript">window.location="'.$root_url.'?exist=no";</script>';
}

$query = mysql_query("SELECT * FROM ".$db_preface."links WHERE shrink='".$page."'");
$num_rows = mysql_num_rows($query);

if ($num_rows === 1) {
    while ($value = mysql_fetch_array($query)) {
      if ($tracking === true) {
        $visits = $value['visits'] + 1;
        mysql_query("UPDATE links SET visits='".$visits."' WHERE shrink='".$page."'");
      }
      
      echo '<script type="text/javascript">window.location="'.$value['link'].'";</script>';
    }
} else {
    echo '<script type="text/javascript">window.location="'.$root_url.'?exist=no&attempt='.$page.'";</script>';
}
?>
        Redirecting . . .
    </body>
</html>
