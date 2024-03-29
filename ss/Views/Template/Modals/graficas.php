<?php

if ($grafica = "tipoPagoMes") {
    $pagosMes = $data;
?>
    <script>
        Highcharts.chart('pagosMesAnio', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Ventas por tipo pago, <?= $pagosMes['mes'] . ' ' . $pagosMes['anio'] ?>'
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
                name: 'Brands',
                colorByPoint: true,
                data: [
                    <?php
                    foreach ($pagosMes['tipospago'] as $pagos) {
                        echo "{name:'" . $pagos['tipopago'] . "',y:" . $pagos['total'] . "},";
                    }
                    ?>
                ]
            }]
        });
    </script>
<?php } ?>
<!--////////////////////////////////////////-->
<?php
if ($grafica = "mantenimientosMes") {
    $mantenimientosMes = $data;
?>
    <script>
        Highcharts.chart('graficaMes', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Entregas de <?= $mantenimientosMes['mes'] . ' del ' . $mantenimientosMes['anio'] ?>'
            },
            subtitle: {
                text: 'Total Entregas <?= $mantenimientosMes['total'] ?> '
            },
            xAxis: {
                categories: [
                    <?php
                    foreach ($mantenimientosMes['mantenimientos'] as $dia) {
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
                name: '',
                data: [
                    <?php
                    foreach ($mantenimientosMes['mantenimientos'] as $dia) {
                        echo $dia['cantidad'] . ",";
                    }
                    ?>
                ]
            }]
        });
    </script>
<?php } ?>
<!--////////////////////////////////////////-->
<?php
if ($grafica = "mantenimientosAnio") {
    $mantenimientosAnio = $data;
?>
    <script>
        Highcharts.chart('graficaAnio', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Entregas del año <?= $mantenimientosAnio['anio'] ?> '
            },
            subtitle: {
                text: 'Esdística de entregas por mes'
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
                //pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
                crosshairs: true,
                shared: true
            },
            series: [{
                name: 'Entregas',
                data: [
                    <?php
                    foreach ($mantenimientosAnio['meses'] as $mes) {
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
    </script>
<?php } ?>