<?php
session_start();

require './../php/config.php';

if (!isset($_SESSION['usuario'])){
  header("Location: ../php/login.php");
  exit();
}

if ($_SESSION['usuario']['nome'] == "admin") {
    header("Location: ../php/gestao.php");
    exit();
}

$usuarioID = $_SESSION['usuario']['id']; // ID do usuário logado

// Consulta SQL para obter os setores associados ao usuário
$sql = "SELECT s.* FROM setores s INNER JOIN usuarios u ON s.id = u.setor_ID WHERE u.id = :usuarioID";
$sql = $pdo->prepare($sql);
$sql->bindValue(':usuarioID', $usuarioID);
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
               <title>Funcionário - Sistema de Avaliações</title>
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
                           <li><a href="./../index.php" class="headerbutton">Sair <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                       </ul>
                   </nav>
               </header>
             <h1 style="text-align: center;">Bem vindo <span style="color: #0066cc;"><?php echo $_SESSION['usuario']['nome']; ?>! </span></h1>

               <?php foreach ($setores as $setor): ?>
                   <div class="setor">
                       <div class="avaliacoes">
                           <b><?=$setor['nome']?></b><br><br>
                           
  <button onclick='window.location.href="./perguntas.php"' class='btn'>Fazer avaliação</button>
                       </div>
                   </div>
               <?php endforeach?>

             <?php

             if (isset($_GET['status'])) {
                 // Atribua o valor da variável 'status' a $status
                 $status = $_GET['status'];

                 // Verifique se $status é "success"
                 if ($status == "success") {
                     echo "<h3 style='text-align: center; color: green;''>Avaliações feita com sucesso! <i class='fa-regular fa-circle-check'></i></h3>";
                 }

               
               if ($status == "jarespondida") {
                  echo "<h3 style='text-align: center; color: red;'><i class='fa-regular fa-circle-xmark'></i> Ops! parece que você já tentou fazer a avaliação antes.</h3>";
               }

               if ($status == "error") {
                  echo "<h3 style='text-align: center; color: red;'><i class='fa-solid fa-triangle-exclamation'></i> Ops! parece que você tentou mudar os valores, tente novamente.</h3>";
               } 
             }
             ?>
           </body>
           </html>
