<?php
include_once('../includes/conexao.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM usuario WHERE idUsuario = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()) {
        echo "<script>alert('Usuário excluído com sucesso');</script>";
    } else {
        echo "<script>alert('Erro ao excluir usuário');</script>";
    }
}

header("Location: ../usuarios.php");
exit;
?>
