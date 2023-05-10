<?php
include_once 'conexion.php';


function buscarPorNombreId($idnombre)
{
    $conn = getConexion('pokemon');
    $sql = "SELECT * FROM pokemones where numero= ? OR nombre=? ";

    $statement = $conn->prepare($sql);

    $statement->bind_param("ss", $idnombre, $idnombre);


    $statement->execute();
    $resultado = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $conn->close();

    if (empty($resultado)) {
        throw  new Exception("No se encontro el pokemon");
    }else{
        return $resultado[0];
    }

}

function buscarTodos()
{
    $conn = getConexion('pokemon');
    $sql = "SELECT * FROM pokemones";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $resultado = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $conn->close();


    return $resultado;


}

function buscarUsuario($nombre)
{
    $conn = getConexion('pokemon');
    $sql = "SELECT * FROM usuario where nombre=? ";

    $statement = $conn->prepare($sql);

    $statement->bind_param("s", $nombre);


    $statement->execute();
    $resultado = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $conn->close();

    if (empty($resultado)) {
        return 0;
    }else{
        return "<p class='text-red-400 block w-full text-center'>Usuario existente</p>";
    }

}

