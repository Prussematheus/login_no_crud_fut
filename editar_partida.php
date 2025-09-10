
<?php
include("conexao.php");

// Validação do parâmetro id
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID inválido.");
}
$id = intval($_GET["id"]);

// Busca segura do usuário
$sql = "SELECT * FROM partidas WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$dado = mysqli_fetch_assoc($res);

if (!$dado) {
    die("Partida não encontrada.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $time_casa_id = $_POST["time_casa_id"];
    $time_fora_id = $_POST["time_fora_id"];
    $data_jogo = $_POST["data_jogo"];
    $gols_casa = $_POST["gols_casa"];
    $gols_fora = $_POST["gols_fora"];

      if($time_casa_id === $time_fora_id){
            echo "<script>
        alert('Um time não pode jogar contra ele mesmo.')
        window.location.href = 'editar_partida.php';
        </script>";
    // Validação dos IDs dos times
    $sql = "SELECT id FROM times WHERE id IN (?, ?)";
        }else{

    // Atualização segura
    $sql = "UPDATE partidas SET time_casa_id = ?, time_fora_id = ?, data_jogo = ?, gols_casa = ?, gols_fora = ?  WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iissii", $time_casa_id, $time_fora_id, $data_jogo, $gols_casa, $gols_fora, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}}
?>

<form method="POST">
    ID do time da casa: <input type="number" name="time_casa_id" value="<?php echo htmlspecialchars($dado['time_casa_id']); ?>"><br>
    ID do time de fora: <input type="number" name="time_fora_id" value="<?php echo htmlspecialchars($dado['time_fora_id']); ?>"><br>
    Data do Jogo: <input type="date" name="data_jogo" value="<?php echo htmlspecialchars($dado['data_jogo']); ?>"><br>
    Gols do time da casa: <input type="number" name="gols_casa" value="<?php echo htmlspecialchars($dado['gols_casa']); ?>"><br>
    Gols do time de fora: <input type="number" name="gols_fora" value="<?php echo htmlspecialchars($dado['gols_fora']); ?>"><br>
    <input type="submit" value="Salvar">
</form>