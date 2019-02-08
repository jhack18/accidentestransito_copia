<?php
require_once 'app/models/Bitacora.php';
use Exception;
class BitacoraController{
    private $bitacora;
    public function __construct(){
        $this->bitacora = new Bitacora();
    }
    public function mostrar() {
        $model = $this->bitacora->listar();
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'bitacora/mostrar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
}