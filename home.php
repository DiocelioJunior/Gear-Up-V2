<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado e se o ID do usuário está na sessão
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id']; // Obtém o ID do usuário da sessão

    // Conexão com o banco de dados (substitua com suas próprias credenciais)
    $servername = "localhost";
    $username = "id21439774_diocelio";
    $password = "Dio25069!";
    $dbname = "id21439774_gear_db";

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Consulta para verificar os itens vencidos para o usuário atual
    $sql = "SELECT * FROM itens WHERE usuario_id = $usuario_id AND data_validade < CURDATE()";
    $result = $conn->query($sql);

    // Verifica se há itens vencidos para o usuário atual
    if ($result->num_rows > 0) {
        echo '<style>
                #notification-icon {
                    background-color: #a63838;
                    color: white;
                    border-radius: 50%;
                    padding: 5px;
                }
            </style>'; // Adiciona estilo ao ícone de notificação
    }

    $conn->close();
} else {
    // Redirecionar o usuário para a página de login, se não estiver logado
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Define o conjunto de caracteres UTF-8 para suportar caracteres especiais -->
    <meta charset="UTF-8">

    <!-- Define a escala inicial e largura da visualização da página para dispositivos móveis -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link para o arquivo CSS externo 'itens.css' -->
    <link rel="stylesheet" href="./css/itens.css">

    <!-- Link para a biblioteca de ícones Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Título da página exibido na barra de título do navegador -->
    <title>Gear Up Ir | Registro e Monitoramento de Mochilas de Emergência</title>

    <!-- Meta descrição para motores de busca e redes sociais -->
    <meta name="description"
        content="Registre suas mochilas de emergência e mantenha-se preparado para qualquer situação com Gear Up Ir. Monitoramento fácil e seguro.">

    <!-- Meta palavras-chave para SEO -->
    <meta name="keywords"
        content="Mochilas de Emergência, Registro de Mochilas, Monitoramento de Preparação, Kit de Sobrevivência, Preparação para Emergências, Equipamento de Segurança">
    
        <!-- Ícone da página -->
    <link rel="icon" href="./assets/img/user.png">
    
    <!-- Ícone de compartilhamento do WhatsApp -->
    <meta property="og:image" content="./assets/img/user.png">

    <!-- Link para o arquivo JavaScript externo 'script.js' -->
    <script src="./js/script.js"></script>

</head>

<body>
    <!-- Seção para o usuário -->
    <section class="container">
        <nav class="navbar">
            <div class="user">
                <!-- Imagem do usuário -->
                <div class="user_img">
                    <img src="./assets/img/user.png" alt="user_img">
                </div>

                <div class="notification">
                    <a href="./itens_vencidos.php"><span class="material-symbols-outlined" id="notification-icon" onclick="showNotifications()">
                        notifications
                    </span></a>
                    <span class="material-symbols-outlined">
                        menu
                    </span>
                </div>
            </div>
        </nav>

        <!-- Seção do cartão de informações -->
        <section class="container_card">
            <div class="card_info">
                <!-- Título e descrição do cartão de informações -->
                <div class="info_txt">
                    <h1>Mantenha sua mochila de emergência sempre atualizada!</h1>
                    <p>Prepare-se para o Inesperado: Mantenha sua Mochila de Emergência Atualizada e Esteja Pronto para
                        Lidar com Qualquer Situação de Urgência!</p>
                    <!-- Botão para começar -->
                    <a href="./lista_itens.php"><button id="btn_info">Começe Aqui</button></a>
                </div>
                <!-- Imagem associada ao cartão de informações -->
                <div class="info_img">
                    <img src="./assets/img/Card_info.png">
                </div>
            </div>
        </section>

        <!-- Título e link para ver mais itens -->
        <div class="for_you_txt">
            <h1>Para você</h1>
            <a href="./infos.html">- Veja mais</a>
        </div>

        <!-- Contêiner de cartões -->
        <div class="card-container">
            <!-- Primeiro cartão -->
            <div class="card" id="card_1">
                <h1>Mochila de Emergência: O que você precisa para estar preparado?</h1>
                <p>Descubra as sugestões de itens cruciais<br> para montar sua mochila de emergência <br>
                    e estar pronto para o inesperado!</p>
                <!-- Botão para ver mais detalhes -->
                <a href="./bag_info.html"><button id="btn_info">Veja mais</button></a>
            </div>

            <!-- Segundo cartão -->
            <div class="card" id="card_2">
                <h1>Mantenha Seus Contatos Cruciais Sempre à Mão</h1>
                <p>Tenha seus contatos atualizados sempre<br> à mão com uma mochila de emergência, garantindo
                    comunicação eficaz em <br> momentos críticos</p>
                <!-- Botão para ver mais detalhes -->
                <a href="./contacts_info.html"><button id="btn_info">Veja mais</button></a>
            </div>
        </div>

        <!-- Contêiner para adicionar novos itens -->
        <div class="add-item-container" id="add-item-container">
            <!-- Ícone para fechar o contêiner -->
            <i class="fas fa-times" id="close-button" onclick="closeAddItens()"></i>
            <h3>Adicionar Novo Item</h3>
            <form action="adicionar_item.php" method="post">
                <!-- Campos de entrada para nome do item, data de validade, quantidade e botão para adicionar -->
                <input class="input_add" type="text" name="nome_item" required placeholder="Nome">
                <input class="input_add" type="date" name="data_validade" placeholder="Data de Validade">
                <input class="input_add" type="text" name="status" placeholder="Quantidade">
                <input id="btn_add" type="submit" value="Adicionar Item">
            </form>
        </div>

        <!-- Barra flutuante com ícones -->
        <div class="floating-bar">
            <!-- Ícone de "Home" com um link para a página "home.html" -->
            <a href="./home.php"><i class="fas fa-home"></i></a>
            <!-- Ícone de "Lista de Itens" com um link para a página "lista_itens.php" -->
            <a href="./lista_itens.php"><i class="fa-solid fa-list"></i></a>
            <!-- Ícone para mostrar o contêiner de adição de itens com uma função JavaScript associada "hideAddItens()" -->
            <i class="fas fa-plus" id="add-item-button" onclick="hideAddItens()"></i>
            <!-- Ícone de "Informações" com um link para a página "infos.html" -->
            <a href="./infos.html"><i class="fa-solid fa-info"></i></a>
            <!-- Ícone de "Usuário" (perfil do usuário) -->
            <a href="./user.html"><i class="fas fa-user"></i></a>
        </div>

    </section>

    <script>
        function showNotifications() {
            var notificationsContainer = document.getElementById('notifications-container');
            if (notificationsContainer.style.display === 'none') {
                notificationsContainer.style.display = 'block';
            } else {
                notificationsContainer.style.display = 'none';
            }
        }
    </script>
</body>

</html>