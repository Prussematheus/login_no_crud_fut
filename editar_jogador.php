
<?php
include("conexao.php");

// Validação do parâmetro id
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID inválido.");
}
$id = intval($_GET["id"]);

// Busca segura do usuário
$sql = "SELECT * FROM jogadores WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$dado = mysqli_fetch_assoc($res);

if (!$dado) {
    die("Jogador não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $posicao = $_POST["posicao"];
    $numero_camisa = $_POST["numero_camisa"];
    $time_id = $_POST["time_id"];

     
    if($numero_camisa< 1 || $numero_camisa > 99){
        echo "<script>
        alert('Número da camisa deve estar entre 1 e 99.')
        window.location.href = 'editar_jogador.php';
        </script>";
    }else{
    // Atualização segura
    $sql = "UPDATE jogadores SET nome = ?, posicao = ?, numero_camisa = ?, time_id = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssiii", $nome, $posicao, $numero_camisa, $time_id, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}}
?>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($dado['nome']); ?>"><br>
    Posição: <input type="text" name="posicao" value="<?php echo htmlspecialchars($dado['posicao']); ?>"><br>
    Número da Camisa: <input type="number" name="numero_camisa" value="<?php echo htmlspecialchars($dado['numero_camisa']); ?>"><br>
    Time ID: <input type="number" name="time_id" value="<?php echo htmlspecialchars($dado['time_id']); ?>"><br>
    <input type="submit" value="Salvar">
</form>