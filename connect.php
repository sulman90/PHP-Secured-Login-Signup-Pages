<?php


 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "root";
 $db = "itc-job";
 
 
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 
 return $conn;
 
 
function CloseCon($conn)
 {
 $conn -> close();
 }
?>