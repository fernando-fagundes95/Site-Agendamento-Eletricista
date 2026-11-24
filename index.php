<?php
include_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css?v=10">
    <title>Eletricista Profissional - Serviços e Manutenção</title>
</head>

<body>

    <!-- TOPO / BANNER PRINCIPAL -->
    <header class="topo-site">
        <div class="overlay">
            <div class="container">
                <span class="etiqueta">⚡ ATENDIMENTO RÁPIDO E SEGURO</span>
                <h1>Não perca <span class="destaque">tempo</span> e nem <span class="destaque">dinheiro</span>,<br> contrate quem entende do assunto!</h1>
                <p>Serviços elétricos residenciais e comerciais com excelência, garantia e preço justo.</p>
                <a href="#agendamento" class="botao">Fazer orçamento agora</a>
            </div>
        </div>
    </header>

    <!-- SEÇÃO 1: ALERTA DE SEGURANÇA -->
    <section class="secao-1">
        <div class="container">
            <div class="caixa-alerta">
                <h2>Você sabia que sua família corre sérios riscos com uma instalação antiga ou mal feita?</h2>
                <p>Mais do que garantir o fornecimento de energia, um eletricista qualificado protege o seu patrimônio e a vida da sua família contra curtos-circuitos, sobrecargas e incêndios. Não arrisque com improvisos.</p>
            </div>
        </div>
    </section>

    <!-- SEÇÃO 2: FORMULÁRIO DE AGENDAMENTO -->
    <section id="agendamento" class="secao-agendamento">
        <div class="container">
            <div class="caixa-formulario">
                <form id="form-agendamento" action="salvar_agendamento.php" method="POST">
                    <h2>Agendar Eletricista ⚡</h2>
                    <p class="subtitulo-form">Preencha os dados abaixo para solicitar sua visita ou orçamento.</p>

                    <div class="campo">
                        <label for="nome">Nome Completo:</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>


                    </div>

                    <div class="linha-dupla">
                        <div class="campo">
                            <label for="telefone">WhatsApp / Telefone:</label>
                            <input type="text" id="telefone" name="telefone" placeholder="(43) 99999-9999" required>
                        </div>

                        <div class="campo">

                            <label for="data_servico">Data Preferencial:</label>
                            <input type="date" id="data_servico" name="data_servico" min="<?php echo date('Y-m-d'); ?>" required>


                        </div>
                    </div>

                    <div class="campo">
                        <label for="horario">Melhor Horário:</label>
                        <input type="time" id="horario" name="horario" required>
                    </div>

                    <div class="campo">
                        <label for="descricao">Descrição do Problema:</label>
                        <textarea id="descricao" name="descricao" placeholder="Ex: Troca de disjuntor, chuveiro queimado, instalação de tomadas..." required></textarea>
                    </div>

                    <button type="submit" class="btn-confirmar">Confirmar Agendamento</button>
                </form>
            </div>
        </div>
    </section>

    <!-- SEÇÃO 3: FRASE DE IMPACTO -->
    <section class="secao-3">
        <div class="container">
            <h2><span class="destaque-azul">O foco é</span> solucionar o seu problema.</h2>
            <p>Diagnóstico preciso, ferramentas adequadas e serviço limpo.</p>
        </div>
    </section>

    <!-- SEÇÃO 5: MAPA DE LOCALIZAÇÃO -->
    <section class="secao-5">
        <div class="container">
            <h2>Minha Localização</h2>
            <p class="subtitulo-mapa">Atendimento em Londrina e região</p>
            <div class="moldura-mapa">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1571.0969804468523!2d-51.18006139369714!3d-23.26272349419116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1795474014090!5m2!1spt-BR!2sbr"
                    src="https://google.com"
                    width="100%"
                    height="400"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <!-- RODAPÉ -->
    <footer class="rodape">
        <p>© 2026 Serviços Elétricos Profissionais - Todos os direitos reservados.</p>
    </footer>

</body>

</html>