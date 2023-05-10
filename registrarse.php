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
            <a href="index.php" class="flex items-center">
                <img src="assets/Pokedex_logo.png" class="mr-3 h-6 h-9" alt="Flowbite Logo">
            </a>

        </div>


    </nav>
</header>

<div class="w-full mt-20 flex flex-wrap justify-center align-center">
    <h1 class="text-center w-full ">Registrarse</h1>
    <form action="registrarse.php" method="post">
        <div class="w-max flex items-center lg:order-2 flex-col ">
            <input type="text" name="usuario"
                   class=" mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md text-sm focus:ring-1"
                   placeholder="Usuario"/>
            <input type="password" name="clave"
                   class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md text-sm focus:ring-1"
                   placeholder="Contraseña"/>
            <input type="submit" name="registrarse" value="Enviar"
                   class="mt-1 px-2 py-2 bg-blue-700 text-white hover:bg-blue-800  shadow-sm border-slate-300  block w-full rounded-md text-sm focus:ring-1"/>
    </form>
</div>


</body>
</html>

<?php

if(!empty($_POST['registrarse'])){
    include_once 'conexion.php';
    include_once 'buscar.php';

    $conn = getConexion("pokemon");

    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $existe = buscarUsuario($usuario);
    if($existe == 0){
        $sql = "INSERT INTO  usuario (nombre,  contrasenia ) VALUES (?,?)";

        $statement = $conn->prepare($sql);

        $statement->bind_param("ss",$usuario , $clave);

        if($statement->execute()){
            $conn->close();
            header("location: index.php");
            exit();
        }
    }else{
        $conn->close();
        echo $existe;
    }






}
