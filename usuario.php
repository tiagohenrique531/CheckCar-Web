<?php 
    include_once('./actions/cep.php');
    $address = getAddress();

    session_start();
    include_once('./includes/conexao.php');
    
  $sql = "SELECT idUsuario, nome, cpf, email, tipo, cep, rua, bairro, cidade, estado FROM usuario";
  $result = $conn->query($sql);


  


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Usuário</title>
    <link rel="stylesheet" href="./assets/css/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   
    
</head>
<body>
    <header>
        <nav>
            <ul>
            <div class="div1"><img src="./assets/img/logoo.png" alt="logo" class="img"> </div>
            <li><a href="index.php"> Dashbord </a></li>
            <li><a href="usuario.php"> Usuário </a></li>
            <li><a href="checklist.html"> Checklist</a></li>
            <li><a href="veiculo.php"> Veículo </a></li>
            <div class="div1"><img src="./assets/img/logo_novo.png" alt="logo" class="img"> </div>
            
            </a>
        </ul>
        </nav>

    </header>
    <main>
        <h1>USUÁRIOS</h1>
        <h3>CADASTRE E EDITE PERMISSOES</h3>
        
    <div class="container">
    <div class="card">
      <img src="./assets/img/perfil.png" alt="Ícone">
      <p>Total de usuários</p>
      <span>5</span>
    </div>
    <div class="card">
      <img src="./assets/img/perfil.png" alt="Ícone">
      <p>Administradores</p>
      <span>6</span>
    </div>
  </div>

  <h2 id="lista">Lista de Usuários Cadastrados</h2>

  <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>CEP</th>
            <th>Rua</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['idUsuario']."</td>
                        <td>".$row['nome']."</td>
                        <td>".$row['cpf']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['tipo']."</td>
                        <td>".$row['cep']."</td>
                        <td>".$row['rua']."</td>
                        <td>".$row['bairro']."</td>
                        <td>".$row['cidade']."</td>
                        <td>".$row['estado']."</td>
                        <td>
                            <a href='./actions/editar_usuario.php?id=".$row['idUsuario']."' class='btn-editar'>Editar</a>
                            <a href='./actions/excluir_usuario.php?id=".$row['idUsuario']."' class='btn-excluir' onclick=\"return confirm('Deseja realmente excluir este usuário?');\"><i class='fa fa-trash'></i></a>

                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>Nenhum usuário cadastrado.</td></tr>";
        }
        ?>
    </tbody>
</table>

  <h2 id="cadastro">CADASTRO</h2>
    <form action="usuario.php" method="POST">
      
      <input type="text" placeholder="Digite o seu CEP" name="cep" value="<?php echo isset($address->cep) ? $address->cep : ''; ?>" required>

      <button type="submit"> Confirmar </button>
      <?php 
                if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
              }
            ?>
    </form>

    <form action="./actions/salvar.php" method="POST">
      <input type="hidden" name="acao" value="cadastrar">
      <input type="hidden" name="cep" value="<?php echo $address->cep ?>">
      <input type="text" placeholder="Digite o seu Nome" name="nome" required>
      <input type="text" placeholder="Digite o seu CPF" name="cpf" required>
      <input type="password" placeholder="Digite a sua Senha" name="senha" required>
      <label for="opcao">Escolha um Tipo:</label>
      <select id="tipo" name="tipo">
        <option value="vazio">...</option>
        <option value="admin">Admin</option>
        <option value="mecanica">Mecanica</option>
      </select>
      <input type="text" placeholder="Digite o seu Email" name="email" required>
      <input type="text" placeholder="Digite a sua Rua" name="rua" value="<?php echo $address->logradouro ?>" required>
      <input type="text" placeholder="Digite o seu Bairro" name="bairro" value="<?php echo $address->bairro ?>" required>
      <input type="text" placeholder="Digite a sua Cidade" name="cidade" value="<?php echo $address->localidade ?>" required>
      <input type="text" placeholder="Digite o seu Estado" name="estado" value="<?php echo $address->uf ?>" required>
      <input type="submit" name="submit" id="submit" value="Cadastrar">
    </form>


    </main>
</body>
</html>