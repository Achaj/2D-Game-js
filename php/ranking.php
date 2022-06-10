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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<div>
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
    <br><br>
    <?php
    require_once "connect.php";
    $conn = @new mysqli($host,$db_user,$db_pass,$db_name);
    if ($conn->connect_error) {
        echo("Connection failed: " . $conn->connect_error);
        
    }else{
   // echo "połączenie ok";
                $sql = "SELECT p.player_nick,score,timeGame FROM game_wyn g,players p WHERE p.id=id_player AND win='true' GROUP BY p.player_nick ORDER BY score DESC";
                    if ($result =$conn->query($sql)) {
                        echo "<table  class='table table-dark table-hover'>
                        <thead>
                                <tr>
                                 <th scope='col' class='col-3'>Pozycja w rankigu</th>
                                <th scope='col' class='col-3'>nick</th>
                                <th scope='col' class='col-3'>wynik</th>
                                <th scope='col' class='col-3'>czas</th>    
                            </tr>
                            </thead>
                            <tbody>";
                        $i=1;
                            while ($wpis = $result->fetch_assoc()) {     
                                echo "<tr>";
                                echo "<td class='col-3'>".$i."</td>";
                                echo "<td class='col-3'>".$wpis['player_nick']."</td>";
                            
                                echo "<td class='col-3'>".$wpis['score']."</td>";
                                if($i==1){
                                    $_SESSION['wyn1']=$wpis['score'];
                                    $_SESSION['player1']=$wpis['player_nick'];
                                }elseif ($i==2){
                                    $_SESSION['wyn2']=$wpis['score'];
                                    $_SESSION['player2']=$wpis['player_nick'];
                                }elseif ($i==3){
                                    $_SESSION['wyn3']=$wpis['score'];
                                    $_SESSION['player3']=$wpis['player_nick'];
                                }
                            
                                echo "<td class='col-3'>".$wpis['timeGame']."</td>";
                                echo "</tr>";
                                $i++;
                            }
                            echo"<tbody></table>";
                    } else {
                        echo "Error:  " . $sql . "<br>" . $conn->error;
                            echo "nie działa";
                    }
    }
        $conn->close();
    ?>
    </div>
    <div class="col12">
        <canvas id="myRank" style="width:100%;max-width:800px"></canvas>
        <script>

            var xValues = ['<?php echo $_SESSION['player2']?>' ,'<?php echo $_SESSION['player1']?>','<?php echo $_SESSION['player3']?>'];
            var yValues = [<?php echo $_SESSION['wyn2']?>,<?php echo $_SESSION['wyn1']?>,<?php echo $_SESSION['wyn3']?>];
            var barColors = ["red", "green","blue"];

            new Chart("myRank", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues,

                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Ranking Gracza",
                        color:'#fff',

                    }
                }
            });
        </script>
    </div>
</div>
</body>
</html>