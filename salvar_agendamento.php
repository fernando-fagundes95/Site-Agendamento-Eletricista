<?php
include_once("conexao.php");

$nome         = $conexao->real_escape_string(trim($_POST['nome']));
$telefone     = $conexao->real_escape_string(trim($_POST['telefone']));
$data_servico = $conexao->real_escape_string(trim($_POST['data_servico']));
$hora_servico = $conexao->real_escape_string(trim($_POST['horario']));
$descricao    = $conexao->real_escape_string(trim($_POST['descricao']));

// 1. Verifica se o dia inteiro ou o horário exato foi bloqueado no painel
$checkBloqueio = $conexao->query("SELECT id FROM bloqueios WHERE data_bloqueada = '$data_servico' AND (hora_bloqueada = 'DIA_TODO' OR hora_bloqueada = '$hora_servico')");
if ($checkBloqueio && $checkBloqueio->num_rows > 0) {
    echo "<script>
            alert('Desculpe, este dia ou horário não está disponível na agenda. Por favor, escolha outro!');
            window.location.href = 'index.php#agendamento';
          </script>";
    exit;
}

// 2. Verifica se já existe outro cliente agendado na mesma data e horário (margem de 59 min)
$checkOcupado = $conexao->query("SELECT id FROM agendamentos WHERE data_servico = '$data_servico' AND ABS(TIME_TO_SEC(TIMEDIFF(hora_servico, '$hora_servico'))) < 3600");
if ($checkOcupado && $checkOcupado->num_rows > 0) {
    echo "<script>
            alert('Ops! Já existe um atendimento agendado próximo a esse horário. Por favor, escolha outro horário!');
            window.location.href = 'index.php#agendamento';
          </script>";
    exit;
}

// 3. Salva o agendamento no banco
$sql = "INSERT INTO agendamentos (nome, telefone, data_servico, hora_servico, descricao) 
        VALUES ('$nome', '$telefone', '$data_servico', '$hora_servico', '$descricao')";

if ($conexao->query($sql) === TRUE) {
    echo "<script>
            alert('Agendamento realizado com sucesso!');
            window.location.href = 'index.php';
          </script>";
} else {
    echo "Erro ao agendar: " . $conexao->error;
}

$conexao->close();
?>
