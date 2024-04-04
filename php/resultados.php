<?php
session_start();

$ID_setor = $_GET["id"] ?? null;
require "./config.php";


if (!isset($_SESSION['usuario'])){
		header("Location: ./login.php");
		exit();
}


if ($_SESSION['usuario']['nome'] != "admin") {
		header("Location: ./avaliacoes.php");
		exit();
}




if (!is_null($ID_setor)) {
    
  $sql = "SELECT p.questoes,
         SUM(CASE WHEN a.resposta = 1 OR a.resposta = 2 THEN 1 ELSE 0 END) AS ruins_count,
         SUM(CASE WHEN a.resposta = 4 OR a.resposta = 5 THEN 1 ELSE 0 END) AS boas_count,
         COUNT(*) AS total_count,
         LEAST(COALESCE((SUM(CASE WHEN a.resposta = 1 OR a.resposta = 2 THEN 1 ELSE 0 END) / COUNT(*)) * 100, 0), 100) AS percent_ruim,
         LEAST(COALESCE((SUM(CASE WHEN a.resposta = 4 OR a.resposta = 5 THEN 1 ELSE 0 END) / COUNT(*)) * 100, 0), 100) AS percent_bom
  FROM perguntas p 
  LEFT JOIN avaliacoes a ON p.ID = a.ID_pergunta
  WHERE p.setor_ID = :ID_setor
  GROUP BY p.ID
  ORDER BY percent_ruim DESC";




  





    $consulta = $pdo->prepare($sql);
    
    $consulta->bindValue(':ID_setor', $ID_setor, PDO::PARAM_INT);
    
    // Executa a consulta
    $consulta->execute();
    
    // Obtém todas as perguntas do setor como um array associativo
    $perguntas = $consulta->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: ./gestao.php");
    exit('ID do setor não especificado.');
}

$setor = $_GET["setor"];

?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/StyleGestao.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Resultados</title>
    <link rel="stylesheet" href="./../style.css">
</head>
<body>
<header class="cabecalho">
    <div class="logo">
        <img src="../imagens/logo_rh_ta_on.png" alt="Logo_RH">
        <h1>Sistema de Avaliações</h1>
    </div>
  <nav>
      <ul>
          <li><a href="./gestao.php" class="headerbutton">Voltar <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
      </ul>
  </nav>
</header>
<table>
    <tr>
      
        <th class="tabela_pergunta"><h2 style="font-weight: bold">Resultados de: <?php echo $setor?> <br><br><i class="fa-regular fa-circle-question"></i> Perguntas</h2></th>
        <th class="ruim"><i class="fa-regular fa-face-frown-open fa-2xl"></i></th>
        <th class="bom"><i class="fa-regular fa-face-smile fa-2xl"></i></th>
    </tr>
    <?php foreach ($perguntas as $pergunta) : ?>
    <tr>
        <td><?php echo $pergunta['questoes']; ?></td>
        <td class="ruim2"><b><?php echo round($pergunta['percent_ruim']); ?>%</b> </td>
        <td class="bom2"><b><?php echo round($pergunta['percent_bom']); ?>%</b> </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>