<?php
    session_start();
     
    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/mainSlideBarcss.css">
    <link rel="stylesheet"href="../css/user.css">

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
<div class="col-12">
    <br><br><br>
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> <img src="assetsgame/user.png" class="img-radius" alt="User-Profile-Image"> </div>
                                    <?php echo"<h6 class='f-w-600'>"."Witaj :".$_SESSION['nick']."</h6>"?>
                                    <p>Zapalony gracz</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">ID</p>
                                            <?php echo"<h6 class='text-muted f-w-400'>".$_SESSION['id_player']."</h6>"?>

                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Login</p>
                                            <?php echo"<h6 class='text-muted f-w-400'>".$_SESSION['login']."</h6>"?>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <?php echo"<h6 class='text-muted f-w-400'>".$_SESSION['email']."</h6>"?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

</body>
</html>