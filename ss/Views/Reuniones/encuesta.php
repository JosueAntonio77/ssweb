<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MG DAKAVA | Encuesta</title>
</head>
<body>
    <center>
        <h1 style="font-size:90px;font-family: century gothic;">Ayúdanos a mejorar</h1>
        <h2 style="font-size:50px;font-family: century gothic;">Valora tu experiencia con Mg Dakava</h2>
        <h4 style="color:#ff7200;font-family: century gothic;">Su respuesta es anónima</h1>
    </center>
    <br><hr>
    
        <div id="encuesta">
            <form action="encuesta.php" method="POST" align="center">
                <input type="image" img src="images/excelente.jpg" onmouseover="this.src='images/excelente2.png'" onmouseout="this.src='images/excelente.jpg'" name="excelente" value="excelente">
                <input type="image" img src="images/bien.jpg" onmouseover="this.src='images/bien2.png'" onmouseout="this.src='images/bien.jpg'" name="bien" value="bien">
                <input type="image" img src="images/regular.jpg" onmouseover="this.src='images/regular2.png'" onmouseout="this.src='images/regular.jpg'" name="regular" value="regular">
                <input type="image" img src="images/mal.jpg" onmouseover="this.src='images/mal2.png'" onmouseout="this.src='images/mal.jpg'" name="mal" value="mal">
                <input type="image" img src="images/horrible.jpg" onmouseover="this.src='images/horrible2.png'" onmouseout="this.src='images/horrible.jpg'" name="pesimo" value="pesimo">
            </form>

            <br><br><br>
            <center><button onclick="location.href='reuniones.php'" type="button" style="background:black;color:white;padding:10px;border-radius: 25% 10%;font-size:15px;font-family: century gothic;"><b>Regresar</b></button></center>

            <?php
                //include('config.php');

                $con = mysqli_connect("localhost","root","","eventoscalendar");
                if(isset($_POST['excelente']))
                {
                    $excelente = ("UPDATE encuesta SET excelente=excelente+1");
                    $run_excelente = mysqli_query($con, $excelente);
                    header("Location:reuniones.php?ea=1");
                }

                $con = mysqli_connect("localhost","root","","eventoscalendar");
                if(isset($_POST['bueno']))
                {
                    $bueno = ("UPDATE encuesta SET bueno=bueno+1");
                    $run_bueno = mysqli_query($con, $bueno);
                    header("Location:reuniones.php?ea=1");
                }

                $con = mysqli_connect("localhost","root","","eventoscalendar");
                if(isset($_POST['regular']))
                {
                    $regular = ("UPDATE encuesta SET regular=regular+1");
                    $run_regular = mysqli_query($con, $regular);
                    header("Location:reuniones.php?ea=1");
                }

                $con = mysqli_connect("localhost","root","","eventoscalendar");
                if(isset($_POST['mal']))
                {
                    $mal = ("UPDATE encuesta SET mal=mal+1");
                    $run_mal = mysqli_query($con, $mal);
                    header("Location:reuniones.php?ea=1");
                }

                $con = mysqli_connect("localhost","root","","eventoscalendar");
                if(isset($_POST['pesimo']))
                {
                    $pesimo = ("UPDATE encuesta SET pesimo=pesimo+1");
                    $run_pesimo = mysqli_query($con, $pesimo);
                    header("Location:reuniones.php?ea=1");
                }
            ?>

        </div>
    
    
</body>
</html>