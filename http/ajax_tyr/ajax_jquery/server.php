<?php
    
    // Respuesta a todas las consultas
    echo date('h:i:s D M Y');
    echo " - Hora del servidor<br />";
    
    // Respuesta para index_get.html
    if ( isset( $_GET['parametro'] ) ) {
        
        echo "Me enviaste lo siguiente: <br />";
        echo $_GET['parametro'];
        
    }
    
    // Respuesta para index_post.html
    if ( isset($_POST['envio_post']) ) {
        
        echo "Via POST me llego: ";
        echo $_POST['data'];
        
    }

?>
