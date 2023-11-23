<?php
session_start();

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

// Processar o formulário de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Consulta SQL para verificar as credenciais do usuário
    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($senha, $row["senha"])) {
            // Credenciais corretas, criar uma sessão de login
            $_SESSION["usuario_id"] = $row["id"];
            $_SESSION["usuario_nome"] = $row["nome"];
            header("Location: home.php"); // Redirecionar para a lista de itens após o login
            exit();
        } else {
            echo "Senha incorreta";
        }
    } else {
        echo "E-mail não encontrado";
    }

    $stmt->close();
    $conn->close();
}
?>
