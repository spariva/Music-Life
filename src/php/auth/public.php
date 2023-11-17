<?php
session_start();

if (isset($_SESSION["cont"])){
    $_SESSION["cont"]++;
} else{
    $_SESSION['cont'] = 0;
}

$cont = $_SESSION["cont"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Público</title>
</head>
<body>
    
</body>
</html>