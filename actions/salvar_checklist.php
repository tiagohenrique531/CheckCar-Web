<?php
include_once("../includes/conexao.php");

if (isset($_POST["acao"]) && $_POST["acao"] === "cadastrar") {
    $pergunta  = $_POST["pergunta"];
    $tipo_veiculo    = $_POST["tipo_veiculo"];
    $tipo_resposta  = $_POST["tipo_resposta"];

    $stmt = $conn->prepare("INSERT INTO pergunta_checklist (texto, tipo_veiculo, tipo_resposta)
                            VALUES (?, ?, ?)");
    
    $stmt->bind_param("sss", $pergunta, $tipo_veiculo, $tipo_resposta);

    if ($stmt->execute()) {
        echo "<script>alert('Checklist cadastrado com sucesso!');</script>";
        echo "<script>location.href='../checklist.php';</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar o checklist.');</script>";
        echo "<script>location.href='../checklist.php';</script>";
        exit;
    }
}

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
