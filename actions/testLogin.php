<?php
session_start();
include_once('../includes/conexao.php');

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Prepara a query para evitar SQL Injection
    $stmt = $conn->prepare("SELECT id, nome, email, senha FROM Usuario WHERE email = ?");
    if (!$stmt) {
        $_SESSION['msg'] = "<font color=red>Erro no banco de dados!</font>";
        header('Location: ../telaLogin.php');
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['msg'] = "<font color=red>Nenhum usuário encontrado com esse e-mail!</font>";
        header('Location: ../index.php');
        exit;
    }

    $user = $result->fetch_assoc();

    if (password_verify($senha, $user['senha'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['email'] = $user['email'];

        header('Location: ../dashboard.php');
        exit;
    } else {
        $_SESSION['msg'] = "<font color=red>Email ou senha incorretos!</font>";
        header('Location: ../index.php');
        exit;
    }

} else {
    $_SESSION['msg'] = "<font color=red>Preencha todos os campos!</font>";
    header('Location: ../index.php');
    exit;
}
?>
