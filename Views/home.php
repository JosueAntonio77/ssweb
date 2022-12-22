<!--<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mg Dakava">
    <meta name="author" content="TecNM">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Mg Dakava</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">

    <link rel="stylesheet" type="text/css" href="<?= media();?>/css/cover.css">

    

    <!-- Bootstrap core CSS -->
<!--<link href="<?= media();?>/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
 <!--   <link href="cover.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <a class="float-md-start mb-0" href="http://localhost/mgdakava/"><img src="<?= media();?>/images/LOGO_MG.png" alt="Logo de Mg Dakava" height="70%" width="70%"/></a>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        <a class="nav-link" href="#">Acerca de</a>
        <a class="nav-link" href="<?= base_url(); ?>/dashboard">Iniciar Sesión</a>
      </nav>
    </div>
  </header>

  <main class="px-3">
    <h1>Productos y Servicios</h1>
    <p class="lead">Un socio de confianza en temas de gestión de la energía, mantenimiento y automatización.</p>
    <p class="lead">
      <a href="http://localhost/mgdakava/dashboard" class="btn btn-lg btn-secondary fw-bold border-white bg-gray">Ingresar</a>
    </p>
  </main>

  <footer class="mt-auto text-white-50">
    <p>TecNM Campus <a href="https://www.progreso.tecnm.mx/" class="text-white">Progreso</a>, por <a href="https://www.facebook.com/profile.php?id=100063637870353" class="text-white">Ingeniería en Sistemas Computacionales</a>.</p>
  </footer>
</div>


    
  </body>
</html>-->

<?php
	headerTienda($data);
	//getModal('modalCarrito', $data);
	$arrSlider = $data['slider'];
	//dep($arrSlider);
	$arrBanner = $data['banner'];
	//dep($arrBanner);
	$arrProductos = $data['productos'];
	//dep($arrProductos);
?>
	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				
	  			<?php
					for($i=0; $i<count($arrSlider); $i++)
					{
						$ruta = $arrSlider[$i]['ruta'];
				?>
				<div class="item-slick1" style="background-image: url(<?= $arrSlider[$i]['portada'] ?>);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									<?= $arrSlider[$i]['descripcion'] ?>
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
								<?= $arrSlider[$i]['nombre'] ?>
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="<?= base_url().'/tienda/categoria/'.$arrSlider[$i]['idcategoria'].'/'.$ruta; ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Ir
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php
					} 
				?>
			</div>
		</div>
	</section>


	<!-- Banner -->
	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="row">
				<?php
					for($j=0; $j<count($arrBanner); $j++)
					{
						$ruta = $arrBanner[$j]['ruta'];
				?>
				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="<?= $arrBanner[$j]['portada'] ?>" alt="<?= $arrBanner[$j]['nombre'] ?>">

						<a href="<?= base_url().'/tienda/categoria/'.$arrBanner[$j]['idcategoria'].'/'.$ruta; ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									<?= $arrBanner[$j]['nombre'] ?>
								</span>

								<!--<span class="block1-info stext-102 trans-04">
									Spring 2018
								</span>-->
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Ver
								</div>
							</div>
						</a>
					</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>


	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Productos y Servicios
				</h3>
			</div>
			<hr>
			<div class="row isotope-grid">
				
				<?php
					for($p=0; $p<count($arrProductos); $p++)
					{
						$ruta = $arrProductos[$p]['ruta'];
						if(count($arrProductos[$p]['images'])>0)
						{
							$portada = $arrProductos[$p]['images'][0]['url_image'];
						}
						else
						{
							$portada = media().'/images/uploads/product.png';
						}
				?>	
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="<?= $portada?>" alt="<?= $arrProductos[$p]['nombre'] ?>">

							<a href="<?= base_url().'/tienda/producto/'.$arrProductos[$p]['idproducto'].'/'.$ruta; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
								Ver
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="<?= base_url().'/tienda/producto/'.$arrProductos[$p]['idproducto'].'/'.$ruta; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?= $arrProductos[$p]['nombre'] ?>
								</a>

								<span class="stext-105 cl3">
									<?= SMONEY.formatMoney($arrProductos[$p]['precio']); ?>
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="<?= media() ?>/tienda/images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="<?= media() ?>/tienda/images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
				?>	

			</div>

			<!-- Load more -->
			<!--<div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Ver Más
				</a>
			</div>-->
		</div>
	</section>

<?php
	footerTienda($data);
?>