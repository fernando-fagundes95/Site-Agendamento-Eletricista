# ⚡ Sistema de Agendamento para Eletricista

Este é um projeto desenvolvido como parte dos meus estudos no curso de Análise e Desenvolvimento de Sistemas. O objetivo é criar uma solução prática e profissional para que eletricistas possam gerenciar os agendamentos de seus clientes de forma rápida, organizada e totalmente digital.

## 📝 Descrição do Projeto

O sistema resolve o problema de organização de horários enfrentado por profissionais autônomos. Ele oferece uma interface amigável para que os clientes realizem agendamentos de serviços elétricos. Além disso, conta com um painel interno integrado ao banco de dados para listar, visualizar e gerenciar todos os atendimentos marcados de forma centralizada.

## 🛠️ Tecnologias Utilizadas

Para o desenvolvimento deste software, utilizei as seguintes tecnologias:
*   **Front-end:** HTML5, CSS3 (organizado de forma externa para melhor estilização de layouts) e JavaScript.
*   **Back-end:** PHP (responsável pela lógica do sistema e comunicação de dados).
*   **Banco de Dados:** MySQL (armazenamento seguro de todas as informações dos agendamentos).

## 🚀 Como Testar o Projeto Localmente

Para rodar este projeto no seu computador, siga os passos abaixo:

### 1. Preparar o Ambiente (XAMPP)
1. Certifique-se de ter o **XAMPP** instalado na sua máquina.
2. Coloque a pasta completa deste projeto dentro do diretório `htdocs` do seu XAMPP (geralmente em `C:\xampp\htdocs\eletricista`).
3. Abra o **XAMPP Control Panel** e ative os módulos **Apache** e **MySQL** clicando em *Start*.

### 2. Configurar o Banco de Dados
1. Abra o seu navegador e acesse o endereço: `http://localhost/phpmyadmin/`.
2. No menu do lado esquerdo, clique em **Novo** para criar uma nova base de dados.
3. Dê o nome exato de `eletricista` para o banco de dados e clique em **Criar**.
4. Crie a tabela necessária para armazenar os registros utilizando a estrutura de campos de agendamento compartilhada nos arquivos de script.

### 3. Executar a Aplicação
1. Com os módulos ativos no XAMPP, abra o seu navegador.
2. Digite e acesse a URL local do projeto:
   `http://localhost/eletricista/index.php`
3. Agora você já pode interagir com o formulário e testar o envio dos dados!
