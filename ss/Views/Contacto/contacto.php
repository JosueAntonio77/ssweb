<?php
	headerTienda($data);
	getModal('modalCarrito', $data);
?>
<br><br><br>
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('<?= media(); ?>/tienda/images/bg-01.png');">
		<h2 class="ltext-105 cl0 txt-center">
			Contacto
		</h2>
	</section>
	

	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form id="frmContacto">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Enviar mensaje
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="nombreContacto" name="nombreContacto" placeholder="Nombre Completo">
							<img class="how-pos4 pointer-none" src="<?=media()?>/tienda/images/icons/icon-name.png" alt="ICON" style="width:28px;">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="emailContacto" name="emailContacto" placeholder="Correo electrónico">
							<img class="how-pos4 pointer-none" src="<?=media()?>/tienda/images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" id="mensaje" name="mensaje" placeholder="¿En qué te podemos ayudar?"></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Enviar
						</button>
					</form>
				</div>

				<div class="size-210 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md" style="padding-top:0;">
					<div class="flex-w w-full p-b-42" style="padding-bottom:15px;">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Dirección
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								C. 80 1885, Centro, 97320 Progreso, Yuc.
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42" style="padding-bottom:15px;">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Llámanos
							</span>

							<p class="stext-115 cl1 size-213 p-t-18" style="display:flex; flex-direction:row;">
								<label style="color:gray;">Ayuda:  </label> +52 9995098813
							</p>
							<p class="stext-115 cl1 size-213 p-t-18" style="display:flex; flex-direction:row;padding:0;">
								<label style="color:gray;">Oficina:  </label> +52 9999197070
							</p>
							<p class="stext-115 cl1 size-213 p-t-18" style="display:flex; flex-direction:row;padding:0;">
								<label style="color:gray;">Ventas:  </label> +52 9993539101
							</p>
						</div>
					</div>

					<div class="flex-w w-full" style="padding-bottom:15px;">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Más Información
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								ayuntamientoprogreso@gmail.com
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	

	<!-- Map -->
	<div class="map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1105.2844714027501!2d-89.6635241769206!3d21.28258788891006!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f55dd2a97b9ab23%3A0xc5eb078aedfcd27c!2sAyuntamiento%20De%20Progreso!5e0!3m2!1ses-419!2smx!4v1674502809033!5m2!1ses-419!2smx" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%" height="600px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
	</div>


<?php
	footerTienda($data);
?>