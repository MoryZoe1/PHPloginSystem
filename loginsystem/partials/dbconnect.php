<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'users';


$conn = mysqli_connect($server,$username,$password,$database);


if (!$conn) {

    die("My sqli" . mysqli_connect_error());
}





?>