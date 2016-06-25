<?php
// Failas, skirtas prisijungimui pire duomenų bazės

// Čia įveskite duomenis prisijungimui prie duomenų bazės
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";

// Prisijungiama prie duomenų bazės
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}