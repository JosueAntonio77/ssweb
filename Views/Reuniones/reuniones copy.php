<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Agenda MgDakava</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    #sidebar {
      width: 20%;
      height: 100vh;
      background: #343a40;
    }
  </style>

</head>
<body>

<!--<div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-book-content icon'></i>
      <a class="app-header__logo" href="http://localhost/mgdakava/dashboard"> <img src="../../Assets/images/LOGO_MG.png" alt="Logo de Mg Dakava" height="70%" width="70%"/></a>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <!--<li>
        <a href="Index_Carcedo.html">
          <i class='bx bx-server'></i>
          <span class="links_name">Server-Side</span>
        </a>
         <span class="tooltip">Server-Side</span>
      </li>
      <li>
       <a href="PHP_González.html">
          <i class='bx bxl-php'></i>
         <span class="links_name">PHP</span>
       </a>
       <span class="tooltip">PHP</span>
     </li>
     <li>
       <a href="Python_Carcedo.html">
         <i class='bx bxl-python'></i>
         <span class="links_name">Python</span>
       </a>
       <span class="tooltip">Python</span>
     </li>
     <li>
       <a href="Csharp_Gio.html">
         <i class='bx bxl-c-plus-plus' ></i>
         <span class="links_name">C#</span>
       </a>
       <span class="tooltip">C#</span>
     </li>
     <li>
       <a href="Java_Castro.html">
         <i class='bx bxl-java' ></i>
         <span class="links_name">Java</span>
       </a>
       <span class="tooltip">Java</span>
     </li>
     <li>
       <a href="NodeJS_Tut.html">
         <i class='bx bxl-nodejs' ></i>
         <span class="links_name">NodeJS</span>
       </a>
       <span class="tooltip">NodeJS</span>
     </li>
     <li>
       <a href="ASPNET_Medina.html">
         <i class='bx bxl-microsoft'></i>
         <span class="links_name">ASP.NET</span>
       </a>
       <span class="tooltip">ASP.NET</span>
     </li>
     <li>
       <a href="Ruby_González.html">
         <i class='bx bx-diamond' ></i>
         <span class="links_name">Ruby</span>
       </a>
       <span class="tooltip">Ruby</span>
     </li>-->
     <li class="profile">
      <a href="../Desarrolladores/Developers.html">
         <div class="profile-details">
           <img src="../../Assets/images/TecNM_Progreso.png" alt="TecNM Progreso Profile Image">
           <div class="name_job">
             <div class="name">Software Developers</div>
             <div class="job">TecNM Campus Progreso</div>
           </div>
         </div>
         <i class='bx bx-code-alt' id="logo_down"></i>
      </a>
     </li>
    </ul>
  </div>
  <section class="home-section">
  <div class="text"><b><center>Calendario de Reuniones</center></b></div>-->
      

  <?php
include('config.php');

  $SqlEventos   = ("SELECT * FROM eventoscalendar");
  $resulEventos = mysqli_query($con, $SqlEventos);

?>


<div class="container">
  <div class="row">
    <div class="col msjs">
      <?php
        include('msjs.php');
      ?>
    </div>
  </div>

<!--<div class="row">
  <div class="col-md-12 mb-3">
  <h3 class="text-center" id="title">Como crear un Calendario de Eventos con PHP y MYSQL</h3>
  </div>
</div>-->
</div>


<div class="col-md-7 offset-md-3">
  <div id="calendar"></div>


  <?php  
    include('modalNuevoEvento.php');
    include('modalUpdateEvento.php');
  ?>



  <script src ="js/jquery-3.0.0.min.js"> </script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script type="text/javascript" src="js/moment.min.js"></script>	
  <script type="text/javascript" src="js/fullcalendar.min.js"></script>
  <script src='locales/es.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {
    $("#calendar").fullCalendar({
      header: {
        left: "prev,next today",
        center: "title",
        right: "month,agendaWeek,agendaDay"
      },

      locale: 'es',

      defaultView: "month",
      navLinks: true, 
      editable: true,
      eventLimit: true, 
      selectable: true,
      selectHelper: false,

  //Nuevo Evento
    select: function(start, end){
        $("#exampleModal").modal();
        $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY'));
        
        var valorFechaFin = end.format("DD-MM-YYYY");
        var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); //Le resto 1 dia
        $('input[name=fecha_fin').val(F_final);  

      },
        
      events: [
        <?php
        while($dataEvento = mysqli_fetch_array($resulEventos)){ ?>
            {
            _id: '<?php echo $dataEvento['id']; ?>',
            title: '<?php echo $dataEvento['evento']; ?>',
            user1id: '<?php echo $dataEvento['user1id']; ?>',
            user2id: '<?php echo $dataEvento['user2id']; ?>',
            start: '<?php echo $dataEvento['fecha_inicio']; ?>',
            end:   '<?php echo $dataEvento['fecha_fin']; ?>',
            estado: '<?php echo $dataEvento['estado']; ?>',
            color: '<?php echo $dataEvento['color_evento']; ?>'
            //notas: '<?php echo $dataEvento['notas']; ?>'
            },
          <?php } ?>
      ],


  /*//Eliminar Evento
  eventRender: function(event, element) {
      element
        .find(".fc-content")
        .prepend("<span id='btnCerrar'; class='closeon material-icons'>&#xe5cd;</span>");
      
      //Eliminar evento
      element.find(".closeon").on("click", function() {

    var pregunta = confirm("¿Deseas Borrar este Evento?");   
    if (pregunta) {

      $("#calendar").fullCalendar("removeEvents", event._id);

      $.ajax({
              type: "POST",
              url: 'deleteEvento.php',
              data: {id:event._id},
              success: function(datos)
              {
                $(".alert-danger").show();

                setTimeout(function () {
                  $(".alert-danger").slideUp(500);
                }, 3000); 

              }
          });
        }
      });
    },

*/
  //Moviendo Evento Drag - Drop
  eventDrop: function (event, delta) {
    var idEvento = event._id;
    var start = (event.start.format('DD-MM-YYYY'));
    var end = (event.end.format("DD-MM-YYYY"));

      $.ajax({
          url: 'drag_drop_evento.php',
          data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
          type: "POST",
          success: function (response) {
          // $("#respuesta").html(response);
          }
      });
  },

  //Modificar Evento del Calendario 
  eventClick:function(event){
      var idEvento = event._id;
      $('input[name=idEvento').val(idEvento);
      $('input[name=evento').val(event.title);
      //$('input[name=user1id').val(event.user1id);
      //$('input[name=user2id').val(event.user2id);
      $('input[name=fecha_inicio').val(event.start.format('DD-MM-YYYY'));
      $('input[name=fecha_fin').val(event.end.format("DD-MM-YYYY"));
      //$('input[name=status').val(event.status);

      $("#modalUpdateEvento").modal();
    },


    });


  //Oculta mensajes de Notificacion
    setTimeout(function () {
      $(".alert").slideUp(300);
    }, 3000); 


  });

  </script>
</div>
<!--</section>
<script src="js/script.js"></script>-->
</body>
</html>