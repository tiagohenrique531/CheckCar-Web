<?php
include_once('../includes/conexao.php');

/*if(!isset($_GET['tipo']) || !isset($_GET['id'])) {
    header("Location: ../index.php");
    exit;
}*/
$tipo = $_GET['tipo'];   // usuario ou veiculo
$id   = $_GET['id'];

if ($tipo == "usuario") {
    if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM usuario WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()) {
        echo "<script>alert('Usuário excluído com sucesso');</script>";
    } else {
        echo "<script>alert('Erro ao excluir usuário');</script>";
    }
}

    header("Location: ../usuario.php");
    exit;
} else if ($tipo == "veiculo") {
    if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM veiculos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()) {
        echo "<script>alert('Veículo excluído com sucesso');</script>";
    } else {
        echo "<script>alert('Erro ao excluir veículo');</script>";
    }
}
} else {
    exit("Tipo inválido!");
}
?>
