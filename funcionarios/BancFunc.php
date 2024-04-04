<?php

if (!empty($_GET['funcionario'])) {
    require './../php/config.php';
 
    $funcionario = $_GET['funcionario'];
    $senha = $_GET['senha'];
    $setor_ID = $_GET['setor_ID'];

    $sql = "SELECT * FROM usuarios WHERE nome = :nome";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(':nome', $funcionario);
    $sql->execute();
    
    $dados = $sql->fetch(PDO::FETCH_ASSOC);
    if (empty($dados)) {
        $sql = "INSERT INTO usuarios (nome, senha, setor_ID) VALUES (:funcionario, :senha, :setor_ID)";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':funcionario', $funcionario);
        $sql->bindValue(':senha', $senha);
        $sql->bindValue(':setor_ID', $setor_ID);
        $sql->execute();
        header('Location: ./func.php?status=1');
        exit();
    }
}

header('Location: ./func.php?status=2');
exit();