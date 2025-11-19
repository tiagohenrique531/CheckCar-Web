<?php 
include_once("../includes/conexao.php");


if (isset($_POST["acao"]) && $_POST["acao"] === "cadastrar") {
    
    $placa   = $_POST["placa"];
    $tipo    = $_POST["tipo"];
    $modelo  = $_POST["modelo"];
    $ano   = $_POST["ano"];
   


    $stmt = $conn->prepare("INSERT INTO veiculos (placa, tipo, modelo, ano)
                            VALUES (?, ?, ?, ?)");
    
    $stmt->bind_param("ssss", $placa, $tipo, $modelo, $ano);

    if ($stmt->execute()) {
        echo "<script>alert('Veículo cadastrado com sucesso!');</script>";
        echo "<script>location.href='../veiculo.php';</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar o veículo.');</script>";
        echo "<script>location.href='../veiculo.php';</script>";
        exit;
    }
}

?>
