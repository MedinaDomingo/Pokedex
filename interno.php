<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Interno</title>
</head>

<body>
    <header>
        <nav class="bg-white px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="interno.php" class="flex items-center">
                    <img src="assets/Pokedex_logo.png" class="mr-3 h-6 h-9" alt="Flowbite Logo">
                </a>

                <div class="flex items-center lg:order-2 justify-between text-white">
                    <?php
                    echo $_SESSION["usuario"];
                    ?>
                    <button
                        class="ml-2 mt-1 px-2 py-2 bg-blue-700 text-white hover:bg-blue-800  shadow-sm border-slate-300  block w-full rounded-md sm:text-sm focus:ring-1">
                        <a href="cerrar-sesion.php">Salir</a>
                    </button>
                </div>


            </div>

            </div>
        </nav>
    </header>

    <main class="container mx-auto max-sm:px-6 py-2.5 max-w-screen-x2 ">
        <form action="" class="flex max-sm:flex-col">
            <input type="text" name="idnombre"
                class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-5/6 rounded-md sm:text-sm focus:ring-1 mr-2 sm:w-full max-sm:w-full"
                placeholder="Nombre o número" />
            <input type="submit" name="buscar" value="Quien es este Pokemon" style="cursor:pointer;"
                class="mt-1 px-2 py-2 bg-blue-700 text-white hover:bg-blue-800  shadow-sm border-slate-300  block w-1/4 rounded-md sm:text-sm focus:ring-1  max-sm:w-full" />
        </form>

        <a href="subirNuevoPokemon.php" style="border: 1px solid #000; padding: 2rem;">ACA ESTOY</a>
        <div class="overflow-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
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
                        }


                    }
                    function mostrarPokemon($pokemon)
                    {
                        echo '<tr class="border-b-2">';
                        echo '<td>' . $pokemon['numero'] . '</td>';
                        echo '<td>' . ucfirst($pokemon['nombre']) . '</td>';
                        echo '<td>' . "<img src='assets/types/" . $pokemon['tipo'] . ".png' class='mx-3'>" . '</td>';
                        echo '<td>' . $pokemon['descripcion'] . '</td>';
                        echo '<td><img src="' . $pokemon['imagen'] . '"></td>';
                        echo '<td><button class="bg-yellow-300 p-2 mr-2"><a href="modificar.php?id=' . $pokemon['numero'] . '">Modificar</a></button><button class="bg-red-600 p-2 text-white"><a href="eliminar.php?id=' . $pokemon["numero"] . '">Eliminar</a></button></td>';
                        echo '</tr>';
                    }

                    ?>


                </tbody>
            </table>
        </div>

    </main>
</body>

</html>