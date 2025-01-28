<?php
session_start();

if (isset($_SESSION['nome_usuario'])) {
    unset($_SESSION['nome_usuario']); 
}

session_unset();

session_destroy();
header('Location: index.php');
exit();
?>