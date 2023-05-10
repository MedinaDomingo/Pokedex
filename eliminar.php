<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: index.php");
    exit();
}

include_once "conexion.php";
$conn = getConexion('pokemon');
$sql = "DELETE FROM pokemones WHERE numero = ?";

$statement = $conn->prepare($sql);

$statement->bind_param("s", $_GET["id"]);


$statement->execute();

$conn->close();

header("location: interno.php");