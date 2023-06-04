<?php headerAdmin($data); ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
            </ul>
        </div>
        <!--
        <?php dep($_SESSION['permisos']); ?>
        <?php dep($_SESSION['permisosMod']); ?>
        -->
        <div class="row">
            <?php if (!empty($_SESSION['permisos'][MUSUARIOS]['r'])) { ?>
                <div class="col-md-6 col-lg-3">
                    <a href="<?= base_url() ?>/usuarios" class="linkw">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                            <div class="info">
                                <h4>Usuarios</h4>
                                <p><b><?= $data['usuarios'] ?></b></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <?php if (!empty($_SESSION['permisos'][MSOLICITANTES]['r'])) { ?>
                <div class="col-md-6 col-lg-3">
                    <a href="<?= base_url() ?>/solicitantes" class="linkw">
                        <div class="widget-small info coloured-icon"><i class="icon fa fa-user fa-3x"></i>
                            <div class="info">
                                <h4>Solicitantes</h4>
                                <p><b><?= $data['solicitantes'] ?></b></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <?php if (!empty($_SESSION['permisos'][MRECEPCIONES]['r'])) { ?>
                <div class="col-md-6 col-lg-3">
                    <a href="<?= base_url() ?>/recepciones" class="linkw">
                        <div class="widget-small warning coloured-icon"><i class="icon fa fa fa-archive fa-3x"></i>
                            <div class="info">
                                <h4>Recepciones</h4>
                                <p><b><?= $data['mantenimientos'] ?></b></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <?php if (!empty($_SESSION['permisos'][MENTREGAS]['r'])) { ?>
                <div class="col-md-6 col-lg-3">
                    <a href="<?= base_url() ?>/entregas" class="linkw">
                        <div class="widget-small danger coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
                            <div class="info">
                                <h4>Entregas</h4>
                                <p><b><?= $data['entregas'] ?></b></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <?php if (!empty($_SESSION['permisos'][MRECEPCIONES]['r'])) { ?>
                <div class="col-md-6">
                    <div class="tile">
                        <h3 class="tile-title">Mantenimientos Solicitados</h3>
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Solicitante</th>
                                    <th>Estado</th>
                                    <th>Problema</th>
                                    <!--
                                    <th class="text-right">Problema</th>
                                    -->
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($data['lastOrders']) > 0) {
                                    foreach ($data['lastOrders'] as $mantenimiento) {
                                ?>
                                        <tr>
                                            <td><?= $mantenimiento['idmantenimiento'] ?></td>
                                            <td><?= $mantenimiento['nombre'] ?></td>
                                            <td><?= $mantenimiento['status'] ?></td>
                                            <td><?= $mantenimiento['categoria'] ?></td>
                                            <!--
                                            <td class="text-right"><?= SMONEY . " " . formatMoney($mantenimiento['monto']) ?></td>
                                            
                                            <td><a href="<?= base_url() ?>/mantenimientos/orden/<?= $mantenimiento['idmantenimiento'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                            -->
                                        </tr>
                                <?php }
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>

            <div class="col-md-6">
                <div class="tile">
                    <div class="container-title">
                        <h3 class="tile-title">Historial</h3>
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre de la resepción</th>
                                    <th>Problema</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($data['mantenimientosTen']) > 0) {
                                    foreach ($data['mantenimientosTen'] as $mantenimiento) {
                                ?>
                                        <tr>
                                            <td><?= $mantenimiento['idmantenimiento'] ?></td>
                                            <td><?= $mantenimiento['nombre'] ?></td>
                                            <td><?= $mantenimiento['categoria'] ?></td>
                                            <!--
                                            <td><?= SMONEY . formatMoney($mantenimiento['precio']) ?></td>
                                            
                                            <td><a href="<?= base_url() ?>/mantenimientos/orden/<?= $mantenimiento['idmantenimiento'] . '/' . $producto['ruta'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                            -->
                                        </tr>
                                <?php }
                                } ?>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>            
        </div>
                            <!--
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="container-title">
                        <h3 class="tile-title">Entregas por mes</h3>
                        <div class="dflex">
                            <input class="date-picker ventasMes" name="ventasMes" placeholder="Mes y Año">
                            <button type="button" class="btnVentasMes btn btn-info btn-sm" onclick="fntSearchVMes()"> <i class="fas fa-search"></i> </button>
                        </div>
                    </div>
                    <div id="graficaMes"></div>
                </div>
            </div>
        </div>
                            -->

    </main>
<?php footerAdmin($data); ?>

<script>
    Highcharts.chart('graficaMes', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Ventas de <?= $data['ventasMDia']['mes'] . ' del ' . $data['ventasMDia']['anio'] ?>'
        },
        subtitle: {
            text: 'Total Ventas <?= SMONEY . '. ' . formatMoney($data['ventasMDia']['total']) ?> '
        },
        xAxis: {
            categories: [
                <?php
                foreach ($data['ventasMDia']['ventas'] as $dia) {
                    echo $dia['dia'] . ",";
                }
                ?>
            ]
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Dato',
            data: [
                <?php
                foreach ($data['ventasMDia']['ventas'] as $dia) {
                    echo $dia['total'] . ",";
                }
                ?>
            ]
        }]
    });
</script>