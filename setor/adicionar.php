<?php

if (!empty($_GET['setor'])) {
    require './../php/config.php';
    $setor = $_GET['setor'];

    // Verificar se o setor já existe no banco de dados
    $sql_check = "SELECT COUNT(*) as total FROM setores WHERE nome = :nome";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindValue(':nome', $setor);
    $stmt_check->execute();
    $result_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($result_check['total'] == 0) {
        // Se o setor não existe, insira-o no banco de dados
        $sql_insert = "INSERT INTO setores (nome) VALUES (:setor)";
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->bindValue(':setor', $setor);
        $stmt_insert->execute();
    }
}

header('Location: ./listar.php');
