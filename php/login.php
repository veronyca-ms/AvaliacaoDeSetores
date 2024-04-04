<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RH - Entrar</title>
    <link rel="icon" href="./../imagens/icone.png">
    <link href="./../CSS/StyleLogin.css" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>


  <div class="bg"></div>
  <div class="bg bg2"></div>
  <div class="bg bg3"></div>

  
    <div class="container">
        <header>
            <img src='../imagens/logo_rh_ta_on.png' alt="rh">
        </header>

        <div class="form-container">
            <form id="loginForm" action="realizar_login.php" method="post">
                <h1 style="text-align: center; font-size: 30px;">Login</h1>

                
<!--TESTE DE MODELO DIFERENTE DE INPUT--><br>
              <div class="input-container">
  <input type="text" id="input" required="" name="usuario">
  <label for="input" class="label"><i class="fa-solid fa-user"></i> Usuário</label>
  <div class="underline"></div>
</div>

              <div class="input-container">
  <input type="password" id="input" required="" name="senha">
  <label for="input" class="label"><i class="fa-solid fa-lock"></i> Senha</label>
  <div class="underline"></div>
              </div>


              

                <br><button type="submit" class="button"><b>Entrar</b></button><br>
                
            </form>
        </div>
    </div>
</body>
</html>
