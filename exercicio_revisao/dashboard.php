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
    <h2>Lista de Filmes</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome do Filme</th>
            <th>Gênero</th>
            <th>Data de lançamento</th>
        </tr>
        <?php
        while ($filme = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $filme['id'] . "</td>";
            echo "<td>" . $filme['nome'] . "</td>";
            echo "<td>" . $filme['genero'] . "</td>";
            echo "<td>" . $filme['data_lancamento'] . "</td>";

            echo "</tr>";
        }
        ?>
    </table>
    <a href="logout.php">Sair</a>
</body>
</html>