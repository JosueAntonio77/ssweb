<?php
date_default_timezone_set("America/Mexico_City");
setlocale(LC_ALL,"es_ES");
//$hora = date("g:i:A");

require("config.php");
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


$InsertNuevoEvento = "INSERT INTO eventoscalendar(
      evento,
      user1id,
      user2id,
      fecha_inicio,
      fecha_fin,
      estado,
      color_evento
      )
    VALUES (
      '" .$evento. "',
      '" .$user1id. "',
      '" .$user2id. "',
      '". $fecha_inicio."',
      '" .$fecha_fin. "',
      '" .$estado. "',
      '" .$color_evento. "'
  )";
$resultadoNuevoEvento = mysqli_query($con, $InsertNuevoEvento);

header("Location:reuniones.php?e=1");

?>