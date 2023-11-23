<?php
session_start();

if (isset($_SESSION["usuario_id"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Inclui o arquivo de configuração do banco de dados
        include 'config.php';

        $usuario_id = $_SESSION["usuario_id"];
        $nome_item = $_POST["nome_item"];
        $data_validade = $_POST["data_validade"];
        $status = $_POST["status"];

        // Consulta SQL para adicionar um novo item
        $sql = "INSERT INTO itens (usuario_id, nome_item, data_validade, status) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $usuario_id, $nome_item, $data_validade, $status);

        if ($stmt->execute()) {
            header("Location: lista_itens.php"); // Redirecionar para a lista de itens após adicionar o item
            exit();
        } else {
            echo "Erro ao adicionar o item: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "Você não está logado.";
}
?>

?>
