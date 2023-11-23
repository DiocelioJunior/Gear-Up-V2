# Gear Up

O projeto Gear Up é um aplicativo em JavaScript projetado para ajudar os usuários a monitorar e gerenciar os itens em sua mochila de emergência.

<p align="center">
<img src="http://img.shields.io/static/v1?label=Version&message=1.1.2&color=GREEN&style=for-the-badge"/>
</p>

## Funcionalidades
- Adição e remoção de itens na mochila de emergência.
- Visualização da lista de itens na mochila.
- Verificação da validade dos itens.
- Notificação interna de itens vencidos.
- Recursos educacionais sobre como se preparar para emergências.

## Instalação

1. Clone o repositório para o seu ambiente local:

    ```bash
    git clone https://github.com/DiocelioJunior/Gear-Up-V2
    ```

2. Navegue até o diretório do projeto:

    ```bash
    cd Gear-Up-V2
    ```

3. Configuração do Banco de Dados:

   - O projeto utiliza o MySQL como sistema de gerenciamento de banco de dados. Certifique-se de ter o MySQL instalado em seu ambiente.

   - Crie um banco de dados chamado `gear_db`.

   - Configure as credenciais de acesso no arquivo `Config.php`. Abra o arquivo e edite as seguintes linhas:

     ```php
     $servername = "localhost";
     $username = "seu_usuario";
     $password = "sua_senha";
     $dbname = "gear_db";
     ```

   - Execute o script SQL fornecido em `gear_db.sql` para criar as tabelas necessárias.

4. Abra o arquivo `index.html` no seu navegador web preferido.

Certifique-se de substituir `seu_usuario`, `sua_senha` e `nomedoseubanco` pelos detalhes apropriados para o seu ambiente de desenvolvimento. Isso deve orientar os desenvolvedores na configuração correta do banco de dados MySQL ao clonar e executar o projeto pela primeira vez.

# Changelog

Todas as alterações notáveis neste projeto serão documentadas neste arquivo.

## Próxima Versão
- 🚨 Notificação de itens vencidos (Email/Whatsapp)
- 📋 Cadastro de informações pessoais
- 🔍 Filtragem por tipo de itens
- 📦 Cadastro de itens não perecíveis
- 👥 Monitoramento de múltiplas mochilas em uma única conta

## Melhorias (Version 1.1.2)
- 📱 Adicionada tela de login com cadastro em banco de dados.
- 🛢 Implementado banco de dados para armazenar itens.
- 🎨 Aprimorada a interface para melhor usabilidade do web app.
- 🔔 Incluído suporte a notificações internas para itens vencidos.
- ℹ️ Adicionado recurso educacional para preparação em situações de emergência.

## Exemplos de Uso

### 1. Adicionando Itens à Mochila de Emergência

Para adicionar um novo item à sua mochila de emergência, siga estes passos:

1. Faça login na sua conta.
2. Vá para a seção "Minha Mochila" (📋).
3. Clique no botão "Adicionar Item" (➕).
4. Preencha as informações necessárias, como nome do item, data de validade, etc.
5. Confirme a adição do item.

### 2. Visualizando a Lista de Itens na Mochila

Para visualizar todos os itens em sua mochila de emergência:

1. Acesse a seção "Minha Mochila" (📋).
2. Observe a lista completa de itens com informações como nome, data de validade e status.

### 3. Recebendo Notificações de Itens Vencidos

O aplicativo enviará automaticamente notificações internas para alertar sobre itens vencidos. Para garantir que você receba essas notificações:

1. Certifique-se de que as configurações de notificação do aplicativo estão ativadas.
2. Mantenha suas informações de contato atualizadas para garantir a entrega das notificações.

### 4. Explorando Recursos Educacionais

O Gear Up oferece recursos educacionais sobre como se preparar para emergências. Para acessar esses recursos:

1. Navegue até a seção "Educação para Emergências" (ℹ️).
2. Leia artigos informativos, assista a vídeos ou participe de cursos relevantes.

### 5. Melhorando a Interface para uma Melhor Usabilidade

A versão 1.1.2 do aplicativo incluiu melhorias significativas na interface do usuário para proporcionar uma experiência mais fluida. Agora, os usuários podem desfrutar de uma navegação mais fácil e intuitiva em todas as seções do aplicativo.

Esses exemplos fornecem orientações práticas sobre como os usuários podem interagir com o Gear Up para gerenciar efetivamente sua mochila de emergência e se preparar para situações críticas.
## Contribuindo

Contribuições são sempre bem-vindas!

Veja `CONTRIBUTING.md` para saber como começar.

Por favor, siga o `código de conduta` desse projeto.


## Autores

- [@Diocelio](https://github.com/DiocelioJunior)


