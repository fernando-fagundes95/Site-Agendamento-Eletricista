<?php
// Inclui o seu arquivo de conexão que já testamos
include_once("conexao.php");

// Recebe os dados enviados pelo formulário
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$data_servico = $_POST['data_servico'];
$hora_servico = $_POST['horario'];
$descricao = $_POST['descricao'];

// Prepara o comando para inserir os dados no banco
$sql = "INSERT INTO agendamentos (nome, telefone, data_servico, hora_servico, descricao) 
        VALUES ('$nome', '$telefone', '$data_servico', '$hora_servico', '$descricao')";

// Executa o comando e verifica se deu certo
if ($conexao->query($sql) === TRUE) {
    echo "<script>
            alert('Agendamento realizado com sucesso!');
            window.location.href = 'index.php';
          </script>";
} else {
    echo "Erro ao agendar: " . $conexao->error;
}

// Fecha a conexão
$conexao->close();
?>