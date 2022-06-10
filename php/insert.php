<?php
session_start();
     
if (!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}

require_once "connect.php";

$conn = @new mysqli($host,$db_user,$db_pass,$db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
     if(isset($_POST['wynikPOST'],$_POST['czasPOST'],$_POST['wygranaPOST'])){
        $player=$_SESSION['id_player'];
        $wynik = $_POST['wynikPOST'];
        $czas = $_POST['czasPOST'];
        $wygrana = $_POST['wygranaPOST'];

        
        
        if ($conn->query("INSERT INTO game_wyn  VALUES ('NULL','$player','$wynik', '$czas','$wygrana')")==true) {
          echo "New record created successfully";
        $_SESSION['zapisanowyn']='wynik zapisano poprawnie';
         header('Location: game.php');
        } else {
            echo "Error:  " . $sql . "<br>" . $conn->error;

        }
    }else{
        echo"brak zmiennych";
    }
  
  $conn->close();

?>