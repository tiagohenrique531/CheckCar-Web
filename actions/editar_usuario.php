<?php
include_once('../includes/conexao.php');

// Verifica se veio tipo e id
if(!isset($_GET['tipo']) || !isset($_GET['id'])) {
    header("Location: ../index.php");
    exit;
}

$tipo = $_GET['tipo'];   // usuario ou veiculo
$id   = $_GET['id'];

// Buscar do banco
if ($tipo == "usuario") {
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE id = ?");
} else if ($tipo == "veiculo") {
    $stmt = $conn->prepare("SELECT * FROM veiculos WHERE id = ?");
} else {
    exit("Tipo inválido!");
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$dados = $result->fetch_assoc();

if (!$dados) {
    exit("Registro não encontrado!");
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="../assets/css/style3.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <div class="div1"><img src="../assets/img/logoo.png" alt="logo" class="img"></div>
            <li><a href=""> Dashbord </a></li>
            <li><a href=""> Usuário </a></li>
            <li><a href=""> Checlist </a></li>
            <li><a href=""> Veículo </a></li>
            <div class="div1"><img src="../assets/img/logo_novo.png" alt="logo" class="img"></div>
        </ul>
    </nav>
</header>

<h1><?php echo strtoupper($tipo); ?></h1>
<h3>EDITAR <?php echo strtoupper($tipo); ?></h3>

<form action="alterado.php" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
    <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">

    <!--        FORMULÁRIO USUÁRIO -->
    <?php if ($tipo == "usuario"): ?>

        <input type="text" name="nome" value="<?php echo $dados['nome']; ?>" required>
        <input type="text" name="cpf" value="<?php echo $dados['cpf']; ?>" required>

        <input type="password" name="senha" placeholder="Nova senha (opcional)">

        <select name="tipo_usuario">
            <option value="admin"    <?php echo $dados['tipo']=='admin'?'selected':''; ?>>Admin</option>
            <option value="mecanica" <?php echo $dados['tipo']=='mecanica'?'selected':''; ?>>Mecânica</option>
        </select>

        <input type="text" name="email" value="<?php echo $dados['email']; ?>" required>
        <input type="text" name="cep" value="<?php echo $dados['cep']; ?>" required>
        <input type="text" name="rua" value="<?php echo $dados['rua']; ?>" required>
        <input type="text" name="bairro" value="<?php echo $dados['bairro']; ?>" required>
        <input type="text" name="cidade" value="<?php echo $dados['cidade']; ?>" required>
        <input type="text" name="estado" value="<?php echo $dados['estado']; ?>" required>

    <?php endif; ?>


        <!-- Formulario Veiculo -->
    <?php if ($tipo == "veiculo"): ?>
        <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
        <input type="text" name="placa"  value="<?php echo $dados['placa']; ?>" required>
        <input type="text" name="modelo" value="<?php echo $dados['modelo']; ?>" required>
        <input type="text" name="ano"    value="<?php echo $dados['ano']; ?>" required>
        <input type="text" name="tipo_veiculo"  value="<?php echo $dados['tipo']; ?>" required>

    <?php endif; ?>


    <input type="submit" value="Salvar Alterações">
</form>

</body>
</html>
