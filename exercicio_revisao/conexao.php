<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'sitema_login';

$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die('Falha na conexão com o banco de dados'. mysqli_connect_error());
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
    
</body>
</html>