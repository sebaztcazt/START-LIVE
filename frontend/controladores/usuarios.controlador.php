<?php

class ControladorUsuarios{

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	public function ctrRegistroUsuario(){

		if(isset($_POST["regUsuario"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){

			   	$encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			   	$encriptarEmail = md5($_POST["regEmail"]);

				$datos = array("nombre"=>$_POST["regUsuario"],
							   "password"=> $encriptar,
							   "email"=> $_POST["regEmail"],
							   "foto"=>"",
							   "modo"=> "directo",
							   "verificacion"=> 1,
							   "emailEncriptado"=>$encriptarEmail);

				$tabla = "usuarios";

				$respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

				if($respuesta == "ok"){

					/*=============================================
					VERIFICACIÓN CORREO ELECTRÓNICO
					=============================================*/

					date_default_timezone_set("America/Bogota");

					$url = Ruta::ctrRuta();	

					$mail = new PHPMailer;

					$mail->CharSet = 'UTF-8';

					$mail->isMail();

					$mail->setFrom('aguirresebastian89@gmail.com', 'Sebastian Aguirre');

					$mail->addReplyTo('aguirresebastian89@gmail.com', 'Sebastian Aguirre');

					$mail->Subject = "Por favor verifique su dirección de correo electrónico";

					$mail->addAddress($_POST["regEmail"]);

					$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
                                        <center>
                                            
                                            <img style="padding:20px; width:10%" src="https://www.hd-tecnologia.com/imagenes/articulos/2017/04/Netflix-le-dice-chau-a-las-estrellas-ahora-votaran-pulgar-arriba-o-abajo.jpg">
                                    
                                        </center>
                                    
                                        <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                                        
                                            <center>
                                            
                                            <img style="padding:20px; width:15%" src="https://images.vexels.com/media/users/3/140131/isolated/preview/cc86a9f4ca65a140b2edadf3f87f2c17-dise--o-de-icono-de-c--rculo-de-correo-electr--nico-by-vexels.png">
                                    
                                            <h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>
                                    
                                            <hr style="border:1px solid #ccc; width:80%">
                                    
                                            <h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta en START LIVE, debe confirmar su dirección de correo electrónico</h4>
                                    
                                            <a href="'.$url.'verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration:none">
                                    
                                            <div style="line-height:60px; background:#c61212; width:60%; color:white">Verifique su dirección de correo electrónico</div>
                                    
                                            </a>
                                    
                                            <br>
                                    
                                            <hr style="border:1px solid #ccc; width:80%">
                                    
                                            <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
                                    
                                            </center>
                                    
                                        </div>
                                    
                                    </div>');

					$envio = $mail->Send();

					if(!$envio){

						echo '<script> 

                            Swal.fire({
                                icon: "error",
								title: "¡ERROR!",
								text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["regEmail"].$mail->ErrorInfo.'!",
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
                                })
                    
                                .then((isConfirm) => {
                                    if (isConfirm) {
                                        history.back();
                                    } 
                                });

                        </script>';
                        
                        

					}else{

						echo '<script> 

                            Swal.fire({
                                icon: "success",
								title: "¡OK!",
								text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["regEmail"].' para verificar la cuenta!",
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
                                })
                    
                            .then((isConfirm) => {
                                if (isConfirm) {
                                    history.back();
                                } 
                            });

						</script>';

					}

				}

			}else{

				echo '<script> 

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "¡Error al registrar el usuario, no se permiten caracteres especiales!",
                        confirmButtonText: "Cerrar",
						closeOnConfirm: false
                    })
                    
                    .then((isConfirm) => {
                        if (isConfirm) {
                            history.back();
                        } 
                    });

                </script>';

			}

		}

    }

    /*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuario($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function ctrActualizarUsuario($id, $item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

		return $respuesta;

	}

}