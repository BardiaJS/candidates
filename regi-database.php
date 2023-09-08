<?php
require("config.php");
try {

    $conn = new PDO("mysql:host=" . host . ";dbname=" . dbname . "", user, pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connection is successful";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}








?>