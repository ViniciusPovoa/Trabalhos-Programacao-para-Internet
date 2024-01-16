<!DOCTYPE html>
<html>
<head>
    <title>Aprendendo PHP</title>
</head>
<body>
    <form action="" method="POST">
        <label for="cpf"> Cpf: </label>
        <input type="text" id="cpf" name="cpf"/><br><br>
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario"/><br><br>
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha"/><br><br>
        <input type="submit" value="Criar"/>
    </form>

<?php
    session_start();
    if(isset($_POST["usuario"]) && isset($_POST["senha"])) {
        require_once "conexao.php";
        require_once "UsuarioEntidade.php";

        $usuario = $_POST["usuario"];
        $senha = md5($_POST["senha"]); // Use md5 para criptografar a senha

        $conn = new Conexao();

        $sql = "INSERT INTO usuarios (cpf, nome, senha) VALUES (?, ?, ?)";
        $stmt = $conn->conexao->prepare($sql);

        $stmt->bindParam(1, $_POST['cpf']);
        $stmt->bindParam(2, $usuario);
        $stmt->bindParam(3, $senha);
        $resultado = $stmt->execute();

        if($resultado) {
            echo "Registro bem-sucedido!";
           header("Location: index.php");
        } else {
            echo "Falha no registro.";
        }
    }
?>
</body>
</html>
