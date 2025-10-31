<?php 
include_once("../includes/conexao.php");


if (isset($_POST["acao"]) && $_POST["acao"] === "cadastrar") {
    
    $nome   = $_POST["nome"];
    $cpf    = $_POST["cpf"];
    $senha  = $_POST["senha"];
    $tipo   = $_POST["tipo"];
    $email  = $_POST["email"];
    $cep    = $_POST["cep"];
    $rua    = $_POST["rua"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];

   
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    

    
    $stmt = $conn->prepare("INSERT INTO usuario (nome, cpf, senha, tipo, email, cep, rua, bairro, cidade, estado)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssssssss", $nome, $cpf, $senha_hash, $tipo, $email, $cep, $rua, $bairro, $cidade, $estado);

    if ($stmt->execute()) {
        echo "<script>alert('Usuário cadastrado com sucesso!');</script>";
        echo "<script>location.href='../usuario.php';</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar o usuário.');</script>";
        echo "<script>location.href='../usuario.php';</script>";
        exit;
    }
}

?>
