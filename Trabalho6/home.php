<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="index.php" method="post">
      <input type="submit" value="sair" name="sair">
      </form>
    
    <?php
    require_once "UsuarioEntidade.php";
    session_start();
    $usuario = $_SESSION['usuario'];
    echo "Olá " .$usuario->getNome();
    
    if(isset($_POST['sair'])){ 
        session_destroy();
        header('Location: index.php');
        exit();
    }
    ?>
          
</body>
</html>