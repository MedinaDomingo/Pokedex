<?php
session_start();

if (!isset($_SESSION['usuario'])) {
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
                    <button
                        class="ml-2 mt-1 px-2 py-2 bg-blue-700 text-white hover:bg-blue-800  shadow-sm border-slate-300  block w-full rounded-md sm:text-sm focus:ring-1">
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
                placeholder="Nombre o número" />
            <input type="submit" name="buscar" value="Quien es este Pokemon" style="cursor:pointer;"
                class="mt-1 px-2 py-2 bg-blue-700 text-white hover:bg-blue-800  shadow-sm border-slate-300  block w-1/4 rounded-md sm:text-sm focus:ring-1  max-sm:w-full" />
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
                    echo '<form method="post">';
                    echo '<tr>';
                    echo '<td><input type="text" name="numero" readonly value="' . $resultado['numero'] . '"></td>';
                    echo '<td><input type="text" name="nombre" value="' . $resultado['nombre'] . '"></td>';
                    echo '<td>' . $resultado['descripcion'] . '</td>';
                    echo '<td><img src="' . $resultado['imagen'] . '"></td>';
                    echo '</tr>';

                    echo '<button type="submit" name="modificar" class="mx-auto mt-1 px-2 py-2 bg-blue-700 text-white hover:bg-blue-800  shadow-sm border-slate-300  block w-1/4 rounded-md sm:text-sm focus:ring-1  max-sm:w-full">Confirmar</button>';

                    echo '</form>';
                } catch (Exception $e) {
                    echo '<p class="text-center text-rose-600">' . $e->getMessage() . '</p>';
                }

                if (isset($_POST["modificar"])) {
                    $nuevoNombre = $_POST["nombre"];
                    $numero = $_POST['numero'];

                    $sql = "UPDATE pokemones SET nombre = ? WHERE numero = ?";

                    $conn = getConexion('pokemon');
                    $statment = $conn->prepare($sql);

                    $statment->bind_param('ss', $nuevoNombre, $numero);
                    $statment->execute();

                    echo "<div class='mx-auto' style='width: fit-content;background-color: #79fd79;padding: 1rem;border: 1px solid #000;margin-top: 1rem;margin-bottom: 1rem;'><p> Pokemon modificado exitosamente</p></div>";
                }

                ?>



            </tbody>
        </table>
    </main>
</body>

</html>





</tbody>
</table>
</main>
</body>

</html>