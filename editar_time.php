
<?php
include("conexao.php");

// Validação do parâmetro id
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID inválido.");
}
$id = intval($_GET["id"]);


$sql = "SELECT * FROM times WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$dado = mysqli_fetch_assoc($res);

if (!$dado) {
    die("Time não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cidade = $_POST["cidade"];

    // Atualização segura
    $sql = "UPDATE times SET nome = ?, cidade = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $nome, $cidade ,$id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($dado['nome']); ?>"><br>
    Cidade: <input type="text" name="cidade" value="<?php echo htmlspecialchars($dado['cidade']); ?>"><br>
    <input type="submit" value="Salvar">
</form>