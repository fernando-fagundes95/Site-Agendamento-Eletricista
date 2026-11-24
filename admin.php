<?php
// Conecta ao banco de dados
include_once("conexao.php");

// Busca todos os agendamentos salvos, ordenados pela data mais próxima
$sql = "SELECT * FROM agendamentos ORDER BY data_servico ASC, hora_servico ASC";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Eletricista - Agendamentos</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; }
        .container { max-width: 1000px; margin: 40px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #2c3e50; color: white; }
        tr:hover { background-color: #f5f5f5; }
        .btn-excluir { background-color: #e74c3c; color: white; border: none; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 14px; font-weight: bold; }
        .btn-excluir:hover { background-color: #c0392b; }
    </style>
</head>
<body>

<div class="container">
    <h2>Painel Secreto de Agendamentos Recebidos ⚡</h2>
    <p style="text-align: center;">Gerenciamento de serviços solicitados pelos clientes</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>WhatsApp / Telefone</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Descrição do Problema</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while($linha = $resultado->fetch_assoc()) {
                    // Transforma a data do banco no formato brasileiro bonito (dia/mês/ano)
                    $data_formatada = date('d/m/Y', strtotime($linha['data_servico']));

                    echo "<tr>";
                    echo "<td>" . $linha['id'] . "</td>";
                    echo "<td>" . $linha['nome'] . "</td>";
                    echo "<td>" . $linha['telefone'] . "</td>";
                    echo "<td>" . $data_formatada . "</td>"; 
                    echo "<td>" . $linha['hora_servico'] . "</td>";
                    echo "<td>" . $linha['descricao'] . "</td>";
                    echo "<td><a href='excluir_agendamento.php?id=" . $linha['id'] . "' class='btn-excluir' onclick=\"return confirm('Tem certeza que deseja excluir?')\">Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center;'>Nenhum agendamento encontrado</td></tr>";
            }
            $conexao->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>