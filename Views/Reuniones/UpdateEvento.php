<?php
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");

include('config.php');

$idEvento         = $_POST['idEvento'];

$evento            = ucwords($_REQUEST['evento']);
$user1id           = ucwords($_REQUEST['user1id']);
$user2id           = ucwords($_REQUEST['user2id']);
$f_inicio          = $_REQUEST['fecha_inicio'];
$fecha_inicio      = date('Y-m-d', strtotime($f_inicio)); 

$f_fin             = $_REQUEST['fecha_fin']; 
$seteando_f_final  = date('Y-m-d', strtotime($f_fin));  
$fecha_fin1        = strtotime($seteando_f_final."+ 1 days");
$fecha_fin         = date('Y-m-d', ($fecha_fin1));  
$estado            = $_REQUEST['estado'];
$color_evento      = $_REQUEST['color_evento'];

$UpdateProd = ("UPDATE eventoscalendar 
    SET evento ='$evento',
        user1id = '$user1id',
        user2id = '$user2id',
        fecha_inicio ='$fecha_inicio',
        fecha_fin ='$fecha_fin',
        estado = '$estado',
        color_evento ='$color_evento'
    WHERE id='".$idEvento."' ");
$result = mysqli_query($con, $UpdateProd);

header("Location:reuniones.php?ea=1");
?>