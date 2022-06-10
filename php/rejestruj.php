<?php
session_start();
if ((!isset($_POST['login'])) || (!isset($_POST['nick'])) || (!isset($_POST['pass1'])))
{
    header('Location: rejestracja.php');
    exit();
}else{
    require_once "connect.php";
    $conn= @new mysqli($host,$db_user,$db_pass,$db_name);

    if($conn-> connect_errno!=0){
        echo "ERROR".$conn->connect_errno;
    }else{
        $login=mysqli_real_escape_string($conn, $_POST['login']);
        $nick=mysqli_real_escape_string($conn, $_POST['nick']);
        $pass= mysqli_real_escape_string($conn, $_POST['pass1']);
        $email=mysqli_real_escape_string($conn, $_POST['email']);

        $pass=md5($pass);
        if($rezultat = $conn->query("SELECT player_nick FROM players WHERE player_nick='$nick'")){
            if($rezultat->num_rows ==0){
                if ($conn->query("INSERT INTO players VALUES ('null','$login','$nick','$pass','$email')") == true) {
                    echo "New record created successfully";
                    $_SESSION['blad'] = '<span style="color:green">Zarejstrowano poprawnie!</span>';
                    header('Location: ../index.php');
                } else {
                    echo "Error:  <br>" . $conn->error;
                    $_SESSION['blad'] = '<span style="color:red">Błąd któreś dane są zawarte w tabeli!</span>';
                    header('Location: ../index.php');

                }
            }else{
                $_SESSION['blad'] = '<span style="color:red">Użytkownik o takim niku już istnieje</span>';
                header('Location: ../index.php');
            }
        }
        $conn->close();
    }
}
?>