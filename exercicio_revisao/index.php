<?php
include 'sql/conexao.php';
session_start();

$erro = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios WHERE nome = '$nome'";
    $result = mysqli_query($connection, $query);

    if ($result->num_rows > 0) {
        $usuario_logado = mysqli_fetch_assoc($result);

        if (password_verify($senha, $usuario_logado['senha'])) {
            $_SESSION['usuario_sessao'] = $usuario_logado['nome'];
            $_SESSION['tipo_sessao'] = $usuario_logado['tipo_usuario'];
            header('Location: dashboard.php');
            exit();
        } else {
            $erro = 'Senha incorreta';
        }
    } else {
        $erro = 'Usuário não encontrado';
    }
}

if ($erro) {
    $_SESSION['erro_login'] = $erro;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
    <link rel="icon" href="../img/img_para_colocar_no_title-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="login">
        
        <form action="" method="POST">
            <label for="nome">Nome:</label>
            <input name="nome" type="text" required>

            <label for="senha">Senha:</label>
            <input name="senha" type="password" required>

            <button type="submit">Enviar</button>

            <a id="cadastro" href="cadastro.php">Cadastre-se</a>
        </form>
    </div>

    <script>
    <?php if (isset($_SESSION['erro_login'])): ?>
        switch ('<?php echo $_SESSION['erro_login']; ?>') {
            case 'Senha incorreta':
                Swal.fire({
                    icon: 'error',
                    title: 'Senha incorreta',
                    text: 'A senha fornecida está incorreta. Tente novamente.',
                    confirmButtonText: 'Ok'
                });
                break;
            case 'Usuário não encontrado':
                Swal.fire({
                    icon: 'warning',
                    title: 'Usuário não encontrado',
                    text: 'O nome de usuário não foi encontrado. Verifique e tente novamente.',
                    confirmButtonText: 'Ok'
                });
                break;
            default:
                Swal.fire({
                    icon: 'error',
                    title: 'Erro desconhecido',
                    text: 'Ocorreu um erro inesperado.',
                    confirmButtonText: 'Ok'
                });
                break;
        }
        <?php unset($_SESSION['erro_login']); ?>
    <?php endif; ?>
</script>


</body>
</html>
