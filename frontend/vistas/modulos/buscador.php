<!--=====================================
BARRA PRODUCTOS
======================================-->

<div class="container-fluid card barraProductos">

    <div class="container">
        
        <div class="row">

            <div class="col-ms-6">
        
                <div class="btn-group float-right" role="group">
                
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">

                        Ordenar Productos

                    </button>

                    <div class="dropdown-menu">

                        <?php

                            echo '<a class="dropdown-item" href="'.$url.$rutas[0].'/1/recientes/'.$rutas[3].'">Más reciente</a>
                            <a class="dropdown-item" href="'.$url.$rutas[0].'/1/antiguos/'.$rutas[3].'">Más antiguo</a>';

                        ?>
                    </div>


                </div>

            </div>

            <div class="col-sm-10 organizarProductos">

                <div class="btn-group float-right" role="group">

                    <button type="button" class="btn btn-light btn-sm btnGrid" id="btnGrid0">
                        
                        <i class="fas fa-th" aria-hidden="true"></i>  

                        <span class="col-0 float-right"> Cuadricula</span>

                    </button>

                    <button type="button" class="btn btn-light btn-sm btnList" id="btnList0">
                        
                        <i class="fas fa-list" aria-hidden="true"></i> 

                        <span class="col-0 float-right">Lista</span>

                    </button>
                    
                </div>		

            </div>

        </div>

    </div>

</div>
<br>

<!--=====================================
LISTAR PRODUCTOS
======================================-->

<div class="container-fluid productos">

	<div class="container">
		
		<div class="row">

        	<!--=====================================
			BREADCRUMB O MIGAS DE PAN
			======================================-->
			
			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				<li class="breadcrumb-item"><a href="<?php echo $url;  ?>">INICIO</a></li>
				<li class="breadcrumb-item active pagActiva" aria-current="page"><?php echo $rutas[0] ?></li>
			</ul>
			


            <?php

			/*=============================================
			LLAMADO DE PAGINACIÓN
			=============================================*/

			if(isset($rutas[1])){

				if(isset($rutas[2])){

					if($rutas[2] == "antiguos"){

						$modo = "ASC";
						$_SESSION["ordenar"] = "ASC";

					}else{

						$modo = "DESC";
						$_SESSION["ordenar"] = "DESC";

					}

				}else{

					if (isset($_SESSION["ordenar"])) {

						$modo = $_SESSION["ordenar"];

					}else {
						
						$modo = "DESC";

					}

				}

				$base = ($rutas[1] - 1)*12;
				$tope = 12;

			}else{

				$rutas[1] = 1;
				$base = 0;
				$tope = 12;
				$modo = "DESC";
				$_SESSION["ordenar"] = "DESC";
 

			}

			/*=============================================
			LLAMADO DE PRODUCTOS POR BÚSQUEDA
			=============================================*/

			$productos = null;
            $listaProductos = null;

            $ordenar = "id";

			if(isset($rutas[3])){

				$busqueda = $rutas[3];

				$productos = ControladorProductos::ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope);
                $listaProductos = ControladorProductos::ctrListarProductosBusqueda($busqueda);

			}
			
            
            if(!$productos){

				echo '<div class="col-12 error404 text-center">

						 <h1><small>¡Oops!</small></h1>

						 <h2>Aún no hay productos en esta sección</h2>

					</div>';

			}else{

                echo '<div class="row grid0 ulNoOrdenada">';

                foreach ($productos as $key => $value) {
					
					echo '<div class="col-sm-3 liItem">
				
							<figure>
								
								<a href="'.$value["ruta"].'" class="pixelProducto">
									
									<img src="'.$servidor.$value["portada"].'" class="img-fluid">
			
								</a>
			
							</figure>

							'.$value["id"].'
							
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
                

				<div class="row list0 ulNoOrdenada" style="display: none;" >';

				foreach ($productos as $key => $value) {

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
	
				echo '</div>';
				

            }

            ?>

			<div class="clearfix"></div>

			

			<!--=====================================
			PAGINACIÓN
			======================================-->

			<?php

				if(count($listaProductos) != 0){

					$pagProductos = ceil(count($listaProductos)/12);

					if($pagProductos > 4){

						/*=============================================
						LOS BOTONES DE LAS PRIMERAS 4 PÁGINAS Y LA ÚLTIMA PÁG
						=============================================*/

						if($rutas[1] == 1){

							echo '
							<div class="container">
							
								<ul class="pagination justify-content-center">';
							
								for($i = 1; $i <= 4; $i ++){
										

									echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

								}

								echo ' 
									<li class="page-item disabled"><a class="page-link" href="#">...</a></li>
									<li class="page-item" id="item'.$pagProductos.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>
									<li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/2/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

								</ul>
							
							</div>';

						}

						/*=============================================
						LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ABAJO
						=============================================*/

						else if($rutas[1] != $pagProductos && 
								$rutas[1] != 1 &&
								$rutas[1] <  ($pagProductos/2) &&
								$rutas[1] < ($pagProductos-3)){

							$numPagActual = $rutas[1];

							echo '
							<div class="container">
								
								<ul class="pagination justify-content-center">

									<li class="page-item"><a class="page-link"href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> ';
						
									for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){

									echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href=href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

									}

									echo ' 
									<li class="page-item disabled"><a class="page-link" href="#">...</a></li>
									<li class="page-item" id="item'.$pagProductos.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>
									<li class="page-item"><a class="page-link"href="'.$url.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

								</ul>
								
							</div>';

						}

						/*=============================================
						LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ARRIBA
						=============================================*/

						else if($rutas[1] != $pagProductos && 
								$rutas[1] != 1 &&
								$rutas[1] >=  ($pagProductos/2) &&
								$rutas[1] < ($pagProductos-3)){

							$numPagActual = $rutas[1];
					
							echo '
								<div class="container">
								
									<ul class="pagination justify-content-center">

										<li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 
										<li class="page-item" id="item1"><a  class="page-link" href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
										<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
						
										for($i = $numPagActual; $i <= ($numPagActual+3); $i ++){

											echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

										}


										echo '  <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

									</ul>

								</div>';
						}

						/*=============================================
						LOS BOTONES DE LAS ÚLTIMAS 4 PÁGINAS Y LA PRIMERA PÁG
						=============================================*/

						else{

							$numPagActual = $rutas[1];

							echo '
								<div class="container">
								
									<ul class="pagination justify-content-center">

								   		<li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> 
								   		<li class="page-item" id="item1"><a class="page-link" href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
								   		<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
							
										for($i = ($pagProductos-3); $i <= $pagProductos; $i ++){

											echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

										}

								echo ' 
									</ul>

								</div>';

						}
						
					}else{

						echo '
						
						<div class="container">
							
								<ul class="pagination justify-content-center">';
						
								for($i = 1; $i <= $pagProductos; $i ++){

									echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

						}

						echo '</ul>
							
						</div>';

					}

				}

			?>


			

        </div>

    </div>

</div>