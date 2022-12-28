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
    .app-nav__item{
      color: #ffffff;
    }
    .app-nav__item:hover{
      color: #efefef;
    }
  </style>

</head>
<body>
  <div class="d-flex">
    <div id="sidebar">
      <div class="p-2">
        <a href="http://localhost/ssweb/" class="navbar-brand text-center text-light w-100 p-4 border-bottom">
        <img src="../../Assets/images/LOGO_MG.png" alt="Logo de Mg Dakava" height="70%" width="70%"/>
        </a>
      </div>
      <div id="sidebar-accordion" class="accordion">
        <div class="list-group">
          <a href="encuesta.php" aria-expanded="false"
            class="list-group-item list-group-item-action bg-dark text-light">
            <center>Encuesta</center>
          </a>
          <!--<a href="#profile-items" data-toggle="collapse" aria-expanded="false"
            class="list-group-item list-group-item-action bg-dark text-light">
            <i class="fa fa-user mr-3" aria-hidden="true"></i>Profile
          </a>
          <div id="profile-items" class="collapse" data-parent="#sidebar-accordion">
            <a href="#" class="list-group-item list-group-item-action bg-dark text-light pl-5">
              Item 1
            </a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-light pl-5">
              Item 2
            </a>
          </div>
          <a href="#" class="list-group-item list-group-item-action bg-dark text-light">
            <i class="fa fa-shopping-cart mr-3" aria-hidden="true"></i>Buy Now!
          </a>
          <a href="#setting-items" data-toggle="collapse" aria-expanded="false"
            class="list-group-item list-group-item-action bg-dark text-light">
            <i class="fa fa-cog mr-3" aria-hidden="true"></i>Settings
          </a>
          <div id="setting-items" class="collapse" data-parent="#sidebar-accordion">
            <div class="d-flex flex-row text-center">
              <a href="#" class="list-group-item list-group-item-action bg-dark text-light">
                Item 1
              </a>
              <a href="#" class="list-group-item list-group-item-action bg-dark text-light">
                Item 2
              </a>
            </div>
          </div>-->
          <div class="profile">
            <a href="../Desarrolladores/Developers.html">
              <div class="profile-details">
                <img src="../../Assets/images/TecNM_Progreso.png" alt="TecNM Progreso Profile Image">
                <div class="name_job">
                  <div class="name">Software Developers</div>
                  <div class="job">TecNM Campus Progreso</div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="content w-100">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-xl">
          <a class="navbar-brand" href="reuniones.php"><b>Calendario de Reuniones</b></a>
          <form class="form-inline my-2 my-md-0">
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
              <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="http://localhost/ssweb/opciones"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
                <li><a class="dropdown-item" href="http://localhost/ssweb/usuarios/perfil"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                <li><a class="dropdown-item" href="http://localhost/ssweb/logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
              </ul>
            </li>
          </form>
          <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>    
          <div class="collapse navbar-collapse" id="navbarsExample07XL">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown07XL" data-toggle="dropdown" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown07XL">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
            </ul>
            <form class="form-inline my-2 my-md-0">
              <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </form>
          </div>-->
          
        </div>
      </nav>
      <section class="p-3">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
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


<div class="col-md-9  offset-md-2">
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
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>
</html>