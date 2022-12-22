<?php
	headerTienda($data);
	getModal('modalCarrito', $data);
?>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('<?= media(); ?>/tienda/images/nosotros.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Nosotros
		</h2>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="row p-b-148">
				<div class="col-md-7 col-lg-8">
					<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
						<h3 class="mtext-111 cl2 p-b-16">
							¿Quiénes Somos?
						</h3>

						<p class="stext-113 cl6 p-b-26">
						Un socio de confianza en temas de gestión de la energía, mantenimiento y automatización.
						</p>

						<p class="stext-113 cl6 p-b-26">
						Sectores que atendemos:
						</p>

						<ul class="stext-113 cl6 p-b-26">
						<li>- Sector oíl and gas</li>
						<li>- Manufactura</li>
						<li>- Bebidas y alimentos</li>
						</ul>
					</div>
				</div>

				<div class="col-11 col-md-5 col-lg-4 m-lr-auto">
					<div class="how-bor1 ">
						<div class="hov-img0">
							<img src="<?= media(); ?>/tienda/images/nosotros_01.jpg" alt="IMG">
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="order-md-2 col-md-7 col-lg-8 p-b-30">
					<div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
						<h3 class="mtext-111 cl2 p-b-16">
							Misión
						</h3>

						<div class="bor16 p-l-29 p-b-9 m-t-22">
							<p class="stext-114 cl6 p-r-40 p-b-11">
							Ayudamos a diseñar, proyectar e integrar controles e instalaciones mecatrónicas, para mejorar la productividad, calidad y reducción del tiempo de los procesos industriales, nos comprometemos a dar lo mejor de nuestras capacidades para obtener la mejor calificación de nuestros clientes y accionistas.
							</p>
						</div>
						<br>
						<h3 class="mtext-111 cl2 p-b-16">
							Visión
						</h3>

						<div class="bor16 p-l-29 p-b-9 m-t-22">
							<p class="stext-114 cl6 p-r-40 p-b-11">
							Lograr altos niveles de crecimiento, sostenibilidad y rentabilidad en el corto, mediano y largo plazo en el sureste de México, para ser líder en el área de la mecatrónica, robótica e inteligencia artificial, implementando un sistema de gestión de calidad y planificación de recursos empresariales para ser más eficientes, reduciendo costos y aumentando la calidad, vigilando cuidadosamente el diseño, adquisición, producción y oportunidades de servicio para dar los mejores resultados.
							</p>
						</div>
					</div>
				</div>

				<div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
					<div class="how-bor2">
						<div class="hov-img0">
							<img src="<?= media(); ?>/tienda/images/nosotros_02.jpg" alt="IMG">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
	footerTienda($data);
?>