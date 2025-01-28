<?php
session_start();
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: ./index.php'); // Redireciona se não estiver logado
    exit();
}

if (isset($_POST['filme'])) {
    $produto_selecionado = $_POST['filme'];
    // Aqui você pode processar o produto selecionado
    echo "Filme selecionado: " . $filme_selecionado;
}
?>
