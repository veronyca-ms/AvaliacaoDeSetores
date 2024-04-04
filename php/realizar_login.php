<?php

session_start();
require "./config.php";


$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE nome = :usuario AND senha = :senha";
$pdo_statement = $pdo->prepare($sql);
$pdo_statement->bindParam(':usuario', $usuario);
$pdo_statement->bindParam(':senha', $senha);
$pdo_statement->execute();

$usuarioEncontrado = $pdo_statement->fetch(PDO::FETCH_ASSOC);

if ($usuarioEncontrado) {
    $_SESSION['usuario'] = $usuarioEncontrado;
    if ($_SESSION['usuario']['nome'] == "admin") {
        header("Location: ./gestao.php");
        exit();
    } else {
        header("Location: ./avaliacoes.php");
    }
    exit();
} else {
    header("Location: ./login.php");
    exit();
}
?>
