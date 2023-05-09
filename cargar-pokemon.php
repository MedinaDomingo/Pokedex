<?php
include_once "conexion.php";
$conn = getConexion("pokemon");
function obtener_pokemon_info()
{
    $pokemon_info = array();
    $url = "https://pokeapi.co/api/v2/pokemon?limit=20";
    $respuesta = file_get_contents($url);
    $resultado = json_decode($respuesta);

    foreach ($resultado->results as $pokemon) {
        $info = array();
        $info["nombre"] = $pokemon->name;

        $respuesta = file_get_contents($pokemon->url);
        $resultado = json_decode($respuesta);

        $info["id"] = $resultado->id;
        $info["imagen"] = $resultado->sprites->front_default;
        $info["tipo"] = $resultado->types[0]->type->name;
        $info["descripcion"] = obtener_descripcion($resultado);

        array_push($pokemon_info, $info);
    }

    return $pokemon_info;
}

function obtener_descripcion($resultado)
{
    $url = $resultado->species->url;
    $respuesta = file_get_contents($url);
    $resultado = json_decode($respuesta);

    foreach ($resultado->flavor_text_entries as $entrada) {
        if ($entrada->language->name == "es") {
            return $entrada->flavor_text;
        }
    }

    return "";
}

$pokemon_info = obtener_pokemon_info();

foreach ($pokemon_info as $pokemon) {
    $sql = "INSERT INTO pokemones ( `numero`, `tipo`, `nombre`, `descripcion`, `imagen`) VALUES (?, ?, ?, ?, ?)";


    $statment = $conn->prepare($sql);

    $statment->bind_param("sssss",$pokemon["id"],$pokemon["tipo"],$pokemon["nombre"] ,$pokemon["descripcion"],$pokemon["imagen"]);

    $result = $statment->execute();


}
$conn->close();
?>