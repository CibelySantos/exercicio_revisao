<?php
session_start();
include './conexao.php';

// Verificando se o usuário está logado
if (!isset($_SESSION['usuario_sessao'])) {
    header('Location: ./index.php'); // Redireciona se não estiver logado
    exit();
}

// Consultando os dados no banco
$query = "SELECT * FROM filme"; // Supondo que você tenha uma tabela 'produtos'
$result = mysqli_query($connection, $query);

// Consultando os dados para o select
$query_select = "SELECT nome FROM filme"; // Consultando os produtos
$result_select = mysqli_query($connection, $query_select);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['usuario_sessao']; ?>!</h1>

    <h2>Lista de Produtos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome do Filme</th>
            <th>Preço</th>
            <th>Descrição</th>
        </tr>
        
        <?php
        // Exibindo a lista de produtos
        while ($filme = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $produto['id'] . "</td>";
            echo "<td>" . $produto['nome'] . "</td>";

            echo "</tr>";
        }
        ?>
    </table>

    <h2>Selecione um Filme</h2>
    <form method="POST" action="processar_selecao.php">
        <label for="filme">Filme:</label>
        <select name="filme" id="filme">
            <?php
            // Preenchendo o select com os produtos
            while ($filme_select = mysqli_fetch_assoc($result_select)) {
                echo "<option value='" . $filme_select['nome'] . "'>" . $filme_select['nome'] . "</option>";
            }
            ?>
        </select>
        <button type="submit">Enviar</button>
    </form>

    <a href="logout.php">Sair</a>
</body>
</html>
