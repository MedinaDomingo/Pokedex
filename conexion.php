<?php
function getConexion($database): mysqli
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = $database;

    $conn = new mysqli($servername, $username, $password, $database);
    return $conn;
}