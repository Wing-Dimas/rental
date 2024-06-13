<?php 

$hostname = "localhost";
$username = "root";
$password = "";
$db = "rental_ps";
$port = "3306";


$conn = new mysqli($hostname, $username, $password, $db, $port);

if($conn->connect_error){
    die("Connection failed. $conn->connect_error");
}