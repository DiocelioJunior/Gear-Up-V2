<?php
session_start();
?>

<!DOCTYPE html>
<html>

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

    <style>
        body{
            font-family: 'Lato', sans-serif;
        }
        /* Import Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap');
        /* Adicione estilos aqui conforme necessário para tornar as notificações responsivas */
        .notification-card {
            width:100%;
            max-width: 500px;
            background-color: #f9f9f9;
            border: none;
            margin: 10px;
            padding: 10px;
            border-radius:10px;
        }

        .notification-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top:100px;
            width:90%;
            max-width: 500px;
        }

        .expired_items{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .expired_items h1{
            width:100%;
            max-width: 500px;
            color:#a63838;
        }
    </style>
</head>

<body>
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
        
    <div class="expired_items">
    <h1>Itens Vencidos</h1>
    </div>
    <div class="notification-container">
    <?php
    // Coloque o código PHP que busca e exibe as notificações de itens vencidos aqui
    function days_until($date) {
        $now = time();
        $date = strtotime($date);
        if ($date === false) return false;
        $datediff = $date - $now;
        return floor($datediff / (60 * 60 * 24));
    }

    if (isset($_SESSION["usuario_id"])) {
// Conexão com o banco de dados (substitua com suas próprias credenciais)
$servername = "localhost";
$username = "id21439774_diocelio";
$password = "Dio25069!";
$dbname = "id21439774_gear_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifique a conexão
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        $usuario_id = $_SESSION["usuario_id"];

        // Consulta SQL para obter os itens vencidos do usuário
        $sql = "SELECT id, nome_item, data_validade, status FROM itens WHERE usuario_id = ? AND data_validade < CURDATE()";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Exibe os itens vencidos em notificações
            while ($row = $result->fetch_assoc()) {
                echo "<div class='notification-card'>";
                echo "<h3>{$row['nome_item']}</h3>";
                echo "<p>Vencido dia: {$row['data_validade']}</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhum item vencido encontrado.</p>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<p>Você não está logado.</p>";
    }
    ?>
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
</body>

</html>
