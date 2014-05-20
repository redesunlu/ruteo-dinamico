<?php
    
    $hora = date('l jS \of F Y h:i:s A');
    
    if ( isset( $_GET["usuario"] ) ) {
        
        $user = strtoupper($_GET["usuario"]);
        $pass = strtoupper($_GET["contrasena"]);
        
        $html = "Usuario: $user | Contraseña: $pass <br />Hora: $hora<br /><a href='index_get.html'>Volver</a>";
        
    }
    
    if ( isset( $_POST["usuario"] ) ) {
        
        $user = strtoupper($_POST["usuario"]);
        $pass = strtoupper($_POST["contrasena"]);
        
        $html = "Usuario: $user | Contraseña: $pass <br />Hora: $hora<br /><a href='index_post.html'>Volver</a>";
        
    }
    
    echo $html;
    
?>
