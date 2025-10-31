<?php
include_once("../includes/conexao.php");

if (isset($_POST["acao"]) && $_POST["acao"] === "editar") {

    $id     = $_POST["idUsuario"];
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

    // Se a senha não for alterada, não atualiza ela
    if (!empty($senha)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuario SET nome=?, cpf=?, senha=?, tipo=?, email=?, cep=?, rua=?, bairro=?, cidade=?, estado=? WHERE idUsuario=?");
        $stmt->bind_param("ssssssssssi", $nome, $cpf, $senha_hash, $tipo, $email, $cep, $rua, $bairro, $cidade, $estado, $id);
    } else {
        $stmt = $conn->prepare("UPDATE usuario SET nome=?, cpf=?, tipo=?, email=?, cep=?, rua=?, bairro=?, cidade=?, estado=? WHERE idUsuario=?");
        $stmt->bind_param("sssssssssi", $nome, $cpf, $tipo, $email, $cep, $rua, $bairro, $cidade, $estado, $id);
    }

    if($stmt->execute()) {
        echo "<script>alert('Dados atualizados com sucesso!);</script>";
        echo "<script>location.href='../usuario.php';</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao atualizar os dados.');</script>";
        echo "<script>location.href='../usuario.php';</script>";
        exit;
    }
}
?>
