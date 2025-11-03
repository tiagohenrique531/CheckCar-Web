<?php 

    session_start();
    include_once('./includes/conexao.php');
    
    $sql = "SELECT * FROM perguntas";
    $result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tela ChecKlist</title>
    <link rel="stylesheet" href="./assets/css/style3.css">
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
        <h1>CHECKLIST</h1>
        <h3>CRIE SEU FORMULÁRIO DE INSPEÇÃO DE VEÍCULOS</h3>
        
    <div class="container">
    <div class="card">
      <img src="./assets/img/perfil.png" alt="Ícone">
      <p>Veículos com problema</p>
      <span>5</span>
    </div>
    <div class="card">
      <img src="./assets/img/perfil.png" alt="Ícone">
      <p>Falha no motor</p>
      <span>6</span>
    </div>
    <div class="card">
      <img src="./assets/img/perfil.png" alt="Ícone">
      <p>Problema no câmbio</p>
      <span>5</span>
    </div>
    <div class="card">
      <img src="./assets/img/perfil.png" alt="Ícone">
      <p>Embreagem desgastada</p>
      <span>5</span>
    </div>
    <div class="card">
      <img src="./assets/img/perfil.png" alt="Ícone">
      <p>Farol queimado</p>
      <span>5</span>
    </div>
  </div>
        <div class="container">
  
  <form action="./actions/salvar_checklist.php" method="POST">
  <input type="hidden" name="idChecklist" value="1"> <!-- exemplo -->

  <?php while($row = $result->fetch_assoc()) { ?>
  <table>
    <thead>
      <tr>
        <th>Pergunta nº<?php echo $row['id']; ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo htmlspecialchars($row['texto']); ?></td>
      </tr>
      <tr>
        <td>
          <input type="radio" name="resposta[<?php echo $row['id']; ?>]" value="OK"> OK
          <input type="radio" name="resposta[<?php echo $row['id']; ?>]" value="NOK"> NOK
          <input type="radio" name="resposta[<?php echo $row['id']; ?>]" value="NA"> N/A
          <br>
          <textarea name="observacao[<?php echo $row['id']; ?>]" rows="2" placeholder="Observações..."></textarea>
        </td>
      </tr>
    </tbody>
  </table>
  <?php } ?>

  <button type="submit">Salvar Checklist</button>
</form>

</div>
    </main>
</body>
</html>