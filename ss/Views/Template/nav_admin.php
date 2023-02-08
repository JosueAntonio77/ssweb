    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media();?>/images/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombres']; ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol']; ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <?php if(!empty($_SESSION['permisos'][1]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][2]['r'])){ ?>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                <span class="app-menu__label">Usuarios</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa fa-circle-o"></i> Roles</a></li>
            </ul>
        </li>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][3]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/clientes">
                <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>
                <span class="app-menu__label">Clientes</span>
            </a>
        </li>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][4]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/recepciones">
                <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>
                <span class="app-menu__label">Recepciones</span>  
            </a>
        </li>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/entregas">
                <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>
                <span class="app-menu__label">Entregas</span>
            </a>
        </li>
        <?php } ?> 

         <?php if(!empty($_SESSION['permisos'][7]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/Views/Reuniones/reuniones.php">
                <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                <span class="app-menu__label">Calendario</span>
            </a>
        </li>
        <?php } ?>

        <!--<?php if(!empty($_SESSION['permisos'][8]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/cotizaciones">
                <i class="app-menu__icon fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="app-menu__label">Cotizaciones</span>
            </a>
        </li>
         <?php } ?>-->

         
         <?php if(!empty($_SESSION['permisos'][10]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/suscriptores">
                <i class="app-menu__icon fas fa-user-tie" aria-hidden="true"></i>
                <span class="app-menu__label">Suscriptores</span>
            </a>
        </li>
        <?php } ?>

         <?php if(!empty($_SESSION['permisos'][11]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/contactos">
                <i class="app-menu__icon fas fa-envelope" aria-hidden="true"></i>
                <span class="app-menu__label">Mensajes</span>
            </a>
        </li>
        <?php } ?>


        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Logout</span>
            </a>
        </li>
      </ul>
    </aside>