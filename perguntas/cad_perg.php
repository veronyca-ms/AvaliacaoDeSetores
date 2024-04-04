<?php 
session_start();

require './../php/config.php';
$sql = "SELECT * FROM setores";
$sql = $pdo->prepare($sql);
$sql->execute();
$setores = $sql->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Adicionar as perguntas</title>
    <link rel="stylesheet" href="../CSS/StyleCadPerg.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    
    <a href="../php/gestao.php" class="headerbutton">Voltar <i class="fa-solid fa-arrow-right-from-bracket"></i></a><br>
                
    
    <div class="container">
        <h1 class="title_cadastro">Adicionar perguntas:</h1>
        <form method="get" action="./BancPerg.php">
            <div>
                <input type="text" name="pergunta" placeholder="Digite uma pergunta...">
            </div>
          <h4 class="title_setor">Escolha o Setor:</h4>
            <div>
              <select name="setor_ID">
                  <option value="">Selecione o setor</option>
                  <?php foreach ($setores as $setor): ?>
                  <option value="<?=$setor['id']?>"><?=$setor['nome']?></option>
                  <?php endforeach?>
              </select>
            </div>
            <div>
                <button type="submit" class="botao">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>