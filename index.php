<?php
session_start();
include_once("buscar.php");
if (isset($_POST["iniciarsesion"])) {

    if (buscarUsuariocontrasenia($_POST["usuario"], $_POST["clave"])) {
        $_SESSION["validado"] = 1;
        $_SESSION["usuario"] = $_POST["usuario"];
        header("Location: interno.php");
        exit();
    } else {
        setcookie("seguridad", "0", time() - 6000);
        echo "Error de usuario o clave";
    }
    /* if ($_POST["usuario"] == "pepe" && $_POST["clave"] == "1234") {
    $_SESSION["validado"] = 1;
    $_SESSION["usuario"] = $_POST["usuario"];
    header("Location: interno.php");
    exit();
    } else {
    setcookie("seguridad", "0", time() - 6000);
    echo "Error de usuario o clave";
    } */
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">

    <title>Pokedex</title>
</head>

<body>
    <header>
        <?php if (isset($_SESSION['usuario'])) {
            include_once('loggedNav.html');
        } else {
            include_once('guestNav.html');
        } ?>
    </header>
    <main class="container mx-auto max-sm:px-6 py-2.5 max-w-screen-xl ">
        <form action="index.php" class="flex max-sm:flex-col">
            <input type="text" name="idnombre"
                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-5/6 rounded-md sm:text-sm focus:ring-1 mr-2 sm:w-full max-sm:w-full"
                placeholder="Nombre o número" />
            <input type="submit" name="buscar" value="Quien es este Pokemon" style="cursor:pointer;"
                class="mt-1 px-2 py-2 bg-blue-700 text-white hover:bg-blue-800  shadow-sm border-slate-300  block w-1/4 rounded-md sm:text-sm focus:ring-1  max-sm:w-full" />
        </form>

        <table class="mx-auto">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once "buscar.php";


                if (empty($_GET["idnombre"])) {
                    $resultado = buscarTodos();
                    foreach ($resultado as $pokemon) {
                        mostrarPokemon($pokemon);
                    }
                } else {

                    try {

                        $resultado = buscarPorNombreId($_GET['idnombre']);
                        mostrarPokemon($resultado);
                    } catch (Exception $e) {
                        echo '<p class="text-center text-rose-600">' . $e->getMessage() . '</p>';
                        $resultado = buscarTodos();
                        foreach ($resultado as $pokemon) {
                            mostrarPokemon($pokemon);
                        }
                    }
                }

                function mostrarPokemon($pokemon)
                {
                    echo '<tr  class="border-b-2">';
                    echo '<td>' . $pokemon['numero'] . '</td>';
                    echo '<td>' . ucfirst($pokemon['nombre']) . '</td>';
                    echo '<td class="ml-4 pl-4">' . "<img src='assets/types/" . $pokemon['tipo'] . ".png'>" . '</td>';
                    echo '<td class="pl-4">' . $pokemon['descripcion'] . '</td>';
                    echo '<td><img src="' . $pokemon['imagen'] . '"></td>';
                    echo '</tr>';
                }

                ?>


            </tbody>
        </table>
    </main>
</body>

</html>