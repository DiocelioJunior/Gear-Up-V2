<?php
session_start();

// Conexão com o banco de dados (substitua com suas próprias credenciais)
$servername = "localhost";
$username = "id21439774_diocelio";
$password = "Dio25069!";
$dbname = "id21439774_gear_db";
// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o usuário está logado e se o ID do usuário está na sessão
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id']; // Obtém o ID do usuário da sessão

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
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link CSS -->
    <link rel="stylesheet" href="./css/itens.css">
    <!-- Link Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <!-- Título da Página -->
    <title>Gear Up Ir | Registro e Monitoramento de Mochilas de Emergência</title>
    <!-- Meta Descrição -->
    <meta name="description"
        content="Registre suas mochilas de emergência e mantenha-se preparado para qualquer situação com Gear Up Ir. Monitoramento fácil e seguro.">
    <!-- Meta Palavras-Chave -->
    <meta name="keywords"
        content="Mochilas de Emergência, Registro de Mochilas, Monitoramento de Preparação, Kit de Sobrevivência, Preparação para Emergências, Equipamento de Segurança">
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
</section>

<section class="sch_itens">
        <div class="txt_itens">
            <h1>Lista de Itens</h1>
        </div>
        <div class="filter_itens">
        <form action="" method="GET" onsubmit="return checkSearch()">
            <input type="text" name="search" id="search" placeholder="Pesquisar por nome">
            <button type="submit" name="submitSearch"><span class="material-symbols-outlined">
                search
                </span></button>
        </form>
        <a href="?show_all=true"><button><span class="material-symbols-outlined">
            clear_all
            </span></button></a>
    </div>
    </section>

    <?php
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

        // Verifique se a solicitação para mostrar todos os itens foi feita
        $show_all = isset($_GET['show_all']) && $_GET['show_all'] == 'true';

                // Modificação para sempre mostrar todos os itens quando não houver 'show_all' definido na URL
                if (!$show_all && !isset($_GET['search'])) {
                    $show_all = true;
                }

        // Construa a consulta SQL com base na solicitação
        if ($show_all) {
            $sql = "SELECT id, nome_item, data_validade, status FROM itens WHERE usuario_id = ?";
            $search_param = "%"; // Não há necessidade de filtro se mostrar todos os itens
        } else {
            $sql = "SELECT id, nome_item, data_validade, status FROM itens WHERE usuario_id = ?";
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            if (!empty($search)) {
                $sql .= " AND nome_item LIKE ?";
                $search_param = "%" . $search . "%";
            } else {
                $search_param = "%";
            }
        }

        $stmt = $conn->prepare($sql);

        if ($show_all) {
            $stmt->bind_param("i", $usuario_id);
        } else {
            $stmt->bind_param("is", $usuario_id, $search_param);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='itens-container'>"; // Abre a div para os itens
            while ($row = $result->fetch_assoc()) {
                echo "<div class='container_item'>";
                echo "<div class='item'>";
                echo "<div class='status'>";

                // Calcula os dias até a data de validade
                $days_until_validity = days_until($row["data_validade"]);

                echo "<div class='status_item";

                // Verifica se a validade está próxima (menos de 8 dias) e define a cor para vermelho
                if ($days_until_validity < 3) {
                    echo " proxima-validade"; // Adicione a classe CSS para tornar a cor vermelha
                }

                echo "'>";

                echo "</div>";
                echo "</div>";
                echo "<p>" . $row["nome_item"] . "</p>";
                echo "<p>" . $row["status"] . "</p>";
                // Formata a data no formato DD-MM-YY
                $data_validade_formatada = date("d-m-y", strtotime($row["data_validade"]));
                echo "<p>" . $data_validade_formatada . "</p>";

                // Botão para excluir item
                echo "<form action='excluir_item.php' method='post'>";
                echo "<input type='hidden' name='item_id' value='" . $row["id"] . "'>";
                echo "<button type='submit' value='Excluir'><span class='material-symbols-outlined'>delete</span></button>";
                echo "</form>";

                echo "</div>";
                echo "</div>";
            }
            echo "</div>"; // Fecha a div dos itens
        } else {
            echo "<p>Nenhum item encontrado.</p>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<p>Você não está logado.</p>";
    }
    ?>


    <div class="add-item-container" id="add-item-container">
        <i class="fas fa-times" id="close-button"></i>
        <h3>Adicionar Novo Item</h3>
        <form action="adicionar_item.php" method="post">

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

    <script>
            function checkSearch() {
            const searchInput = document.getElementById('search').value;
            if (!searchInput.trim()) {
                alert('Por favor, insira um termo de busca.');
                return false;
            }
            return true;
        }

        document.addEventListener("DOMContentLoaded", function () {
            const addButton = document.getElementById("add-item-button");
            const closeButton = document.getElementById("close-button");
            const addItemContainer = document.getElementById("add-item-container");

            addButton.addEventListener("click", function () {
                addItemContainer.style.display = "block";
            });

            closeButton.addEventListener("click", function () {
                addItemContainer.style.display = "none";
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const itensContainer = document.getElementById("itens-container");

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "const item = document.createElement('div');";
                    echo "item.classList.add('container_item');";
                    echo "item.innerHTML = '<div class=\"item\"><div class=\"status\">';";

                    $days_until_validity = days_until($row["data_validade"]);

                    echo "item.innerHTML += '<div class=\"status_item";
                    if ($days_until_validity < 8) {
                        echo " proxima-validade";
                    }
                    echo "\"></div>';";

                    echo "item.innerHTML += '</div><p>" . $row["nome_item"] . "</p><p>" . $row["status"] . "</p><p>" . $row["data_validade"] . "</p>';";
                    echo "itensContainer.appendChild(item);";
                }
            }
            ?>
        });

    </script>
</body>

</html>