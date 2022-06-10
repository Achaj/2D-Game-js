<?php
 if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
 {
     header('Location: index.php');
     exit();
 }
 session_start();
require_once "connect.php";
$polaczenie= @new mysqli($host,$db_user,$db_pass,$db_name);

if($polaczenie-> connect_errno!=0){
    echo "ERROR".$polaczenie->connect_errno;
}else{
    
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
    $login =mysqli_real_escape_string($polaczenie, $login);
    $haslo =mysqli_real_escape_string($polaczenie, $haslo);
    $haslo=md5($haslo);

    $sql="SELECT* FROM players WHERE player_logoin='$login' and player_pass='$haslo'";
    if ($rezultat = @$polaczenie->query($sql)){
            $ilu_userow = $rezultat->num_rows;
       echo $ilu_userow;
       echo $sql;
        if($ilu_userow > 0){
            $wiersz=$rezultat->fetch_assoc();
            session_start();
                $user = $wiersz['player_nick'];
                $_SESSION['id_player'] = $wiersz['id'];
                $_SESSION['login'] = $wiersz['player_logoin'];
                $_SESSION['nick'] = $wiersz['player_nick'];
                $_SESSION['email']=$wiersz['email'];
                $rezultat->free_result();
                $_SESSION['zalogowany'] = true;
                unset($_SESSION['blad']);
                //echo "why not work";
                header('Location: game.php');

        }else {
                 
            $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło </span>';
            header('Location: ../index.php');
             
        }
    }else{
        header('Location: ../index.php');
    }
    $polaczenie->close();
}
   
   // echo $login;
   // echo $haslo;


?>