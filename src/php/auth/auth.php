<?php

session_start(); //Se manda cookie y si hay se carga la sesión.

if (isset($_SESSION["cont"])){
    $cont = $_SESSION["cont"];
} else{
    $cont = "No está establecido.";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="auth.php"></form>
</body>
</html>