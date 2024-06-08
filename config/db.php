<?php
$servername = "127.0.0.1";
$username = 'root';
$password = 'phiaganda@123';
$dbname =  'enriquez_mysql';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

