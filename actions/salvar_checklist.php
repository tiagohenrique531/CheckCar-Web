<?php
include_once("../includes/conexao.php");

$id_veiculo = $_POST['idChecklist'] ?? null;
$respostas = $_POST['resposta'] ?? [];
$observacoes = $_POST['observacao'] ?? [];

if (empty($respostas)) {
    die("Nenhuma resposta enviada!");
}

/*$stmtChecklist = $conn->prepare("INSERT INTO Checklist (nome, data) VALUES (?, ?)");
$stmtChecklist->bind_param("ss", $nome, $data);
$stmtChecklist->execute();

// Pegar o ID gerado
$idChecklist = $conn->insert_id;*/

$stmt = $conn->prepare("INSERT INTO RespostaChecklist (idChecklist, id_pergunta, resposta, observacao)
                        VALUES (?, ?, ?, ?)");

foreach ($respostas as $id_pergunta => $resposta) {
    $obs = $observacoes[$id_pergunta] ?? '';
    $stmt->bind_param("iiss", $id_veiculo, $id_pergunta, $resposta, $obs);
    $stmt->execute();
}

echo "<script>alert('Checklist salvo com sucesso!'); window.location='checklist.php';</script>";
?>
