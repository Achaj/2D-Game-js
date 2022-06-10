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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

  ]
    </head>
<body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
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
        <br>
                <?php
            require_once "connect.php";
            $conn = @new mysqli($host,$db_user,$db_pass,$db_name);
            if ($conn->connect_error) {
                echo("Connection failed: " . $conn->connect_error);
                
            }else{
        // echo "połączenie ok";
                $use=$_SESSION['id_player'];
                        $sql = "SELECT p.player_nick,score,timeGame,win FROM game_wyn g,players p WHERE p.id=g.id_player and g.id_player='$use' ORDER BY g.score,g.timeGame ASC";
                            if ($result =$conn->query($sql)) {
                                echo "<table  class='table table-dark table-hover'>
                                <thead>
                                        <tr>
                                        <th scope='col' class='col-3'>Pozycja </th>
                                        <th scope='col' class='col-3'>nick</th>
                                        <th scope='col' class='col-3'>wynik</th>
                                        <th scope='col' class='col-3'>czas</th>
                                        <th scope='col' class='col-3'>Wygrana</th>       
                                    </tr>
                                    </thead>
                                    <tbody>";
                                $i=1;
                                $win=0;
                                $lose=0;
                                    while ($wpis = $result->fetch_assoc()) {     
                                        echo "<tr>";
                                        echo "<td class='col-3'>".$i."</td>";
                                        echo "<td class='col-3'>".$wpis['player_nick']."</td>";
                                    
                                        echo "<td class='col-3'>".$wpis['score']."</td>";
                                    
                                        echo "<td class='col-3'>".$wpis['timeGame']."</td>";
                                        echo "<td class='col-3'>".$wpis['win']."</td>";
                                        if($wpis['win']=='true'){
                                            $win++;
                                        }else{
                                            $lose++;
                                        }
                                        echo "</tr>";
                                        $i++;
                                    }
                                    $suma=$win+$lose;
                                    if($suma!=0) {
                                        $_SESSION['x'] = ($win / $suma);
                                        $_SESSION['y'] = ($lose / $suma);
                                    }
                                    echo"<tbody></table>";
                            } else {
                                echo "Error:  " . $sql . "<br>" . $conn->error;
                                
                                    echo "nie działa";
                            
                            }
                $conn->close();
            }?>
     </div>
        </div>
     <div class="col-12 ">
         <canvas id="myChart" style="width:100%;max-width:800px;position: fixed; color: white"></canvas>
         <script>
             var xValues = ["Wygrana", "Przegrana"];
             var yValues = [<?php echo $_SESSION['x']?>,<?php echo $_SESSION['x']?>,];
             var barColors = [
                 "#0a2499",
                 "#00aba9"];

             new Chart("myChart", {
                 type: "pie",
                 data: {
                     labels: xValues,
                     datasets: [{
                         backgroundColor: barColors,
                         data: yValues
                     }]
                 },
                 options: {
                     title: {
                         display: true,
                         text: "Statystyka Gracza"
                     }
                 }
             });

         </script>
     </div>
</div>

</body>
</html>