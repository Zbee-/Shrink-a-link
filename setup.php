<?php

require "config.php";

$users =
mysql_query("

CREATE TABLE ".$db_preface."`links` (
	`ID` int(10) NOT NULL AUTO_INCREMENT,
	`link` VARCHAR(512) NULL,
	`shrink` VARCHAR(255) NULL,
	PRIMARY KEY (ID)
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM;
AUTO_INCREMENT=0;

");

if ($users) { #If the users table was made successfully, let the user know
  echo '> Users table made successfully ('.$db_preface.'users)';
} else {
  echo '<font style="color: red"> Users table NOT made successfully (name may be taken, or you might not be connected to your database correctly).</font>';
}

?>