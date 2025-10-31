<?php
include_once('../includes/conexao.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
} else {
    header("Location: ../usuarios.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Usuário</title>
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   
    
</head>
<body>
    <header>
        <nav>
            <ul>
            <div class="div1"><img src="../assets/img/logoo.png" alt="logo" class="img"> </div>
            <li><a href=""> Dashbord </a></li>
            <li><a href=""> Usuário </a></li>
            <li><a href=""> Checlist</a></li>
            <li><a href=""> Veículo </a></li>
            <div class="div1"><img src="../assets/img/logo_novo.png" alt="logo" class="img"> </div>
            
            </a>
        </ul>
        </nav>

    </header>

    <h1>USUÁRIOS</h1>
    <h3>EDITAR USUÁRIOS</h3>

<form action="alterado.php" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="idUsuario" value="<?php echo $usuario['idUsuario']; ?>">

    <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required>
    <input type="text" name="cpf" value="<?php echo $usuario['cpf']; ?>" required>
    <input type="password" name="senha" placeholder="Digite nova senha (ou deixe em branco)">
    <select name="tipo">
        <option value="admin" <?php echo $usuario['tipo']=='admin'?'selected':''; ?>>Admin</option>
        <option value="mecanica" <?php echo $usuario['tipo']=='mecanica'?'selected':''; ?>>Mecânica</option>
    </select>
    <input type="text" name="email" placeholder="Digite o seu email" value="<?php echo $usuario['email']; ?>" required>
    <input type="text" name="cep" placeholder="Digite o seu cep" value="<?php echo $usuario['cep']; ?>" required>
    <input type="text" name="rua" placeholder="Digite a sua rua" value="<?php echo $usuario['rua']; ?>" required>
    <input type="text" name="bairro" placeholder="Digite o seu bairro" value="<?php echo $usuario['bairro']; ?>" required>
    <input type="text" name="cidade" placeholder="Digite a sua cidade" value="<?php echo $usuario['cidade']; ?>" required>
    <input type="text" name="estado" placeholder="Digite o seu estado" value="<?php echo $usuario['estado']; ?>" required>

    <input type="submit" value="Salvar Alterações">
</form>
</body>
</html>