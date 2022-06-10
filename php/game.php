<?php
    session_start();
     
    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }
     
?>
<!DOCTYPE html>
<html lang="Pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gra Internetowa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/mainSlideBarcss.css">
    <link  rel="stylesheet" href="../css/gameCSS.css">
 <!--   -->
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<div class="container">
    <div class="col-12 ">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainmenu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="game.php" class="nav-link">GRA</a></li>
                    <li class="nav-item"><a href="gameLevel2.php" class="nav-link">GRA 2</a></li>
                    <li class="nav-item"><a href="statystyka.php" class="nav-link">Statystyki</a></li>
                    <li class="nav-item"><a href="ranking.php" class="nav-link">Ranking</a></li>
                    <li class="nav-item"><a href="gracz.php" class="nav-link">O Graczu</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link">Wyloguj</a></li>
                </ul>

            </div>

        </nav>
    </div>
</div>
        <div class="col-2">
            <br>
            <form name="formGame" action="insert.php" method="post" onsubmit="return validateForm()" >
            <br><br><br>
                <h2>Wynik to:<input type="text" name="wynikPOST" id="wynik" readonly></h2>
                <h2>Czas to:<input type="text" name="czasPOST" id="czas" readonly></h2>
                <h2>Wygrana to:<input type="text" name="wygranaPOST" id="wygrana" readonly></h2>
                <?php
                  if (isset($_SESSION['zapisanowyn']))
                  {
                    echo $_SESSION['zapisanowyn'];
                  }
                ?>
                <h2> <input type="submit" value="Zapisz gre" ></h2>
            </form>
        <script>
        function validateForm() {
           var wyn = document.forms["formGame"]["wynik"].value;
           var  czas= document.forms["formGame"]["wynik"].value;
           var wygran = document.forms["formGame"]["wynik"].value;
              if (wyn == "" && czas=="" && wygran=="") {
                alert("Pola musza być uzupełnione");
                return false;
              }
        }
        </script>
        </div>
        <div class="col-10">
            <canvas  style="background: #9daa7e" id="canvas1"></canvas>
            <script src="../scripts/game.js"></script>
         </div>


</div>
</body>
</html>