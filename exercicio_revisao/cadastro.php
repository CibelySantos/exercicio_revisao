<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'sistema_login';

$connection = new mysqli($host, $user, $password, $database);

if ($connection->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_usuario = $_POST['nome'];
    $pass_usuario = $_POST['senha'];
    $email_usuario = $_POST['email'];

    $pass_usuario_hash = password_hash($pass_usuario, PASSWORD_DEFAULT);

    $stmt = $connection->prepare("INSERT INTO usuarios (nome, senha, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome_usuario, $pass_usuario_hash, $email_usuario);

    if ($stmt->execute()) {
        $_SESSION['status'] = 'sucesso';
    } else {
        $_SESSION['status'] = 'erro';
        $_SESSION['erro_msg'] = $stmt->error;
    }
    $stmt->close();
    $connection->close();

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
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <div class="cadastro">
        <form function="dashboard.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="email">E-mail:</label>
            <input type="text" id="email" name="email" required><br><br>
    
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