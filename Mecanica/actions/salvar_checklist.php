<?php
include_once("../includes/conexao.php");

// Dados enviados pelo formulário
$idUsuario   = $_POST['idUsuario'] ?? null;
$idVeiculo   = $_POST['idVeiculo'] ?? null;
$respostas   = $_POST['resposta'] ?? [];
$observacoes = $_POST['observacao'] ?? [];
$idChecklist = $_POST['idChecklist'];


if (empty($respostas)) {
    die("Nenhuma resposta enviada!");
}

if (empty($idUsuario) || empty($idVeiculo)) {
    die("Usuário ou veículo não informados!");
}

// Cria o checklist
$stmtChecklist = $conn->prepare("
    INSERT INTO Checklist (idUsuario, idVeiculo, dataChecklist)
    VALUES (?, ?, NOW())
");
$stmtChecklist->bind_param("ii", $idUsuario, $idVeiculo);
$stmtChecklist->execute();

$idChecklist = $conn->insert_id;

// Salva respostas
$stmt = $conn->prepare("
    INSERT INTO RespostaChecklist (idChecklist, idItem, resposta, observacao)
    VALUES (?, ?, ?, ?)
");

foreach ($respostas as $idPergunta => $resposta) {
    $obs = $observacoes[$idPergunta] ?? '';
    $stmt->bind_param("iiss", $idChecklist, $idPergunta, $resposta, $obs);
    $stmt->execute();
}

echo "<script>
    alert('Checklist salvo com sucesso! ID: {$idChecklist}');
    window.location='../checklist.php';
</script>";

?>
