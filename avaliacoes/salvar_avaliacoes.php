<?php
session_start();
require "./../php/config.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuarioID = $_SESSION['usuario']['id'];

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'resposta_') === 0) {
            $perguntaID = substr($key, strlen('resposta_'));

            // Verificar se já existe uma avaliação para esta pergunta e usuário
            $sql_check = "SELECT COUNT(*) FROM avaliacoes WHERE ID_usuario = :usuarioID AND ID_pergunta = :perguntaID";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->bindValue(':usuarioID', $usuarioID, PDO::PARAM_INT);
            $stmt_check->bindValue(':perguntaID', $perguntaID, PDO::PARAM_INT);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();

            if ($count > 0) {
                header("Location: ../avaliacoes/avaliacoes2.php?status=jarespondida");
                exit();
            }

            // Verificar se o valor da resposta é válido (1 ou 2)
            if ($value != 1 && $value != 2 && $value != 4 && $value != 5) {
                header("Location: ../avaliacoes/avaliacoes2.php?status=error");
                exit();
            }

            // Se não houver uma avaliação e a resposta for válida, insira no banco de dados
            $sql_insert = "INSERT INTO avaliacoes (ID_usuario, ID_pergunta, resposta) VALUES (:usuarioID, :perguntaID, :resposta)";
            $stmt_insert = $pdo->prepare($sql_insert);
            $stmt_insert->bindValue(':usuarioID', $usuarioID, PDO::PARAM_INT);
            $stmt_insert->bindValue(':perguntaID', $perguntaID, PDO::PARAM_INT);
            $stmt_insert->bindValue(':resposta', $value, PDO::PARAM_INT);
            $stmt_insert->execute();
        }
    }

    // Redirecionar após o salvamento
    header("Location: ../avaliacoes/avaliacoes2.php?status=success");
    exit();
} else {
    header("Location: ../avaliacoes/perguntas.php");
    exit();
}
?>
