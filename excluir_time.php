<?php
include("conexao.php");

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID inválido.");
}

$id = intval($_GET["id"]);
$sql = "DELETE FROM times WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: index.php");
exit;
?>