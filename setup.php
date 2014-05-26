<?php

require "config.php";

$links =
mysql_query("

CREATE TABLE ".$db_preface."`links` (
	`ID` int(128) NOT NULL AUTO_INCREMENT,
	`link` VARCHAR(1024) NULL,
	`shrink` VARCHAR(256) NULL,
	`visits` INT(128) NOT NULL DEFAULT '0', "./*If you REALLY don't want tracking at all, you can delete this whole line, but you  can't re-enable tracking without adding this column to the table*/."
	PRIMARY KEY (ID)
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM;
AUTO_INCREMENT=0;

");

if ($links) { #If the links table was made successfully, let the user know
  echo '> Links table made successfully ('.$db_preface.'links)';
} else {
  echo '<font style="color: red"> Links table NOT made successfully (name may be taken, or you might not be connected to your database correctly).</font>';
}

?>