<?php
require_once 'app/models/Distrito.php';
require_once 'app/models/Bitacora.php';
use Exception;
class distritoController{
    private $distrito;
    private $bitacora;
    public function __construct(){
        $this->distrito = new Distrito();
        $this->bitacora = new Bitacora();
    }

    public function mostrar() {
        $model = $this->distrito->listar();

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'distrito/mostrar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function agregar() {

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'distrito/agregar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function guardar() {
        $model = new Distrito();
        $model->id = $_POST['id'];
        $model->nombre = $_POST['nombre'];

        $result = $this->distrito->guardar($model);

        if($result !== 1) {
            $this->bitacora->guardar('Fallo Al Guardar Nuevo Distrito','Falla Sistema');
            echo 2;
        } else {
            if($model->id){
                $this->bitacora->guardar('Edicion Distrito con ID: ' . $model->id,'Edicion');
                echo 1;
            } else {
                $this->bitacora->guardar('Nuevo Distrito con ID: ' . $model->id,'Guardar');
                echo 1;
            }
        }
    }

    public function editar() {
        $id_distrito = $_GET['id'];
        $distrito = $this->distrito->obtener($id_distrito);
        //var_dump($usuario);
        //exit;
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'distrito/editar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function eliminar() {
        $id = $_POST['id'];

        $result = $this->distrito->eliminar($id);

        if(!$result) {
            $this->bitacora->guardar('Fallo Al Borrar Distrito con ID: ' . $id,'Falla Sistema');
            echo 2;
        } else {
            $this->bitacora->guardar('Distrito Eliminado con ID: ' . $id,'Eliminar');
            echo 1;
        }
    }
}