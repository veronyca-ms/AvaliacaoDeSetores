<?php
session_start();
require "../php/config.php";

if (!isset($_SESSION['usuario'])){
    header("Location: ../php/login.php");
    exit();
}

if ($_SESSION['usuario']['nome'] == "admin") {
    header("Location: ../php/gestao.php");
    exit();
}

$usuarioID = $_SESSION['usuario']['id']; // Defina $usuarioID com o ID do usuário atual

// Consultar as perguntas do usuário
$sql = "SELECT p.* FROM perguntas p 
        INNER JOIN setores s ON p.setor_ID = s.id 
        INNER JOIN usuarios u ON s.id = u.setor_ID 
        WHERE u.id = :usuarioID";
$sql = $pdo->prepare($sql);
$sql->bindValue(':usuarioID', $usuarioID, PDO::PARAM_INT);
$sql->execute();
$setores = $sql->fetchAll(PDO::FETCH_ASSOC);

// Verificar se houve resultados na consulta
if (!$setores) {
    echo "Não foram encontradas perguntas para este usuário.";
    exit();
}

    
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/StylePergunta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Responda - Sistema de Avaliações</title>
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
                <li><a href="../avaliacoes/avaliacoes2.php" class="headerbutton">Voltar <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <form action="./salvar_avaliacoes.php" method="POST">
            <table>
                <tr>
                    <th>Pergunta</th>
                    <th class="mt_ruim">Muito Ruim</th>
                    <th class="ruim">Ruim</th>
                    <th class="bom">Bom</th>
                    <th class="mt_bom">Muito Bom</th>
                </tr>
                <?php foreach ($setores as $setor): ?>
                    <tr>
                        <td class="pergunta"><b><?= $setor['questoes'] ?></b></td>
                        <td class="mt_ruim_r">
                            <input type="radio" name="resposta_<?= $setor['id'] ?>" value="1" id="resposta_muito_ruim_<?= $setor['id'] ?>" required>
                            <label for="resposta_muito_ruim_<?= $setor['id'] ?>"><i class="fas fa-angry" style="color: #CC0C0F;"></i></label>
                        </td>
                        <td class="ruim_r">
                            <input type="radio" name="resposta_<?= $setor['id'] ?>" value="2" id="resposta_ruim_<?= $setor['id'] ?>" required>
                            <label for="resposta_ruim_<?= $setor['id'] ?>"><i class="fas fa-frown" style="color: #ff2424;"></i></label>
                        </td>
                        <td class="bom_r">
                            <input type="radio" name="resposta_<?= $setor['id'] ?>" value="4" id="resposta_bom_<?= $setor['id'] ?>" required>
                            <label for="resposta_bom_<?= $setor['id'] ?>"><i class="fa-solid fa-face-smile" style="color: #74fe4d;"></i></label>
                        </td>
                        <td class="mt_bom_r">
                            <input type="radio" name="resposta_<?= $setor['id'] ?>" value="5" id="resposta_muito_bom_<?= $setor['id'] ?>" required>
                            <label for="resposta_muito_bom_<?= $setor['id'] ?>"><i class="fa-solid fa-face-grin-beam" style="color: #0BD62D;"></i></label>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table><br><br>

            <button class="button" type="submit">
                Enviar
                <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                    <path clip-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z" fill-rule="evenodd"></path>
                </svg>
            </button>
        </form>
    </div>
</body>
</html>