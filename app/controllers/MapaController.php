<?php
require_once 'app/models/Bitacora.php';
require_once 'app/models/Accidente.php';
require_once 'app/models/CausaAccidente.php';
require_once 'app/models/Rol.php';
use Exception;
class MapaController{
    private $bitacora;
    private $accidente;
    private $causaaccidente;
    private $rol;
    public function __construct(){
        $this->accidente = new Accidente();
        $this->bitacora = new Bitacora();
        $this->causaaccidente = new CausaAccidente();
        $this->rol = new Rol();
    }
    public function index() {
        $accidentes = $this->accidente->listar();
        $causas = $this->causaaccidente->listar();
        require_once _VIEW_PATH_ . 'mapa/index.php';
        //$registrar_bitacora = $this->bitacora->guardar('Acceso a Mapa/index');
    }

    public function registrarse() {
        $roles = $this->rol->listar();
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'mapa/agregar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }


}