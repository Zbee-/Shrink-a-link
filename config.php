<?php
    $db_connect   = mysql_connect("localhost", "**DATABASE USERNAME**", "**DATABASE PASSWORD**") or die(mysql_error());
      //Database Connection
      //Default: "mysql_connect("localhost", "**DATABASE USERNAME**", "**DATABASE PASSWORD**") or die(mysql_error())"

    $db_select    = mysql_select_db("**DATABASE NAME**");
      //Database Selection
      //Default: "mysql_select_db("**DATABASE NAME**")"
      
    $db_preface   = "sal_"
      //Database Name Preface (if it's set to "sal_" the database made and used will be "sal_links")
      //Default: "sal_"

    $root_url = "http://**YOUR SITE**.com";
      //The root url of your installment of S-a-L (No trailing slash)
      //Default: "http://**YOUR SITE**.com"
      
    $char_string  = "abcdefghijklmnopqrstuvwxyz0123456789";
      //The selection of characters that a shrink comes from (note: S-a-L does not currently recognize capitalization)
      //Default: "abcdefghijklmnopqrstuvwxyz0123456789"

    $length = 3;
      //The length of the generated shrink (5 produces ~60 million codes {36^5}), Will expand when you run out of possible shrinks
      //Default: "5"
      
     $tracking = true
      //Whether or not links are tracked
      //Default: true
?>
