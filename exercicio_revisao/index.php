<?php
include './conexao.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];

    $query = "SELECT * FROM usuarios WHERE nome = '$nome'";
    $result = mysqli_query($connection, $query);

    if ($result->num_rows > 0) {
        $usuario_logado = mysqli_fetch_assoc($result);

        if (password_verify($senha, $usuario_logado['senha'])) {
            $_SESSION['usuario_sessao'] = $usuario_logado['nome'];
            $_SESSION['tipo_sessao'] = $usuario_logado['tipo_usuario'];
            header('Location: ./sucess.html');
        } else {
            echo 'Senha incorreta';
        }
    } else {
        echo 'Usuário não encontrado';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
    <link rel="icon" href="../img/img_para_colocar_no_title-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="login">
        
        <form action="" method="POST">
            <label for="nome">Nome:</label>
            <input name="nome" type="text" required>

            <label for="senha">Senha:</label>
            <input name="senha" type="password" required>

            <button type="submit">Enviar</button>

            <a id="cadastro" href="./cadastro.php">Cadastre-se</a>
        </form>
    </div>
</body>
</html>