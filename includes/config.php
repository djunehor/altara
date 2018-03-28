<?php
error_reporting(0);
//database variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "djunehor";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Error: Connection failed-> " . $con->connect_error);
 }
$admin_table = "admins";
$user_table = "users";
$activity_table = "activities";
$admin_folder = "test-admin"; //localtion of admin folder. Default is test-admin

?>