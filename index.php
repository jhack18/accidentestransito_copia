<?php
// Errores de PHP a Try/Catch
function exception_error_handler($severidad, $mensaje, $fichero, $línea) {
    if (!(error_reporting() & $severidad)) {
        // Este código de error no está incluido en error_reporting
        return;
    }
    //throw new ErrorException($mensaje, 0, $severidad, $fichero, $línea);
}

set_error_handler("exception_error_handler");
session_start();

//Importamos el modelo de la bitacora
require_once 'app/models/Bitacora.php';
$bitacora = new Bitacora();



// path
define('_VIEW_PATH_', 'app/views/');


require 'autoload.php';

if(isset($_SESSION['id']) || $_GET['a'] == "datosmapa" || $_GET['a'] == "registrarse" || $_GET['a'] == "guardar"){
    $accion = $_GET['a'] ?? '';
        if ($accion == 'login'){
            //header('Location : index.php?c=Admin&a=index');
            // Router
            $c = sprintf(
                '%sController',
                'Admin'
            );

            $a = 'index';

            $c = trim(ucfirst($c));
            $a = trim(strtolower($a));

            $controller = new $c;
            $controller->$a();
            $bitacora->guardar('Acceso a ' . $cv . '/' . $a,'Acceso Vista');

        } else {
            // Router
            $c = sprintf(
                '%sController',
                $_GET['c'] ?? 'Mapa'
            );

            $cv = $_GET['c'] ?? 'Mapa';

            $a = $_GET['a'] ?? 'index';

            $c = trim(ucfirst($c));
            $a = trim(strtolower($a));

            try{
                $controller = new $c;
                $controller->$a();
                $bitacora->guardar('Acceso a ' . $cv . '/' . $a,'Acceso Vista');
            } catch (\Throwable $e){
                // Router
                $c = sprintf(
                    '%sController',
                    'Error'
                );
                $a = 'error';
                $c = trim(ucfirst($c));
                $a = trim(strtolower($a));
                $controller = new $c;
                $controller->$a();
            }
        }


} else {
    $accion = $_GET['a'] ?? '';

    if ($accion == 'loguearse'){
        $c = sprintf(
            '%sController',
            'Admin'
        );

        $a = 'loguearse';

        $c = trim(ucfirst($c));
        $a = trim(strtolower($a));

        $controller = new $c;
        $controller->$a();
        $bitacora->guardar('Acceso a ' . $cv . '/' . $a,'Acceso Vista');
    } else {
        switch ($accion){
            case 'login':
                $c = sprintf(
                    '%sController',
                    'Admin'
                );

                $a = 'login';

                $c = trim(ucfirst($c));
                $a = trim(strtolower($a));

                $controller = new $c;
                $controller->$a();
                $bitacora->guardar('Acceso a ' . $cv . '/' . $a,'Acceso Vista');
                break;
            default:
                $c = sprintf(
                    '%sController',
                    'Mapa'
                );

                $a = 'index';

                $c = trim(ucfirst($c));
                $a = trim(strtolower($a));

                $controller = new $c;
                $controller->$a();
                $bitacora->guardar('Acceso a ' . $cv . '/' . $a,'Acceso Vista');
                break;
        }
    }
}



