<?php
require_once("conf.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha']; // Alterado de $password para $senha

    $sql = mysqli_query($conexao, "SELECT email FROM users WHERE senha = '$senha' AND email = '$email'") or die("ERRO NO COMANDO SQL");

    $row = mysqli_num_rows($sql);

    if ($row > 0) {
        $message = "O utilizador já existe.";
        echo $message;
        header("Refresh:2; url=index.html");
        exit();
    } else {
        $insertSql = mysqli_query($conexao, "INSERT INTO users (email, senha, nome) VALUES ('$email', '$senha', '$nome')") or die("ERRO AO INSERIR REGISTRO");

        if ($insertSql) {
            echo "Dados inseridos com sucesso";
            header("Refresh:2; url=index.html");
        } else {
            echo "Erro ao criar registro: " . mysqli_error($conexao);
        }
    }
} else {
    $message = "Método inválido";
    echo $message;
    header("Refresh:2; url=index.html");
    exit();
}

mysqli_close($conexao);

?>
