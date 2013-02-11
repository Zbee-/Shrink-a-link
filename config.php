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
      
    $char_string  =   "abcdefghijklmnopqrstuvwxyz0123456789";
      //The selection of characters that a shrink comes from (note: S-a-L does not currently recognize capitilization)
      //Default: "abcdefghijklmnopqrstuvwxyz0123456789"

    $length = 5;
      //The length of the generated shrink (5 produces ~60 million codes {36^5 = 36 * 36 * 36 * 36})
      //Default: "5"
?>
