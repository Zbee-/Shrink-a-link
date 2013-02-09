<?php
    $db_connect   =    mysql_connect("localhost", "**DATABASE USERNAME**", "**DATABASE PASSWORD**") or die(mysql_error());
      //Database Connection
      //Default: "mysql_connect("localhost", "**DATABASE USERNAME**", "**DATABASE PASSWORD**") or die(mysql_error())"

    $db_select    =    mysql_select_db("**DATABASE NAME**");
      //Database Selection
      //Default: "mysql_select_db("**DATABASE NAME**")"

    $root_url = "http://**YOUR SITE**.com";
      //The root url of your installment of S-a-L (No trailing slash)
      //Default: "http://**YOUR SITE**.com"
?>
