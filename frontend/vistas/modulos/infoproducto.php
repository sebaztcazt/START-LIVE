<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

?>

<!--=====================================
BREADCRUMB INFOPRODUCTOS
======================================-->
<div class="container-fluid card ">
	
	<div class="container">
		
		<div class="row">
			
            <ul class="breadcrumb fondoBreadcrumb text-uppercase">
             
				<li class="breadcrumb-item"><a href="<?php echo $url;  ?>">INICIO</a></li>
				<li class="breadcrumb-item active pagActiva" aria-current="page"><?php echo $rutas[0] ?></li>

			</ul>

		</div>

	</div>

</div>

<!--=====================================
INFOPRODUCTOS
======================================-->
<div class="container-fluid infoproducto">
	
	<div class="container">
		
		<div class="row">

			<?php

			$item =  "ruta";
			$valor = $rutas[0];
			$infoproducto = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

			$multimedia = json_decode($infoproducto["multimedia"],true);

			/*=============================================
			VISOR DE IMÁGENES
			=============================================*/

			if($infoproducto["tipo"] == "fisico"){

				echo '<div class="col-md-5 col-sm-6 col-12 visorImg">
					
						<figure class="visor">';

						if($multimedia != null){

							for($i = 0; $i < count($multimedia); $i ++){

								echo '<img id="lupa'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'">';

							}								

							echo '</figure>

							<div class="flexslider">
							
							<ul class="slides">';

							for($i = 0; $i < count($multimedia); $i ++){

								echo '<li>
									<img value="'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'" alt="'.$infoproducto["titulo"].'">
								</li>';

							}	

						}	
													
						echo '</ul>

						</div>

					</div>';			

			}		

			?>

			<!--=====================================
			PRODUCTO
			======================================-->

			<?php

				if($infoproducto["tipo"] == "fisico"){

					echo '<div class="col-md-7 col-sm-6 col-12">';

				}

			?>

				<!--=====================================
				REGRESAR A LA TIENDA
				======================================-->

				<div class="row">

					<div class="col-6">
						
						<h6>
							
							<a href="javascript:history.back()" class="text-info">
								
								<i class="fa fa-reply"></i> Continuar Comprando

							</a>

						</h6>

					</div>

					<!--=====================================
					COMPARTIR EN REDES SOCIALES
					======================================-->
					<div class="col-4"></div>


					<div class="col-2">
						
						<h6>
							
							<a class="dropdown-toggle pull-right text-muted" data-toggle="dropdown" href="">
								
								<i class="fa fa-plus"></i> Compartir

							</a>

							<ul class="dropdown-menu pull-right compartirRedes">

								<li>
									<p class="btnFacebook">
										<i class="fab fa-facebook-f"></i>
										Facebook
									</p>
								</li>

								<li>
									<p class="btnInstagram">
										<i class="fab fa-instagram"></i>
										Instagram
									</p>
								</li>
								
							</ul>

						</h6>

					</div>
					
				</div>



				<div class="clearfix"></div>	

				<!--=====================================
				ESPACIO PARA EL PRODUCTO
				======================================-->

				<?php

					/*=============================================
					TITULO
					=============================================*/				
					
					if($infoproducto["oferta"] == 0){

						if($infoproducto["nuevo"] == 0){

							echo '<h2 class="text-muted text-uppercase">'.$infoproducto["titulo"].'</h2>';

						}else{

							echo '<h2 class="text-muted text-uppercase">'.$infoproducto["titulo"].'

							<br>

							<small>
						
								<span class="labadge badge-pill badge-warning">Nuevo</span>

							</small>

							</h2>';

						}

					}else{

						if($infoproducto["nuevo"] == 0){

							echo '<h2 class="text-muted text-uppercase">'.$infoproducto["titulo"].'

							<br>

							<small>

								<span class="labadge badge-pill badge-warning ">'.$infoproducto["descuentoOferta"].'% off</span>

							</small>
							
							</h2>';

						}else{

							echo '<h2 class="text-muted text-uppercase">'.$infoproducto["titulo"].'

							<br>

							<small>
								<span class="labadge badge-pill badge-warning">Nuevo</span> 
								<span class="labadge badge-pill badge-warning ">'.$infoproducto["descuentoOferta"].'% off</span> 


							</small>
							
							</h2>';

						}
					}

					/*=============================================
					TITULO
					=============================================*/	

					if($infoproducto["precio"] == 0){

						echo '<h2 class="text-muted">GRATIS</h2>';

					}else{

						if($infoproducto["oferta"] == 0){

							echo '<h3 class="text-muted">COP $'.$infoproducto["precio"].'</h3>';

						}else{

							echo '<h3 class="text-muted">

								<span>
								
									<strong class="oferta">COP $'.$infoproducto["precio"].'</strong>

								</span>

								<span>
									
									$'.$infoproducto["precioOferta"].'

								</span>

							</h3>';

						}

					}

					/*=============================================
					DESCRIPCIÓN
					=============================================*/		

					echo '<p>'.$infoproducto["descripcion"].'</p>';

				?>

				<!-- =====================================
				CARACTERÍSTICAS DEL PRODUCTO
				======================================-->

				<hr>

				<div class="form-group row">
					
				<?php

					if($infoproducto["detalles"] != null){

						$detalles = json_decode($infoproducto["detalles"], true);

						if($infoproducto["tipo"] == "fisico"){

							if($detalles["Talla"]!=null){

								echo '<div class="col-md-3 col-12">

									<select class="form-control seleccionarDetalle" id="seleccionarTalla">
										
										<option value="">Talla</option>';

										for($i = 0; $i <= count($detalles["Talla"]); $i++){

											echo '<option value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</option>';

										}

									echo '</select>

								</div>';

							}

							if($detalles["Color"]!=null){

								echo '<div class="col-md-3 col-12">

									<select class="form-control seleccionarDetalle" id="seleccionarColor">
										
										<option value="">Color</option>';

										for($i = 0; $i <= count($detalles["Color"]); $i++){

											echo '<option value="'.$detalles["Color"][$i].'">'.$detalles["Color"][$i].'</option>';

										}

									echo '</select>

								</div>';

							}

							if($detalles["Marca"]!=null){

								echo '<div class="col-md-3 col-12">

									<select class="form-control seleccionarDetalle" id="seleccionarMarca">
										
										<option value="">Marca</option>';

										for($i = 0; $i <= count($detalles["Marca"]); $i++){

											echo '<option value="'.$detalles["Marca"][$i].'">'.$detalles["Marca"][$i].'</option>';

										}

									echo '</select>

								</div>';

							}

						}

					}

					/*=============================================
					ENTREGA
					=============================================*/

					if($infoproducto["entrega"] == 0){

						if($infoproducto["precio"] == 0){

							echo '<h6 class="col-md-12 col-sm-0 col-0">

								<hr>

								<span class="labadge badge-pill badge-light" style="font-weight:100">

									<i class="far fa-clock" style="margin-right:5px"></i>
									Entrega inmediata | 
									<i class="fas fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventasGratis"].' inscritos |
									<i class="fas fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas

								</span>

							</h6>

							<h6 class="col-lg-0 col-md-0 col-12">

								<hr>

								<small>

									<i class="far fa-clock" style="margin-right:5px"></i>
									Entrega inmediata <br>
									<i class="fas fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventasGratis"].' inscritos <br>
									<i class="fas fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas

								</small>

							</h6>';

						}else{

							echo '<h6 class="col-md-12 col-sm-0 col-0">

								<hr>

								<span class="labadge badge-pill badge-light" style="font-weight:100">

									<i class="far fa-clock" style="margin-right:5px"></i>
									Entrega inmediata |
									<i class="fas fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventas"].' ventas |
									<i class="fas fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].' </span> personas

								</span>

							</h6>

							<h6 class="col-lg-0 col-md-0 col-12">

								<hr>

								<small>

									<i class="far fa-clock" style="margin-right:5px"></i>
									Entrega inmediata <br> 
									<i class="fas fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventas"].' ventas <br>
									<i class="fas fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas

								</small>

							</h6>';

						}

					}else{

						if($infoproducto["precio"] == 0){

							echo '<h6 class="col-md-12 col-sm-0 col-xs-0">

								<hr>

								<span class="labadge badge-pill badge-light" style="font-weight:100">
								
									<i class="far fa-clock" style="margin-right:5px"></i>
									'.$infoproducto["entrega"].' días hábiles para la entrega  |
									<i class="fas fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventasGratis"].' solicitudes  |
									<i class="fas fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas  

								</span>

							</h6>

							<h6 class="col-lg-0 col-md-0 col-xs-12">

								<hr>

								<small>
								
									<i class="far fa-clock" style="margin-right:5px"></i>
									'.$infoproducto["entrega"].' días hábiles para la entrega  <br>
									<i class="fas fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventasGratis"].' solicitudes  <br>
									<i class="fas fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].' </span> personas 

								</small>

							</h6>';

						}else{

							echo '<h6 class="col-md-12 col-sm-0 col-xs-0">

								<hr>

								<span class="labadge badge-pill badge-light" style="font-weight:100">

									<i class="far fa-clock" style="margin-right:5px"></i>
									'.$infoproducto["entrega"].' días hábiles para la entrega |
									<i class="fas fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventas"].' ventas |
									<i class="fas fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].' </span> personas

								</span>

							</h6>

							<h6 class="col-lg-0 col-md-0 col-xs-12">

								<hr>

								<small>

									<i class="far fa-clock" style="margin-right:5px"></i>
									'.$infoproducto["entrega"].' días hábiles para la entrega <br>
									<i class="fas fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventas"].' ventas <br>
									<i class="fas fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas

								</small>

							</h6>';

						}

					}				

				?>

				</div>

				<!--=====================================
				BOTONES DE COMPRA
				======================================-->

				<div class="row botonesCompra">

				<?php

					if($infoproducto["precio"]==0){

						echo '<div class="col-md-6 col-12">';

							if($infoproducto["tipo"]=="virtual"){
						
								echo '<button class="btn btn-secondary btn-block btn-lg backColor">ACCEDER AHORA</button>';

							}else{

								echo '<button class="btn btn-secondary btn-block btn-lg backColor">SOLICITAR AHORA</button>';

							}

							echo '</div>';

					}else{

						if($infoproducto["tipo"]=="virtual"){

							echo '<div class="col-md-6 col-12">
							
									<button class="btn btn-secondary btn-block btn-lg">
									<small>COMPRAR AHORA</small></button>

								</div>

								<div class="col-md-6 col-12">
									
									<button class="btn btn-secondary btn-block btn-lg backColor">

									<small>ADICIONAR AL CARRITO</small> 

									<i class="fa fa-shopping-cart col-md-0"></i>

									</button>

								</div>';
						}else{

							echo '<div class="col-lg-6 col-md-8 col-12">
									
									<button class="btn btn-secondary btn-block  backColor">

									ADICIONAR AL CARRITO 

									<i class="fa fa-shopping-cart"></i>

									</button>

								</div>';

						}

					}

				?>

				</div>

				<!--=====================================
				ZONA DE LUPA
				======================================-->

				<figure class="lupa">
						
					<img src="">

				</figure>

        	</div>

		</div>

		<!--=====================================
		COMENTARIOS
		======================================-->

		<br>

		<div class="row">
			
        	<div class="col-12">
				<ul class="nav nav-tabs " role="tablist">
					<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab11" role="tab">COMENTARIOS 22</a></li>
					<li class="nav-item"><a class="nav-link">Ver más</a></li>
					<li class="nav-item ml-auto"><a class="nav-link">PROMEDIO DE CALIFICACIÓN: 3.5 |
						
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fas fa-star-half-alt text-success"></i>
						<i class="far fa-star text-success"></i>

					</a></li>

				</ul>

				<br>

			</div>
	
		</div>

		<div class="row comentarios">

			<div class="card-group col-md-3 col-sm-6 col-12">

				<div class="card">

					<div class="card-header text-uppercase">

						Sebastian Castañeda

						<div class="float-right">

							<img class="rounded-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%">

						</div><br>

						
					</div>

					<div class="card-body">

						<small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro omnis molestias consequuntur quaerat illo aliquid, commodi iste quam laboriosam quas voluptate tempore distinctio dolore dolorem, ut, minus vitae unde optio.</small>

					</div>

					<div class="card-footer">

						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fas fa-star-half-alt text-success"></i>
						<i class="far fa-star text-success"></i>

  					</div>

				</div>

			</div>	

			<div class="card-group col-md-3 col-sm-6 col-12">

				<div class="card">

					<div class="card-header text-uppercase">

						Sebastian Castañeda

						<div class="float-right">

							<img class="rounded-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%">

						</div><br>

						
					</div>

					<div class="card-body">

						<small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro omnis molestias consequuntur quaerat illo aliquid, commodi iste quam laboriosam quas voluptate tempore distinctio dolore dolorem, ut, minus vitae unde optio.</small>

					</div>

					<div class="card-footer">

						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fas fa-star-half-alt text-success"></i>
						<i class="far fa-star text-success"></i>

  					</div>

				</div>

			</div>	

			<div class="card-group col-md-3 col-sm-6 col-12">

				<div class="card">

					<div class="card-header text-uppercase">

						Sebastian Castañeda

						<div class="float-right">

							<img class="rounded-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%">

						</div><br>

						
					</div>

					<div class="card-body">

						<small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro omnis molestias consequuntur quaerat illo aliquid, commodi iste quam laboriosam quas voluptate tempore distinctio dolore dolorem, ut, minus vitae unde optio.</small>

					</div>

					<div class="card-footer">

						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fas fa-star-half-alt text-success"></i>
						<i class="far fa-star text-success"></i>

  					</div>

				</div>

			</div>	

			<div class="card-group col-md-3 col-sm-6 col-12">

				<div class="card">

					<div class="card-header text-uppercase">

						Sebastian Castañeda

						<div class="float-right">

							<img class="rounded-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%">

						</div><br>

						
					</div>

					<div class="card-body">

						<small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro omnis molestias consequuntur quaerat illo aliquid, commodi iste quam laboriosam quas voluptate tempore distinctio dolore dolorem, ut, minus vitae unde optio.</small>

					</div>

					<div class="card-footer">

						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fas fa-star-half-alt text-success"></i>
						<i class="far fa-star text-success"></i>

  					</div>

				</div>

			</div>				

		</div>

		<hr>
		
	</div>

</div>

<!--=====================================
ARTÏCULOS RELACIONADOS
======================================-->

<div class="container-fluid productos">
	
	<div class="container">

		<div class="row">

			<div class="col-12 tituloDestacado">

				<div class="row">
				
					<div class="col-sm-6 col-12">
				
						<h2><small>PRODUCTOS RELACIONADOS</small></h2>
						

					</div>
					
					<div class="col-sm-6 col-lg-6" id="verMas">

					<?php

						$item = "id";
						$valor = $infoproducto["id_subcategoria"];

						$rutaArticulosDestacados = ControladorProductos::ctrMostrarSubcategorias($item, $valor);
				
						echo '<a href="'.$url.$rutaArticulosDestacados[0]["ruta"].'">
					
							<button class="btn btn-light backColor float-right">
						
								VER MÁS <span class="fa fa-chevron-right"></span>

							</button>

						</a>';

					?>	

					</div>
					
					<div class="clearfix"></div>

					<hr>
					
				</div>

				<hr>
					
			</div>
					
		</div>

		<?php

			$ordenar = "";
			$item = "id_subcategoria";
			$valor = $infoproducto["id_subcategoria"];
			$base = 0;
			$tope = 4;
			$modo = "Rand()";

			$relacionados = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

			if(!$relacionados){

				echo '<div class="col-12 error404">

					<h1><small>¡Oops!</small></h1>

					<h2>No hay productos relacionados</h2>

				</div>';

			}else {
				
				echo '<div class="row grid'.$i.' ulNoOrdenada">';

				foreach ($relacionados as $key => $value) {
					
				echo '<div class="col-sm-3 liItem">

						<figure>
							
							<a href="'.$url.$value["ruta"].'" class="pixelProducto">
								
								<img src="'.$servidor.$value["portada"].'" class="img-fluid">

							</a>

						</figure>
						
						<h6>
				
							<small>
								
								<a href="'.$url.$value["ruta"].'" class="pixelProducto">
									
									'.$value["titulo"].'<br>
									
									<span style="color:rgba(0,0,0,0)">-</span>';

									if ($value["nuevo"] != 0) {
										
										echo '<span class="labadge badge-pill badge-warning fontSize">Nuevo</span>';

									}
									if ($value["oferta"] != 0) {

										echo '<span class="labadge badge-pill badge-warning fontSize">'.$value["descuentoOferta"].'% off</span>';

									}

								echo '</a>

							</small>			

						</h6>
						
						<div class="col-6 precio">';
				
						if($value["oferta"] != 0){

							echo '<h2>

									<small>
				
										<strong class="oferta">COP $'.$value["precio"].'</strong>

									</small>

									<small>$'.$value["precioOferta"].'</small>
								
								</h2>';

						}else{

							echo '<h2><small>COP $'.$value["precio"].'</small></h2>';

						}

						echo  '</div>
						
						<div class="col-12 enlaces">
				
							<div class="btn-group float-right" role="group">
								
								<button type="button" class="btn btn-outline-secondary btn-sm deseos" idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">
									
									<i class="fa fa-heart" ></i>

								</button>

								<a href="'.$url.$value["ruta"].'" class="pixelProducto">
								
									<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Ver producto">
										
										<i class="fa fa-eye" aria-hidden="true"></i>

									</button>	
								
								</a>

							</div>

						</div>
					
					</div>';

				}

				echo '</div>';

			}

		?>

	</div>

</div>