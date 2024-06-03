<?php
require_once 'conf.php';

session_start(); // Inicia a sessão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['senha'];

    // Verificar as credenciais de login
    $sql = mysqli_query($conexao, "SELECT email FROM users WHERE senha = '$password' AND email = '$email'") or die("ERRO NO COMANDO SQL");
    $row = mysqli_num_rows($sql);

    if ($row == 0) {
        // Exibir pop-up de erro
        echo "<script>alert('Dados errados!! (Utilizador ou palavra passe)');</script>";
        header("Refresh:2; url=index.html");
        exit();
    } else {
        // Login bem-sucedido, define a variável de sessão
        $_SESSION['logado'] = true;
        $_SESSION['email'] = $email; // Opcional: armazena o email do usuário na sessão
        header("Location: index.html");
        exit;
    }
}

mysqli_close($conexao);
?>
