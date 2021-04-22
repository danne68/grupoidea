<?php
	$nombre		=	$_POST['name'];
	$email		=	$_POST['email'];
	$mensaje	=	$_POST['message'];
	
	// Definir el correo de destino:
	$para 	=	"contactenos@grupoideacancun.com";
	$oculto =	"dannel.solis@gmail.com";
	
	// Estas son cabeceras que se usan para evitar que el correo llegue a SPAM:
	$headers = "From: ".$nombre."<".$email.">\r\n"; //persona que lo envia
	$headers .= "BCC: ".$oculto."\r\n"; //correo oculto
	//$headers .= "X-Sender: <".$sfrom.">\n";
	$headers .= 'X-Sender-IP: '.$_SERVER['REMOTE_ADDR']."\n";
	$headers .= "Reply-To: Grupo Idea<".$para.">\n"; //responder a este correo
	
	//$encabezados .= "BCC: <$sBCC>\n"; //aqui fijo el BCC
	
	$headers .= "X-Mailer: PHP/". phpversion()."\n";
	$headers .= 'MIME-Version: 1.0' . "\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Aqui definimos el asunto y armamos el cuerpo del mensaje
	$asunto = 'Grupo Idea Cancun - Mensaje de contacto';
	
    $cuerpo .= "<div style='border-bottom: solid 5px #f56a6a;padding: 1em 0 1em 0;position: relative;'>";
	$cuerpo .= 	"<img style='width:130px;' src='http://grupoideacancun.com/images/logo.png'>";
	$cuerpo .= "</div>";
	$cuerpo .= "<div style='display: block;border-top: 0 !important;padding: 0 4em 0.1em 4em;margin: 0 auto;max-width: 110em;font-size: 10pt;color: #7f888f;font-family: &quot;Open Sans&quot;, sans-serif;font-weight: 400;line-height: 1.65;'>";
	$cuerpo .= 	"<h2 style='font-size: 1.75em;color: #3d4449;font-family: &quot;Roboto Slab&quot;, serif;font-weight: 700;line-height: 1.5;margin: 0 0 1em 0;'>Información de contacto</h2>";
	$cuerpo .= 	"<div style='width: 100%;clear: none;margin-left: 0;box-sizing: border-box;float: left;padding: 0 0 0 3em;'>";
	$cuerpo .= 		"<dl style='margin: 0 0 2em 0;'>";
	$cuerpo .= 			"<dt style='display: block;font-weight: 600;margin: 0 0 1em 0;'>Nombre</dt>";
	$cuerpo .= 			"<dd style='margin-left: 2em;'>";
	$cuerpo .= 				"<p style='margin: 0 0 2em 0;'>$nombre</p>";
	$cuerpo .= 			"</dd>";
	$cuerpo .= 			"<dt style='display: block;font-weight: 600;margin: 0 0 1em 0;'>Correo</dt>";
	$cuerpo .= 			"<dd style='margin-left: 2em;'>";
	$cuerpo .= 				"<p style='margin: 0 0 2em 0;'>$email</p>";
	$cuerpo .= 			"</dd>";
	$cuerpo .= 			"<dt style='display: block;font-weight: 600;margin: 0 0 1em 0;'>Mensaje</dt>";
	$cuerpo .= 			"<dd style='margin-left: 2em;'>";
	$cuerpo .= 				"<p style='margin: 0 0 2em 0;'>$mensaje</p>";
	$cuerpo .= 			"</dd>";
	$cuerpo .= 		"</dl>";
	$cuerpo .= 	"</div>";
	$cuerpo .= "</div>";
	
	mail($para,$asunto,$cuerpo,$headers);
	
	echo "Mensaje enviado";
?>