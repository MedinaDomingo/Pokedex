<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("location: index.php");
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
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
                    <button  class="ml-2 mt-1 px-2 py-2 bg-blue-700 text-white hover:bg-blue-800  shadow-sm border-slate-300  block w-full rounded-md sm:text-sm focus:ring-1">
                        <a href="cerrar-sesion.php">Salir</a>
                    </button>
                </div>


        </div>

        </div>
    </nav>
</header>
<main class="container mx-auto max-sm:px-6 py-2.5 max-w-screen-xl ">
    <form action="" class="flex max-sm:flex-col">
        <input type="text" name="idnombre"
               class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-5/6 rounded-md sm:text-sm focus:ring-1 mr-2 sm:w-full max-sm:w-full"
               placeholder="Nombre o número"/>
        <input type="submit" name="buscar" value="Quien es este Pokemon"
               class="mt-1 px-2 py-2 bg-blue-700 text-white hover:bg-blue-800  shadow-sm border-slate-300  block w-1/4 rounded-md sm:text-sm focus:ring-1  max-sm:w-full"/>
    </form>

    <table class="mx-auto w-full">
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



            try {
                $resultado = buscarPorNombreId($_GET['id']);
                echo '<tr>';
                echo '<td>' . $resultado['numero'] . '</td>';
                echo '<td><input type="text" value="' . $resultado['nombre'] . '"></td>';
                echo '<td>' . $resultado['tipo'] . '</td>';
                echo '<td>' . $resultado['descripcion'] . '</td>';
                echo '<td><img src="' . $resultado['imagen'] . '"></td>';
                echo '</tr>';
            } catch (Exception $e) {
                echo '<p class="text-center text-rose-600">' . $e->getMessage() . '</p>';
            }


        ?>


        </tbody>
    </table>
</main>
</body>
</html>



