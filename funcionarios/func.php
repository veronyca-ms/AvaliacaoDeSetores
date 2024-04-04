<?php 
session_start();

require './../php/config.php';
$sql = "SELECT * FROM setores";
$sql = $pdo->prepare($sql);
$sql->execute();
$setores = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM usuarios";
$sql = $pdo->prepare($sql);
$sql->execute();
$funcionarios = $sql->fetchAll(PDO::FETCH_ASSOC);

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])){
    header("Location: ../php/login.php");
    exit();
}

// Verifica se o usuário logado não é um admin
if ($_SESSION['usuario']['nome'] != "admin") {
    header("Location: ../php/avaliacoes.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/StyleCadPerg.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Adicionar Funcionário</title>
</head>
<body>

  <div class="bg"></div>
  <div class="bg bg2"></div>
  <div class="bg bg3"></div>

  <br><br><br><br><br><br><a href="../php/gestao.php" class="headerbutton">Voltar <i class="fa-solid fa-arrow-right-from-bracket"></i></a><br>
              
  
  <div class="container">
    <h1 class="title_cadastro">Adicionar funcionário</h1>
    <form method="get" action="./BancFunc.php">
        <input type="text" name="funcionario" placeholder="Digite um usuário..." required>
        <input type="password" name="senha" placeholder="Digite uma senha..." required>
        <select name="setor_ID">
          <option value="">Selecione o setor</option>
          <?php foreach ($setores as $setor): ?>
            <option value="<?=$setor['id']?>"><?=$setor['nome']?></option>
          <?php endforeach ?>
        </select>
        <input class="botao" type="submit" value="Adicionar">
    </form>
  </div><br>

  <div class="container">
    <h2>Lista de funcionários</h2>
    <table style="text-align: center;">
      <tr>
        <th>ID</th>
        <th></th>
        <th></th>
        <th></th>
        <th>Nome</th>
      </tr>
      <?php foreach ($funcionarios as $funcionario): ?>
      <tr>
        <td><?=$funcionario['id']?></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?=$funcionario['nome']?></td>
      </tr>
      <?php endforeach ?>
    </table>
  </div>
</body>
</html>
