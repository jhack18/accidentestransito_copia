<?php
require_once 'app/models/Robo.php';
require_once 'app/models/Arma.php';
require_once 'app/models/Delito.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Distrito.php';

use Exception;
class RoboController{
    private $robo;
    private $arma;
    private $bitacora;
    private $delito;
    private $distrito;

    public function __construct(){
        $this->robo = new Robo();
        $this->bitacora = new Bitacora();
        $this->arma= new Arma();
        $this->delito = new Delito();
        $this->distrito = new Distrito();
    }

    public function mostrar() {
        $model = $this->robo->listar();
        $involucrados= $this->robo->listar_involucrado();
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'robo/mostrar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';

    }

    public function agregar() {
        $armas = $this->arma->listar();
        $delitos = $this->delito->listar();
        $distritos = $this->distrito->listar();
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'robo/agregar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function guardar() {
        $model = new Robo();
        $model->id = $_POST['id'];
        $model->fecha = $_POST['fecha'];
        $model->descripcion = $_POST['descripcion'];
        $model->arma = $_POST['arma'];
        $model->delito = $_POST['delito'];
        $model->nombre = $_POST['nombre'];
        $model->distrito = $_POST['distrito'];
        $model->coorx = $_POST['coorx'];
        $model->coory = $_POST['coory'];


        $result = $this->robo->guardar($model);

        if($result !== 1) {
            $this->bitacora->guardar('Fallo Al Guardar Nuevo Robo','Falla Sistema');
            echo 2;
        } else {
            if($model->id){
                $this->bitacora->guardar('Edicion Robo con ID: ' . $model->id,'Edicion');
                echo 1;
            } else {
                $this->bitacora->guardar('Nuevo Robo con Delito: ' . $model->delito,'Guardar');
                echo 1;
            }
        }
    }

    public function editar() {
        $id_robo = $_GET['id'];
        $armas = $this->arma->listar();
        $delitos = $this->delito->listar();
        $distritos = $this->distrito->listar();
        $robo = $this->robo->obtener($id_robo);
        //var_dump($usuario);
        //exit;
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'robo/editar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function eliminar() {
        $id = $_POST['id'];

        $result = $this->robo->eliminar($id);

        if(!$result) {
            $this->bitacora->guardar('Fallo Al Borrar Robo con ID: ' . $id,'Falla Sistema');
            echo 2;
        } else {
            $this->bitacora->guardar('Robo Eliminado con ID: ' . $id,'Eliminar');
            echo 1;
        }
    }
}