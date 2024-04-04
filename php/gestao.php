<?php 
session_start();

require "./config.php";

if (!isset($_SESSION['usuario'])){
		header("Location: ./login.php");
		exit();
}


if ($_SESSION['usuario']['nome'] != "admin") {
		header("Location: ./avaliacoes.php");
		exit();
}


$sql = "SELECT * FROM setores";
$sql = $pdo->prepare($sql);
$sql->execute();
$setores = $sql->fetchAll(PDO::FETCH_ASSOC);
?>


 <!DOCTYPE html>
 <html>
 <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/StyleGestao.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<title>Gestão - Sistema de Avaliações</title>
	<link rel="icon" href="../imagens/icone.png">
 </head>
<body>
	<header class="cabecalho">
		<div class="logo">
			<img src="../imagens/logo_rh_ta_on.png" alt="Logo_RH">
			<h1>Sistema de Avaliações</h1>
			</div>
		<nav>
			<ul>
				<li><a href="../perguntas/cad_perg.php" class="headerbutton"><i class="fa-solid fa-circle-question"></i> Add. Pergunta</a></li>
				<li><a href="../setor/listar.php" class="headerbutton"><i class="fa-solid fa-address-card"></i> Add. Setor</a></li>
				<li><a href="../funcionarios/func.php" class="headerbutton"><i class="fa-solid fa-user-plus"></i> Add. Funcionários </a></li>
				<li><a href="./../index.php" class="headerbutton">Sair <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
			</ul>
		</nav>
	</header>

	<div class="container">
		<?php foreach ($setores as $setor): ?>
			<div class="item">
				<p style="font-weight: bold"><?=$setor['nome']?></p>
				<a href="./resultados.php?id=<?=$setor['id']?>&setor=<?=$setor['nome']?>">Ver os resultados</a>
			</div>
		<?php endforeach?>
	</div>
  
</body>
</html>
