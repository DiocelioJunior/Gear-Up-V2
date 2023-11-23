<?php
// Conexão com o banco de dados (substitua com suas próprias credenciais)
$servername = "localhost";
$username = "id21439774_diocelio";
$password = "Dio25069!";
$dbname = "id21439774_gear_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$telefone_pessoal = $_POST['telefone_pessoal'];
$numero_emergencia_1 = $_POST['numero_emergencia_1'];
$numero_emergencia_2 = $_POST['numero_emergencia_2'];
$endereco_casa = $_POST['endereco_casa'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];

$sql = "INSERT INTO usuarios (telefone_pessoal, numero_emergencia_1, numero_emergencia_2, endereco_casa, bairro, cidade) VALUES ('$telefone_pessoal', '$numero_emergencia_1', '$numero_emergencia_2', '$endereco_casa', '$bairro', '$cidade')";

if ($conn->query($sql) === TRUE) {
    echo "Novo registro criado com sucesso";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
