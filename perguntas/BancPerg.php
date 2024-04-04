<?php

if (!empty($_GET['pergunta'])) {
    require './../php/config.php';

    $pergunta = $_GET['pergunta'];
    $setor_ID = $_GET['setor_ID'];

    $sql = "SELECT * FROM perguntas WHERE questoes = :pergunta";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(':pergunta', $pergunta);
    $sql->execute();

    $dados = $sql->fetch(PDO::FETCH_ASSOC);
    if (empty($dados)) {
        $sql = "INSERT INTO perguntas (questoes, setor_ID) VALUES (:pergunta, :setor_ID)";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':pergunta', $pergunta);
        $sql->bindValue(':setor_ID', $setor_ID);
        $sql->execute();
        header('Location: ./cad_perg.php?status=1');
        exit();
    }
}

header('Location: ./cad_perg.php?status=2');
exit();