<?php 
    session_start();
    include_once('./includes/conexao.php');

    $sql = "SELECT * FROM veiculos";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Veiculos</title>
    <link rel="stylesheet" href="./assets/css/style3.css">
</head>
<body>
    <header>
        <nav>
            <ul>
            <div class="div1"><img src="./assets/img/logoo.png" alt="logo" class="img"> </div>
            <li><a href="dashboard.php"> Dashbord </a></li>
            <li><a href="usuario.php"> Usuário </a></li>
            <li><a href="checklist.php"> Checklist</a></li>
            <li><a href="veiculo.php"> Veículo </a></li>
            <div class="div1"><img src="./assets/img/logo_novo.png" alt="logo" class="img"> </div>
            
            </a>
        </ul>
        </nav>

    </header>
    <main>
        <h1>VEÍCULOS</h1>
        <h3>VEJA OS VEÍCULOS CADASTRADOS EM NOSSO SISTEMA</h3>
        
    <div class="container1">
    <div class="card">
      <img src="./assets/img/perfil.png" alt="Ícone">
      <p>Veiculos cadastrados</p>
      <span>5</span>
    </div>
  </div>

  <h2 id="lista">Lista de Veículos Cadastrados</h2>

  <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Placa</th>
            <th>Tipo</th>
            <th>Modelo</th>
            <th>Ano</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['placa']."</td>
                        <td>".$row['tipo']."</td>
                        <td>".$row['modelo']."</td>
                        <td>".$row['ano']."</td>
                        <td>
                            <a href='./actions/editar_usuario.php?tipo=veiculo&id=".$row['id']."' class='btn-editar'>Editar</a>
                            <a href='./actions/excluir_usuario.php?tipo=veiculo&id=".$row['id']."' class='btn-excluir' onclick=\"return confirm('Deseja realmente excluir este veículo?');\">Excluir</a>

                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>Nenhum veículo cadastrado.</td></tr>";
        }
        ?>
    </tbody>
</table>

  <h2 id="cadastro">CADASTRO DE VEICULOS</h2>
  <form action="./actions/salvarVeiculo.php" method="POST" >
    <input type="hidden" name="acao" value="cadastrar">
    <input type="text" placeholder="Digite sua placa" name="placa" id="placa" required>
    <input type="text" name="tipo" id="tipo" placeholder="Digite o seu tipo" required>
    <input type="text" name="modelo" id="modelo" placeholder="Digite o modelo" required>
    <input type="number" name="ano" id="ano" placeholder="Digite o ano" required>
    <input type="submit" name="submit" id="submit" value="Cadastrar">
  </form>

    </main>
</body>
</html>