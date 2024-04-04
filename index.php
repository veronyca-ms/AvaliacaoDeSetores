<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./CSS/StyleIndex.css">
  <title>Página Inicial</title>
</head>

<body>
  <div class="container">
    <h1 class="title">Sistema de Avaliação de Setores</h1>
    <h3 class="subtitle">Entre com seu login para acessar as avaliações dos setores</h3>
    <div class="button-container">
      <button class="button" onclick="window.location.href='./php/login.php'">Login</button>
      
    </div>
  </div>
</body>

</html>
