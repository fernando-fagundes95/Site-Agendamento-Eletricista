<?php
include_once("conexao.php");

// Pega o ID que foi enviado pelo botão da tabela
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Comando para deletar o agendamento correto
    $sql = "DELETE FROM agendamentos WHERE id = $id";

    if ($conexao->query($sql) === TRUE) {
        echo "<script>
                alert('Agendamento concluído e removido com sucesso!');
                window.location.href = 'admin.php';
              </script>";
    } else {
        echo "Erro ao excluir: " . $conexao->error;
    }
}

$conexao->close();
?>