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
                        <div class="widget-small warning coloured-icon"><i class="icon fa fa-user fa-3x"></i>
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
                        <div class="widget-small danger coloured-icon"><i class="icon fa fa fa-archive fa-3x"></i>
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
                        <div class="widget-small info coloured-icon"><i class="icon fa fa fa-archive fa-3x"></i>
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
            <?php if (!empty($_SESSION['permisos'][MSOLICITUDES]['r'])) { ?>
                <div class="col-md-6">
                    <div class="tile">
                        <h3 class="tile-title">Mantenimientos Solicitados</h3>
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Técnico</th>
                                    <th>Descripción</th>
                                    <th>Problema</th>
                                    <!--
                                    <th class="text-right">Problema</th>
                                    <th>Acciones</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($data['lastOrders']) > 0) {
                                    foreach ($data['lastOrders'] as $mantenimiento) {
                                ?>
                                        <tr>
                                            <td><?= $mantenimiento['idmantenimiento'] ?></td>
                                            <td><?= $mantenimiento['tecnico'] ?></td>
                                            <td><?= $mantenimiento['descripcion'] ?></td>
                                            <td><?= $mantenimiento['categoria'] ?></td>
                                            <!--
                                            <td class="text-right"><?= SMONEY . " " . formatMoney($mantenimiento['monto']) ?></td>
                                            <td><a href="<?= base_url() ?>/entregas/orden/<?= $mantenimiento['idmantenimiento'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                            -->
                                        </tr>
                                <?php }
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tile">
                        <div class="container-title">
                            <h3 class="tile-title">Historial</h3>
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre de la recepción</th>
                                        <th>Descripción</th>
                                        <th>Diagnóstico</th>
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
                                                <td><?= $mantenimiento['descripcion'] ?></td>
                                                <td><?= $mantenimiento['diagnostico'] ?></td>
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
            <?php } ?>            
        </div>
                        
        <div class="row">
            <?php if (!empty($_SESSION['permisos'][MENTREGAS]['r'])) { ?>
                <div class="col-md-12">
                    <div class="tile">
                        <div class="container-title">
                            <h3 class="tile-title">Entregas por mes</h3>
                            <div class="dflex">
                                <input class="date-picker mantenimientosMes" name="mantenimientosMes" placeholder="Mes y Año">
                                <button type="button" class="btnVentasMes btn btn-info btn-sm" onclick="fntSearchMMes()"> <i class="fas fa-search"></i> </button>
                            </div>
                        </div>
                        <div id="graficaMes"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
                            

    </main>
<?php footerAdmin($data); ?>

<script>
    Highcharts.chart('graficaMes', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Entregas de <?= $data['manteniMes']['mes'].' del '.$data['manteniMes']['anio']?>'
        },
        subtitle: {
            text: 'Total Entregas <?= $data['manteniMes']['total'] ?> '
        },
        xAxis: {
            categories: [
                <?php
                foreach ($data['manteniMes']['mantenimientos'] as $dia) {
                    echo $dia['dia'] . ",";
                }
                ?>
            ]
        },/*
        yAxis: {
            title: {
                text: 'Cantidad de entregas'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },*/
        yAxis: {
            title: {
                text: 'Cantidad de entregas'
            },
            labels: {
                formatter: function () {
                    //return this.value + '°';
                    return this.value;
                }
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'Entregas',
            data: [
                <?php
                foreach ($data['manteniMes']['mantenimientos'] as $dia) {
                    echo $dia['cantidad'] . ",";
                }
                ?>
            ]
        }]
    });
</script>