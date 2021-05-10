<?php
$servername = "localhost:3306";
$username = "root";
$password = "123456";
$dbname = "MyLibrary";

$db = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($db, "UTF8");