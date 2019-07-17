<?php


// // show errors (remove this line if on a live site)
// mysqli_report(MYSQLI_REPORT_ERROR);
// phpinfo();

$server = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'records2';

// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);
mysqli_report(MYSQLI_REPORT_ERROR);
?>