<?php
    session_start();
?>
<!doctype html>
<html lang="pl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/logincss.css">
</head>

<body>
    <form class="box" action="php/zaloguj.php" method="post">

        <h1>Login</h1>
      
        <input type="text" placeholder="User Login" name="login">
        <input type="password"  placeholder="Password" name="haslo">
        <input type="submit"  value="Login">
        <a href="php/rejestracja.php">Zarejstruj się ;)</a>
      </form>
      <?php
        if(isset($_SESSION['blad']))    echo $_SESSION['blad'];
    ?>
</body>
</html>