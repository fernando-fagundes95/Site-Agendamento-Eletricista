<?php
session_start();

$USUARIO_CORRETO = "eletricista24h";
$SENHA_CORRETA = "123456789";

if (isset($_GET['sair'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

$erro_login = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'], $_POST['senha'])) {
    if ($_POST['usuario'] === $USUARIO_CORRETO && $_POST['senha'] === $SENHA_CORRETA) {
        $_SESSION['logado_eletricista'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $erro_login = "Usuário ou senha incorretos.";
    }
}

if (!isset($_SESSION['logado_eletricista']) || $_SESSION['logado_eletricista'] !== true) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Restrito - Painel do Eletricista</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 35px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.12); width: 100%; max-width: 380px; }
        .login-box h2 { text-align: center; color: #2c3e50; margin-top: 0; }
        .campo { margin-bottom: 16px; }
        .campo label { display: block; font-weight: bold; color: #333; margin-bottom: 6px; }
        .campo input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; box-sizing: border-box; }
        .btn-entrar { width: 100%; padding: 12px; background-color: #2c3e50; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; }
        .btn-entrar:hover { background-color: #1a252f; }
        .erro { background-color: #fdecea; color: #c0392b; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Acesso Restrito ⚡</h2>
        <?php if ($erro_login !== ""): ?><div class="erro"><?php echo $erro_login; ?></div><?php endif; ?>
        <form method="POST" action="admin.php">
            <div class="campo"><label>Usuário</label><input type="text" name="usuario" required autofocus></div>
            <div class="campo"><label>Senha</label><input type="password" name="senha" required></div>
            <button type="submit" class="btn-entrar">Entrar no Painel</button>
        </form>
    </div>
</body>
</html>
<?php
    exit;
}

include_once("conexao.php");

// Salvar bloqueio
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'bloquear') {
    $data_bloq = $conexao->real_escape_string($_POST['data_bloqueada']);
    $hora_bloq = $_POST['tipo_bloqueio'] === 'DIA_TODO' ? 'DIA_TODO' : $conexao->real_escape_string($_POST['hora_especifica']);
    $motivo    = $conexao->real_escape_string(trim($_POST['motivo']));

    $conexao->query("INSERT INTO bloqueios (data_bloqueada, hora_bloqueada, motivo) VALUES ('$data_bloq', '$hora_bloq', '$motivo')");
    header("Location: admin.php");
    exit;
}

// Remover bloqueio
if (isset($_GET['desbloquear'])) {
    $id_bloq = (int) $_GET['desbloquear'];
    $conexao->query("DELETE FROM bloqueios WHERE id = $id_bloq");
    header("Location: admin.php");
    exit;
}

$resultado = $conexao->query("SELECT * FROM agendamentos ORDER BY data_servico ASC, hora_servico ASC");
$bloqueios = $conexao->query("SELECT * FROM bloqueios ORDER BY data_bloqueada ASC, hora_bloqueada ASC");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Eletricista - Agendamentos</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto 30px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .topo-painel { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 10px; }
        .topo-painel h2 { color: #333; margin: 0; }
        .btn-sair { background-color: #7f8c8d; color: white; padding: 8px 14px; border-radius: 4px; text-decoration: none; font-size: 14px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #2c3e50; color: white; }
        tr:hover { background-color: #f5f5f5; }
        .btn-whats { background-color: #25d366; color: white; padding: 4px 8px; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: bold; margin-left: 6px; }
        .btn-excluir { background-color: #e74c3c; color: white; border: none; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 14px; font-weight: bold; }
        .form-bloqueio { display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-end; background: #f8f9fa; padding: 15px; border-radius: 6px; border: 1px solid #e1e4e8; }
        .form-bloqueio div { display: flex; flex-direction: column; gap: 4px; }
        .form-bloqueio label { font-size: 12px; font-weight: bold; }
        .form-bloqueio input, .form-bloqueio select { padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .btn-bloquear { background-color: #2c3e50; color: white; border: none; padding: 9px 16px; border-radius: 4px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>

<div class="container">
    <div class="topo-painel">
        <h2>Painel de Agendamentos Recebidos ⚡</h2>
        <a href="admin.php?sair=1" class="btn-sair">Sair</a>
    </div>

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
            if ($resultado && $resultado->num_rows > 0) {
                while($linha = $resultado->fetch_assoc()) {
                    $data_formatada = date('d/m/Y', strtotime($linha['data_servico']));
                    $tel_limpo = preg_replace('/\D/', '', $linha['telefone']);

                    echo "<tr>";
                    echo "<td>" . $linha['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($linha['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($linha['telefone']) . " <a href='https://wa.me" . $tel_limpo . "' target='_blank' class='btn-whats'>WhatsApp</a></td>";
                    echo "<td>" . $data_formatada . "</td>"; 
                    echo "<td>" . htmlspecialchars($linha['hora_servico']) . "</td>";
                    echo "<td>" . htmlspecialchars($linha['descricao']) . "</td>";
                    echo "<td><a href='excluir_agendamento.php?id=" . $linha['id'] . "' class='btn-excluir' onclick=\"return confirm('Tem certeza que deseja excluir?')\">Excluir</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center;'>Nenhum agendamento encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="container">
    <h3 style="margin-top:0; color:#2c3e50;">Bloquear Dias ou Horários 🔒</h3>
    <form method="POST" action="admin.php" class="form-bloqueio">
        <input type="hidden" name="acao" value="bloquear">
        <div>
            <label>Data:</label>
            <input type="date" name="data_bloqueada" min="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div>
            <label>Tipo:</label>
            <select name="tipo_bloqueio" onchange="document.getElementById('campoHora').style.display = this.value === 'HORA' ? 'flex' : 'none'">
                <option value="DIA_TODO">Dia Inteiro Fechado</option>
                <option value="HORA">Horário Específico</option>
            </select>
        </div>
        <div id="campoHora" style="display:none;">
            <label>Horário:</label>
            <input type="time" name="hora_especifica">
        </div>
        <div>
            <label>Motivo (opcional):</label>
            <input type="text" name="motivo" placeholder="Ex: Feriado, Folga, Serviço externo...">
        </div>
        <button type="submit" class="btn-bloquear">Bloquear</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Data Bloqueada</th>
                <th>Período</th>
                <th>Motivo</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($bloqueios && $bloqueios->num_rows > 0): ?>
                <?php while($b = $bloqueios->fetch_assoc()): ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($b['data_bloqueada'])); ?></td>
                    <td><?php echo $b['hora_bloqueada'] === 'DIA_TODO' ? '<strong>Dia Inteiro</strong>' : htmlspecialchars($b['hora_bloqueada']); ?></td>
                    <td><?php echo htmlspecialchars($b['motivo']); ?></td>
                    <td><a href="admin.php?desbloquear=<?php echo $b['id']; ?>" class="btn-excluir">Desbloquear</a></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center;">Nenhum bloqueio ativo.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
<?php $conexao->close(); ?>
