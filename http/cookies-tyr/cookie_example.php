<?php
/*
 * cookies_example.php
 * 
 * Ejemplo sobre uso de cookies
 * 
 * 10040 - Teleinformática y Redes
 * Universidad Nacional de Luján
 */

/*
 * La supervariable $_COOKIE es un array asociativo que contiene
 * todas las cookies creadas para este sitio. Así, primero verificamos
 * si el usuario dispone ya de la cookie. Si es así, imprimimos el valor,
 * caso contrario, creamos la cookie.
 * 
 * Más información sobre $_COOKIE: http://php.net/manual/en/reserved.variables.cookies.php
 */
if(isset($_COOKIE["cookieTyR"])){
	// El usuario ya posee almacenada la cookie, imprimimos su valor
	print "<p>Tu cookie almacena el siguiente valor: <b>{$_COOKIE['cookieTyR']}</b></p>";
	print "<p><b>Recuerda borrar las cookies antes de volver a ejecutar de nuevo el ejemplo.</b></p>";
}
else
{
	// Verificamos que el usuario introdujo  algún valor en la casilla de texto
	if(isset($_GET['param']) && strlen($_GET['param'])>0){
		/*
		 * Creamos la cookie con el nombre 'cookieTyR' y almacenamos
		 * el parámetro recibido. Establecemos como tiempo de expiración
		 * una hora, a partir de la recepeción de la misma.
		 * 
		 * 	Más información sobre setcookie: http://php.net/manual/es/function.setcookie.php
		 */
		$result = setcookie("cookieTyR",$_GET["param"],time()+3600);
		
		// Verificamos que se pudo establecer la cookie y mostramos instrucciones
		if($result){
			print  <<<HTML
			<p><b>La cookie fue almacenada exitosamente</b></p>
			<p>Puedes verificarlo:</p>
			<ul>
				<li>
					<b>En Firefox:</b> en las preferencias, en la solapa 'Privacidad', haciendo click en 'Mostrar cookies'.
				</li>
				<li>
					<b>En Chrome:</b> en la configuraci&oacute;n, haz click en 'Mostrar opciones avanzadas', luego en 'Configuraci&oacute;n de contenido' y por &uacute;ltimo en 'Todas las cookies y los datos de sitios...'.
				</li>
			</ul>
			<p><a href='#' onclick='javascript:window.location.reload(false);'>Recuperar contenido de la cookie</a></p>			
HTML;
		}else{
			print "<p>Ocurri&oacute un error al alamcenar la cookie.</p><a onclick='javascript:history.back(1)'>Atr&aacute;s</a>";
		}
	}else{
		print "<p>Por favor, introduce alg&uacute;n valor para ser almacenado en la cookie.</p><a href='#' onclick='javascript:history.back(1)'>Atr&aacute;s</a>";
	}
}
?>