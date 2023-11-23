<?php
session_start();

if (isset($_SESSION["usuario_id"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $item_id = $_POST["item_id"]; // O ID do item a ser excluído

        // Consulta SQL para excluir um item
        $sql = "DELETE FROM itens WHERE id = ? AND usuario_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $item_id, $usuario_id);

        if ($stmt->execute()) {
            header("Location: lista_itens.php"); // Redirecionar para a lista de itens após excluir o item
            exit();
        } else {
            echo "Erro ao excluir o item: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "Você não está logado.";
}
?>

