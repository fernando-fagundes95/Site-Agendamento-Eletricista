<?php
session_start();
if (!isset($_SESSION['logado_eletricista']) || $_SESSION['logado_eletricista'] !== true) {
    header("Location: admin.php");
    exit;
}

include_once("conexao.php");

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $sql = "DELETE FROM agendamentos WHERE id = $id";

    if ($conexao->query($sql) === TRUE) {
        echo "<script>
                alert('Agendamento concluido e removido com sucesso!');
                window.location.href = 'admin.php';
              </script>";
    } else {
        echo "Erro ao excluir: " . $conexao->error;
    }
}

$conexao->close();
?>
