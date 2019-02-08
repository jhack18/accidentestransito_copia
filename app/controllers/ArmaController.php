<?php
require 'app/models/Arma.php';
require_once 'app/models/Bitacora.php';
use Exception;
class ArmaController{
    private $arma;
    private $bitacora;
    public function __construct(){
        $this->bitacora = new Bitacora();
        $this->arma = new arma();
    }

    public function mostrar() {
        $model = $this->arma->listar();

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'arma/mostrar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function agregar() {

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'arma/agregar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function guardar() {
        $model = new Arma();
        $model->id = $_POST['id'];
        $model->nombre = $_POST['nombre'];
        $model->descripcion = $_POST['descripcion'];


        $result = $this->arma->guardar($model);

        if($result !== 1) {
            $this->bitacora->guardar('Fallo Al Guardar Nueva Arma','Falla Sistema');
        } else {
            if($model->id){
                $this->bitacora->guardar('Edicion Arma con ID: ' . $model->id,'Edicion');
                echo 1;
            } else {
                $this->bitacora->guardar('Nueva Arma con ID: ' . $model->id,'Guardar');
                echo 1;
            }

        }
    }

    public function editar() {
        $id_arma = $_GET['id'];
        $arma = $this->arma->obtener($id_arma);

        //var_dump($usuario);
        //exit;
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'arma/editar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function eliminar() {
        $id = $_POST['id'];

        $result = $this->arma->eliminar($id);

        if(!$result) {
            $this->bitacora->guardar('Fallo Al Eliminar Arma Con ID: ' . $id,'Fallo Sistema');
        } else {
            $this->bitacora->guardar('Arma Eliminada Con ID: ' . $id,'Eliminar');
            echo 1;
        }
    }



}