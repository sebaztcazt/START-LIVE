<!--=====================================
SLIDESHOW  
======================================-->

<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

  	<!--=====================================
	PAGINACION
	======================================-->

	<ul class="carousel-indicators">

  	<?php

		$servidor = Ruta::ctrRutaServidor();

		$slide = ControladorSlide::ctrMostrarSlide();
	
		
		foreach ($slide as $key => $value) :
			if ($key == 0) {
				$claseActive = "active";
			} else {
				$claseActive = "";
			}	
  	?>
    <li data-target="#carouselExampleCaptions" data-slide-to="<?= $key ?>" class="<?= $claseActive?>"></li>

    	<?php endforeach?>
  	</ul>


  	<!--=====================================
	DIAPOSITIVAS
	======================================-->
	<div class="carousel-inner">

		<?php

		foreach ($slide as $key => $value) :

			if ($key == 0) {
				$claseActive = "active";
			} else {
				$claseActive = "";
			}

			$titulo1 = json_decode($value["titulo1"], true);
			$titulo2 = json_decode($value["titulo2"], true);
			$titulo3 = json_decode($value["titulo3"], true);	

		?>

    	<div class="carousel-item <?= $claseActive?>">

    		<img src="<?=$servidor.$value['imgFondo']?>" class="d-block w-100" >

      		<div class="carousel-caption d-none d-block <?= $value["tipoSlide"]?>">

        		<h2 style="	color:<?= $titulo1["color"]?>;"><?= $titulo1["texto"]?></h2>
        		<h3 style="	color:<?= $titulo2["color"]?>;"><?= $titulo2["texto"]?></h3>
        		<h4 style="	color:<?= $titulo3["color"]?>;"><?= $titulo3["texto"]?></h4>
            	<a href="<?= $value["url"]?>">
            		<?= $value["boton"]?>
            	</a>

      		</div>
    	</div>

		<?php endforeach?>

  	</div>

  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>
</div>