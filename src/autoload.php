
<?php

spl_autoload_register(
    function( $class_name )
    {
        if ( false !== strpos( $class_name, 'Development\\' ) )
        {
            var_dump( __DIR__ . '/' . str_replace( 'Development\\', '', $class_name ) . '.php' );
            include __DIR__ . '/' . str_replace( 'Development\\', '', $class_name ) . '.php';
        }
    }
);
/*
define('__ROOT__AUTOLOAD__', __DIR__);

function __autoload($clase){



    $clase = str_replace( "development\\", "/", $clase );

    $ruta =  __ROOT__AUTOLOAD__ .$clase.".php";


    if (file_exists($ruta)){
        include_once $ruta;
    }

}*/

