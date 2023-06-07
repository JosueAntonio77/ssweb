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
      <?php if (!empty($_SESSION['permisos'][MRECEPCIONES]['r'])) { ?>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Últimos Mantenimientos</h3>
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
                      -->
                      <td><a href="<?= base_url() ?>/mantenimientos/orden/<?= $mantenimiento['idmantenimiento'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    </tr>
                <?php }
                } ?>

              </tbody>
            </table>
          </div>
        </div>
      <?php } ?>

      <!--
      <div class="col-md-6">
        <div class="tile">
          <div class="container-title">
              <h3 class="tile-title">Tipo de pagos por mes</h3>
                <div class="dflex">
                  <input class="date-picker pagoMes" name="pagoMes" placeholder="Mes y Año">
                  <button type="button" class="btnTipoVentaMes btn btn-info btn-sm" onclick="fntSearchMantenimientos()"> <i class="fas fa-search"></i> </button>
                </div>
              </div>
            <div id="manteniMesAnio"></div>
          </div>
        </div>
      </div>-->

    </div>

    <div class="row">
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
      <div class="col-md-12">
        <div class="tile">
          <div class="container-title">
            <h3 class="tile-title">Entregas por año</h3>
            <div class="dflex">
              <input class="mantenimientosAnio" name="mantenimientosAnio" placeholder="Año" minlength="4" maxlength="4" onkeypress="return controlTag(event);">
              <button type="button" class="btnVentasAnio btn btn-info btn-sm" onclick="fntSearchMAnio()"> <i class="fas fa-search"></i> </button>
            </div>
          </div>
          <div id="graficaAnio"></div>
        </div>
      </div>
    </div>

  </main>
<?php footerAdmin($data); ?>

<script>
  /*///////////////////////////////////////*/
  /*
  Highcharts.chart('manteniMesAnio', {
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
      },
      title: {
          text: 'Mantenimientos por mes, <?= $data['manteniMes']['mes'].' '.$data['manteniMes']['anio'] ?>'
      },
      tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      accessibility: {
          point: {
              valueSuffix: '%'
          }
      },
      plotOptions: {
        
          pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                  enabled: true,
                  format: '<b>{point.name}</b>: {point.percentage:.1f} %'
              }
          }
      },
      
      series: [{
          name: 'Total',
          colorByPoint: true,
          data: [
            <?php 
              foreach ($data['manteniMes']['mantenimientos'] as $pagos){
                  echo "{name:'". $pagos['tipopago']."',y:".$pagos['total']."},";
              }
              ?>
          ]
      }]
      
  });
  */
  /*///////////////////////////////////////*/
  Highcharts.chart('graficaMes', {
    chart: {
        type: 'spline'
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
              echo $dia['dia'].",";
              }
            ?>
        ],
    },
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
                echo $dia['cantidad'].",";
              }
          ?>
        ]
    }]
  });
  /*///////////////////////////////////////*/
  Highcharts.chart('graficaAnio', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Entregas del año <?= $data['manteniAnio']['anio'] ?> '
    },
    subtitle: {
      text: 'Estadística de entregas por mes'
    },
    xAxis: {
      type: 'category',
      labels: {
        rotation: -45,
        style: {
          fontSize: '13px',
          fontFamily: 'Verdana, sans-serif'
        }
      }
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Cantidad de entregas'
      }
    },
    legend: {
      enabled: false
    },
    tooltip: {
      //pointFormat: 'Entregas en 2017: <b>{point.y:.1f} millions</b>'
      crosshairs: true,
        shared: true
    },
    series: [{
      name: 'Entregas',
      data: [
        <?php
        foreach ($data['manteniAnio']['meses'] as $mes) {
          echo "['" . $mes['mes'] . "'," . $mes['cantidad'] . "],";
        }
        ?>
      ],
      dataLabels: {
        enabled: true,
        rotation: -90,
        color: '#FFFFFF',
        align: 'right',
        //format: '{point.y:.1f}', // one decimal
        y: 10, // 10 pixels down from the top
        style: {
          fontSize: '13px',
          fontFamily: 'Verdana, sans-serif'
        }
      }
    }]
  });
  /*///////////////////////////////////////*/
  /*
    Highcharts.chart('graficaMes', {
    chart: {
      type: 'line'
    },
    title: {
      text: 'Entregas de <?= $data['ventasMDia']['mes'] . ' del ' . $data['ventasMDia']['anio'] ?>'
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

  Highcharts.chart('graficaAnio', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Entregas del año <?= $data['ventasAnio']['anio'] ?> '
    },
    subtitle: {
      text: 'Estadística de entregas por mes'
    },
    xAxis: {
      type: 'category',
      labels: {
        rotation: -45,
        style: {
          fontSize: '13px',
          fontFamily: 'Verdana, sans-serif'
        }
      }
    },
    yAxis: {
      min: 0,
      title: {
        text: ''
      }
    },
    legend: {
      enabled: false
    },
    tooltip: {
      pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
    },
    series: [{
      name: 'Population',
      data: [
        <?php
        foreach ($data['ventasAnio']['meses'] as $mes) {
          echo "['" . $mes['mes'] . "'," . $mes['venta'] . "],";
        }
        ?>
      ],
      dataLabels: {
        enabled: true,
        rotation: -90,
        color: '#FFFFFF',
        align: 'right',
        format: '{point.y:.1f}', // one decimal
        y: 10, // 10 pixels down from the top
        style: {
          fontSize: '13px',
          fontFamily: 'Verdana, sans-serif'
        }
      }
    }]
  });
  */
  /*///////////////////////////////////////*/
</script>