<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

?>

<!--=====================================
TOP SUPERIOR SALUDO
======================================-->

<div class="container-fluid  backColor" id="topSuperior">

	<div class="container">

		<center>

			<span>
				<p>Bienvenidos a START LIVE <i class="fa fa-heart"></i> </p>
			</span>

		</center>

	</div>

</div>

<!--=====================================
TOP
======================================-->

<div class="container-fluid barraSuperior" id="top">

	<div class="container">
		
		<div class="row">

			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">

				<!--=====================================
					BUSCADOR
				======================================-->
					
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="buscador">
						
					<div class="input-group mb-3">

	      				<input type="search" name="buscar" aaria-label="Search" class="form-control" placeholder="Buscar...">

	      					<span class="input-group-append">
	      						
							  	<a href="<?php echo $url; ?>buscador/1/recientes">
	      							
	        						<button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>

	      						</a>

	      					</span>

	    			</div>

				</div>
				
				<!--=====================================
				SOCIAL
				======================================-->

				<div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 social">
					
					<ul>	

						<?php

						$social = ControladorPlantilla::ctrEstiloPlantilla();

						$jsonRedesSociales = json_decode($social["redesSociales"],true);		

						foreach ($jsonRedesSociales as $key => $value) {

							echo '<li>
									<a href="'.$value["url"].'" target="_blank">
										<i class="'.$value["red"].' redSocial '.$value["estilo"].'"></i>
									</a>
								</li>';
						}

						?>

					</ul>

				</div>

			</div>
		
			<!--=====================================
			LOGOTIPO
			======================================-->

 			<div class="col-xl-6 col-lg-6 col-md-4 col-sm-12 col-12 d-flex justify-content-center" id="logotipo">
				
				<a href="<?php echo $url; ?>">
					
					<?php

						$social = ControladorPlantilla::ctrEstiloPlantilla();

					?>

					<img src="<?php echo $servidor.$social["logo"]; ?>" class="img-fluid">

				</a>

			</div> 

			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
			
				<!--=====================================
					REGISTRO
				======================================-->
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 registro">

					<ul>
					
						<i class="fa fa-user" aria-hidden="true"></i> <li> <a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
						<li>|</li>
						<i class="fa fa-heart" aria-hidden="true"></i> <li> <a href="#modalRegistro" data-toggle="modal">Crear cuenta</a></li>

					</ul> 		

				</div>

				<!--=====================================
				CARRITO DE COMPRAS
				======================================-->

				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-7" id="carrito">
					
					<a href="#">

						<button class="btn btn-secondary float-left backColor"> 

							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						
						</button>
						
						<p>TU CESTA <span class="cantidadCesta">3</span> <br> COP $ <span class="sumaCesta">20</span></p>
					
					</a>	

				</div>

			</div>			
		
		</div>

	</div>

</div>

<!--=====================================
HEADER
======================================-->


		
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top navegacion " data-toggle="affix">

	<button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbar10">
		<a href="#" class="navbar-brand">Menu</a>
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="navbar-collapse collapse" id="navbar10">

		<ul class="navbar-nav nav-fill w-100">

			<li class="nav-item">
				<a class="nav-link"  href="<?php echo $url; ?>">INICIO</a>
			</li>

			<?php 

			$item = null;
			$valor = null;

			$categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

			foreach ($categorias as $key => $value) :

				?>
				

				<li class="nav-item dropdown">

				<?php 

					echo '<a class="nav-link dropdown-toggle" href="'.$url.$value["ruta"].'" id="navbarDropdown" >
					
					'.$value["categoria"].'

					</a>';

				

				$item = "id_categoria";
				$valor = $value["id"];

				$subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

				?>
				<div class="dropdown-menu subMenu" aria-labelledby="navbarDropdown">

					<?php 

						foreach ($subcategorias as $key => $value) {

						
						echo '<a class="dropdown-item" href="'.$url.$value["ruta"].'" lass="pixelSubCategorias">'.$value["subcategoria"].'</a>';

					}
						
					?>

				</div>

			</li>

		<?php endforeach?>

		<li class="nav-item">
			<a class="nav-link" href="#">OFERTAS</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="#">CONTACTANOS</a>
		</li>

	</ul>

</nav>

<!--=====================================
VENTANA MODAL PARA EL REGISTRO
======================================-->

<div class="modal fade modalFormulario" tabindex="-1" id="modalRegistro" role="dialog">

	<div class="modal-content modal-dialog">

		<div class="modal-body modalTitulo">

			<h3 class="backColor">REGISTRARSE</h3>

			<button type="button" class="close" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">&times;</span>

			</button>



			<div class="container">

				<div class="row">

					<!--=====================================
					REGISTRO FACEBOOK
					======================================-->
					<div class="col-sm-12 col-12 facebook">
						
						<p>
							<i class="fab fa-facebook-f"></i>
							Registro con Facebook
						</p>

					</div>

					<!--=====================================
					REGISTRO GOOGLE
					======================================-->
					

					<div class="col-sm-12 col-12 google">

						<a href="<?php echo $rutaGoogle; ?>">
							
							<p>
								<img src="https://img.icons8.com/color/48/000000/google-logo.png"/ style="width: 5%">
								Registro con Google 
							</p>
						</a>

					</div>
					

				</div>

			</div>

			<!--=====================================
			REGISTRO DIRECTO
			======================================-->

			<form method="post" onsubmit="return registroUsuario()">
				
			<hr>

				<div class="form-group">
					
					<div class="input-group">

						<div class="input-group-prepend">

							<span class="input-group-text"><i class="far fa-user"></i></span>
							
						</div>
						
						<input type="text" class="form-control text-uppercase" id="regUsuario" name="regUsuario" placeholder="Nombre Completo" required>
						
					</div>

				</div>


				<div class="form-group">
					
					<div class="input-group">

						<div class="input-group-prepend">

							<span class="input-group-text"><i class="far fa-envelope"></i></span>
							
						</div>
						
						<input type="email" class="form-control " id="regEmail" name="regEmail" placeholder="Correo Electrónico" required>
						
					</div>

				</div>

				<div class="form-group">
					
					<div class="input-group">

						<div class="input-group-prepend">

							<span class="input-group-text"><i class="fas fa-lock"></i></span>
							
						</div>
						
						<input type="password" class="form-control" id="regPassword" name="regPassword" placeholder="Contraseña" required>
						
					</div>

				</div>

				<!--=====================================
				https://www.iubenda.com/ CONDICIONES DE USO Y POLÍTICAS DE PRIVACIDAD
				======================================-->

				<div class="checkBox">
					
					<label>
						
						<input id="regPoliticas" type="checkbox" required>
					
							<small>
								
								Al registrarse, usted acepta nuestras condiciones de uso y políticas de privacidad

								<br>

								<a href="https://www.iubenda.com/privacy-policy/97170143" class="iubenda-black iubenda-embed" title="Privacy Policy ">Leer más</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>

							</small>

					</label>

				</div>

				<?php

					$registro = new ControladorUsuarios();
					$registro -> ctrRegistroUsuario();

				?>
				
				<input type="submit" class="btn btn-secondary backColor btn-block" value="ENVIAR">	

			</form>

		</div>
		
		<div class="modal-footer">
			
			¿Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>

		</div>

	</div>
	  
</div>





