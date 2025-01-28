<?php
session_start();
include './sql/conexao.php';

if ($_SESSION['usuario_sessao']=="" && $_SESSION['tipo_sessao']=="") {
    header("Location: index.php");
    exit();
}

$query = "SELECT * FROM filme"; 
$result = mysqli_query($connection, $query);

$query_select = "SELECT nome FROM filme";
$result_select = mysqli_query($connection, $query_select);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
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