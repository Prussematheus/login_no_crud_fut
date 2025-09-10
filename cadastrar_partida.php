<?php

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $time_casa_id = $_POST["time_casa_id"];
    $time_fora_id = $_POST["time_fora_id"];
    $data_jogo = $_POST["data_jogo"];
    $gols_casa = $_POST["gols_casa"];
    $gols_fora = $_POST["gols_fora"];

        if("time_casa_id" === "time_fora_id"){
            echo "<script>
        alert('Um time não pode jogar contra ele mesmo.')
        window.location.href = 'cadastrar_partida.php';
        </script>";
    // Validação dos IDs dos times
    $sql = "SELECT id FROM times WHERE id IN (?, ?)";
        }else{

    $sql = "INSERT INTO times(time_casa_id, time_fora_id, data_jogo, gols_casa, gols_fora) VALUES";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "Partida cadastrada com sucesso!";
    }else
        echo "Erro ao cadastrar!";
        }
    }
?>

<form method="POST">
    ID do time da casa: <input type="number" name="time_casa_id"><br>
    ID do Time de fora: <input type="number" name="time_fora_id"><br>
    Data do jogo: <input type="date" name="data_jogo"><br>
    Gols do time da casa: <input type="number" name="gols_casa"><br>
    Gols do time de fora: <input type="number" name="gols_fora"><br>
    <input type="submit" value="Cadastrar">
</form>