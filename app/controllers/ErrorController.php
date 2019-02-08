<?php
require_once 'app/models/Bitacora.php';
use Exception;
class ErrorController{
    private $bitacora;

    public function __construct(){
        $this->bitacora = new Bitacora();
    }

    public function error(){
        $this->bitacora->guardar('Se Produjo Un Error en los Controladores del Sistema','Falla Sistema');
        require _VIEW_PATH_ . 'error/error.php';
    }
}