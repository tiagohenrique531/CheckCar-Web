<?php 
session_start();
include_once('./includes/conexao.php');

// Busca as perguntas do banco
$sql = "SELECT * FROM pergunta_checklist";
$result = $conn->query($sql);
$novoChecklistId = $_GET['idChecklist'] ?? null;

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist de Veículos</title>
    <link rel="stylesheet" href="./assets/css/style3.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <div class="div1"><img src="./assets/img/logoo.png" alt="logo" class="img"></div>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="usuario.php">Usuário</a></li>
                <li><a href="checklist.php">Checklist</a></li>
                <li><a href="veiculo.php">Veículo</a></li>
                <div class="div1"><img src="./assets/img/logo_novo.png" alt="logo" class="img"></div>
            </ul>
        </nav>
    </header>

    <main>
        <h1>CHECKLIST</h1>
        <?php if ($novoChecklistId): ?>
        <p><strong>Checklist atual:</strong> <?php echo $novoChecklistId; ?></p>
        <?php endif; ?>
        <h3>CRIE SEU FORMULÁRIO DE INSPEÇÃO DE VEÍCULOS</h3>

        <form action="./actions/salvar_checklist.php" method="POST">
      <input type="hidden" name="acao" value="cadastrar">
      <input type="text" name="pergunta" id="pergunta" placeholder="Digite a sua pergunta" required>
      <select id="tipo_veiculo" name="tipo_veiculo">
        <option value="vazio">...</option>
        <option value="carro">Carro</option>
        <option value="moto">Moto</option>
        <option value="caminhao">Caminhao</option>
      </select>
      <select id="tipo_resposta" name="tipo_resposta">
        <option value="vazio">...</option>
        <option value="selecao">Seleção</option>
        <option value="descritiva">Descritiva</option>
      </select>

      <input type="submit" name="submit" id="submit" value="Salvar">
    </form>
        
        <div class="container">
            <form action="./actions/salvar_checklist.php" method="POST">

                <!-- IDs ocultos -->
                <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['id'] ?? 1; ?>">
                <input type="hidden" name="idVeiculo" value="1">
                <input type="hidden" name="idChecklist" value="<?php echo $novoChecklistId ?? ''; ?>">



                <?php while ($row = $result->fetch_assoc()) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>Pergunta nº <?php echo $row['id']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($row['texto']); ?></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="resposta[<?php echo $row['id']; ?>]" value="OK" required> OK
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
        <hr>
<?php


$result = $conn->query("SELECT * FROM checklist ORDER BY idChecklist DESC");

echo "<h2>Checklists Criados</h2>";
echo "<table border='1'>
<tr><th>ID</th><th>Usuário</th><th>Veículo</th><th>Data</th><th>Ações</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['idChecklist']}</td>
        <td>{$row['idUsuario']}</td>
        <td>{$row['idVeiculo']}</td>
        <td>{$row['dataChecklist']}</td>
        <td><a href='checklist.php?idChecklist={$row['idChecklist']}'>Abrir</a></td>
    </tr>";
}

echo "</table>";
?>
    </main>
    <footer>
        <h1></h1>
    </footer>
</body>
</html>
