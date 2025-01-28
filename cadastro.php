<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'sitema_login';

$connection =new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_usuario = $_POST['nome'];
    $email_usuario = $_POST['email'];
    $pass_usuario = $_POST['senha'];

    $pass_usuario_hash = password_hash($pass_usuario, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome_usuario, $email_usuario, $pass_usuario_hash);

    if ($stmt->execute()) {
        $_SESSION['status'] = 'sucesso';
    } else {
        $_SESSION['status'] = 'erro';
        $_SESSION['erro_msg'] = $stmt->error;
    }
    $stmt->close();
    $conn->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./css/cadastro.css">
</head>
<body>
    <div class="cadastro">
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br><br>
    
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>
    
            <button type="submit">Cadastrar</button>
        </form>
    </div>
    <?php if (isset($_SESSION['status'])): ?>
        <script>
            <?php if ($_SESSION['status'] == 'sucesso'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Cadastro realizado com sucesso!',
                    text: 'O usuário foi registrado com sucesso.',
                    confirmButtonText: 'Ok'
                });
            <?php elseif ($_SESSION['status'] == 'erro'): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao cadastrar',
                    text: '<?php echo $_SESSION['erro_msg']; ?>',
                    confirmButtonText: 'Tentar novamente'
                });
            <?php endif; ?>
        </script>
        <?php unset($_SESSION['status']); ?>
    <?php endif; ?>
</body>
</html>