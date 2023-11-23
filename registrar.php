<?php
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

// Processar o formulário de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); // Criptografe a senha

    // Inserir usuário na tabela usuarios
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        header("Location: index.html"); // Redirecionar para a página de login após o registro bem-sucedido
        exit();
    } else {
        echo "Erro ao registrar o usuário: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
