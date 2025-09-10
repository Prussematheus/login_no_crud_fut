<?php

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $posicao = $_POST["posicao"];
    $numero_camisa = $_POST["numero_camisa"];
    $time_id = $_POST["time_id"];

    if($numero_camisa< 1 || $numero_camisa > 99){
        echo "<script>
        alert('Número da camisa deve estar entre 1 e 99.')
        window.location.href = 'cadastrar_jogador.php';
        </script>";
    }else{

    $sql = "INSERT INTO jogadores (nome, posicao, numero_camisa, time_id) VALUES";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "Jogador cadastrado com sucesso!";
    }else
        echo "Erro ao cadastrar!";
}
}
?>

<form method="POST">
    Nome: <input type="text" name="nome"><br>
    posicao: <input type="text" name="posicao"><br>
    numero_camisa: <input type="number" name="numero_camisa"><br>
    time_id: <input type="number" name="time_id"><br>
    <input type="submit" value="Cadastrar">
</form>