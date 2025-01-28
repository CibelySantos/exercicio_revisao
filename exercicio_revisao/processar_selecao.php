<?php
session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: ./index.php'); 
    exit();
}

if (isset($_POST['filme'])) {
    $produto_selecionado = $_POST['filme'];
    echo "Filme selecionado: " . $filme_selecionado;
}
?>
