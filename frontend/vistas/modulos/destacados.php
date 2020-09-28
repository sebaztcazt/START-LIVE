<!--=====================================
BANNER
======================================-->

<?php

$servidor = Ruta::ctrRutaServidor();

$ruta = "sin-categoria";

$banner = ControladorProductos::ctrMostrarBanner($ruta);

$titulo1 = json_decode($banner["titulo1"],true);
$titulo2 = json_decode($banner["titulo2"],true);
$titulo3 = json_decode($banner["titulo3"],true);

if($banner != null){

echo '<figure class="banner">

		<img src="'.$servidor.$banner["img"].'" class="img-responsive" width="100%">	

		<div class="textoBanner '.$banner["estilo"].'">
			
			<h1 style="color:'.$titulo1["color"].'">'.$titulo1["texto"].'</h1>

			<h2 style="color:'.$titulo2["color"].'"><strong>'.$titulo2["texto"].'</strong></h2>

			<h3 style="color:'.$titulo3["color"].'">'.$titulo3["texto"].'</h3>

		</div>

	</figure>';

}

$titulosModulos = array("ARTÍCULOS NUEVOS", "LO MÁS VENDIDO", "LO MÁS VISTO");
$rutaModulos = array("articulos-nuevos","lo-mas-vendido","lo-mas-visto");

$base = 0;
$tope = 4;

if($titulosModulos[0] == "ARTÍCULOS NUEVOS"){

$ordenar = "fecha";
$item = null;
$valor = null;
$modo = "DESC";

$nuevos = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

if($titulosModulos[1] == "LO MÁS VENDIDO"){

$ordenar = "ventas";
$item = null;
$valor = null;
$modo = "DESC";

$ventas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

if($titulosModulos[2] == "LO MÁS VISTO"){

$ordenar = "vistas";
$item = null;
$valor = null;
$modo = "DESC";

$vistas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

$modulos = array($nuevos, $ventas, $vistas);


for($i = 0; $i < count($titulosModulos); $i ++) {

	/*=====================================
	BARRA PRODUCTOS 
	======================================*/


	echo '<div class="container-fluid card barraProductos">

			<div class="container">
				
				<div class="row">
					
					<div class="col-xl-12 col-lg-12 organizarProductos">

						<div class="btn-group float-right" role="group">

							 <button type="button" class="btn btn-light btn-sm btnGrid" id="btnGrid'.$i.'">
							 	
								<i class="fas fa-th" aria-hidden="true"></i>  

								<span class="col-0 float-right"> Cuadricula</span>

							 </button>

							 <button type="button" class="btn btn-light btn-sm btnList" id="btnList'.$i.'">
							 	
								<i class="fas fa-list" aria-hidden="true"></i> 

								<span class="col-0 float-right">Lista</span>

							 </button>
							
						</div>		

					</div>

				</div>

			</div>

		</div>
		

		<div class="container-fluid productos">
	
			<div class="container">
		
				<div class="row">
			
					<div class="col-12 tituloDestacado">

						<div class="row">
						
							<div class="col-sm-6 col-12">
						
								<h2><small>'.$titulosModulos[$i].'</small></h2>
								

							</div>
							
							<div class="col-sm-6 col-lg-6" id="verMas">
						
								<a href="'.$rutaModulos[$i].'">
							
									<button class="btn btn-light backColor float-right">
								
										VER MÁS <span class="fa fa-chevron-right"></span>

									</button>

								</a>

							</div>
							
							<div class="clearfix"></div>

							<hr>
							
						</div>
							
					</div>
							
				</div>

				<div class="row grid'.$i.' ulNoOrdenada">';

				foreach ($modulos[$i] as $key => $value) {
					
					echo '<div class="col-sm-3 liItem">
				
							<figure>
								
								<a href="'.$value["ruta"].'" class="pixelProducto">
									
									<img src="'.$servidor.$value["portada"].'" class="img-fluid">
			
								</a>
			
							</figure>
							
							<h6>
					
								<small>
									
									<a href="'.$value["ruta"].'" class="pixelProducto">
										
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
		
								<a href="'.$value["ruta"].'" class="pixelProducto">
								
									<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Ver producto">
										
										<i class="fa fa-eye" aria-hidden="true"></i>
		
									</button>	
								
								</a>
		
							</div>
		
						</div>
						
					</div>';

				}

				echo '</div>

				<div class="row list'.$i.' ulNoOrdenada" style="display: none;" >';

				foreach ($modulos[$i] as $key => $value) {

					echo '<div class="col-12 liItem">
		
						<div class="row">
		
							<div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12">
							
								<figure>
								
									<a href="'.$value["ruta"].'" class="pixelProducto">
		
										<img src="'.$servidor.$value["portada"].'" class="img-fluid">
		
									</a>
		
								</figure>		
		
							</div>
		
							<!--===============================================-->
							
							<div class="col-xl-10 col-lg-10 col-md-9 col-sm-8 col-xs-12">
		
								<h1>
		
									<small>
		
										<a href="'.$value["ruta"].'" class="pixelProducto">
		
											'.$value["titulo"].'';

											if ($value["nuevo"] != 0) {
											
												echo '<span class="labadge badge-pill badge-warning">Nuevo</span>';
	
											}
											if ($value["oferta"] != 0) {
	
												echo '<span class="labadge badge-pill badge-warning ">'.$value["descuentoOferta"].' off</span>';
	
											}
		
										echo '</a>
		
									</small>
		
								</h1>
		
								<p class="text-muted">'.$value["titular"].'</p>';

								if($value["oferta"] != 0){

									echo '<h2>
	
											<small>
						
												<strong class="oferta">COP $'.$value["precio"].'</strong>
	
											</small>
	
											<small>$'.$value["precioOferta"].'</small>
										
										</h2>
										<br>
										<br>
										<br>';
	
								}else{
	
									echo '<h2><small>COP $'.$value["precio"].'</small></h2>
									<br>
									<br>
									<br>';
	
								}

								echo '<div class="btn-group float-left enlaces" role="group">
	
									<button type="button" class="btn btn-outline-secondary btn-sm deseos"  idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">
		
										<i class="fa fa-heart" aria-hidden="true"></i>
		
									</button>
		
									<a href="'.$value["ruta"].'" class="pixelProducto">
		
										<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Ver producto">
		
											<i class="fa fa-eye" aria-hidden="true"></i>
		
										</button>
		
									</a>
									
								</div>
								
							
							</div>
		
						</div>
		
						<div class="col-xs-12">
		
							<hr>
		
						</div>
		
		
					</div>';

				}
	
				echo '</div>
				
			</div>
			
		</div>';

}

?>



    	