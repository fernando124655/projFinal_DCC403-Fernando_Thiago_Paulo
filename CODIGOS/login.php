<?php
require_once("bootstrap.php");

if ($_POST) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consultar o banco de dados para verificar se as credenciais estão corretas
    $query = "SELECT * FROM docker  WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $senhaArmazenada = $row['senha'];

        // Verificar se a senha fornecida corresponde à senha armazenada no banco de dados
        if (hash('sha256', $senha) === $senhaArmazenada) {
            // Login bem-sucedido
            // Redirecionar o usuário para a página desejada após o login
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>window.alert('Senha incorreta!');</script>";
        }
    } else {
        echo "<script>window.alert('Usuário não encontrado!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
            color: #333;
        }

        .login-form label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        .login-form input[type="email"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .login-form button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-form button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="login-form">
            <h2>Login</h2>
            <form action="" method="post">
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="E-mail" required><br>
                <label for="senha">Senha</label>
                <input type="password" name="senha" placeholder="Senha" required><br>
                <button type="submit">Entrar</button>
</form>
</body>
</html>
