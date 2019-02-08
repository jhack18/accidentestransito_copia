<?php
require_once 'app/models/Delincuente.php';
use Exception;
class DelincuenteController{
    private $delincuente;

    public function __construct(){
        $this->delincuente = new delincuente();
    }

    public function mostrar() {
        $model = $this->delincuente->listar();

        //var_dump($model);
        //exit;
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'delincuente/mostrar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function agregar() {


        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'delincuente/agregar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function guardar() {
        $model = new Delincuente();
        $model->id = $_POST['id'];
        $model->nombre = $_POST['nombre'];
        $model->apellidop = $_POST['apellidop'];
        $model->apellidom = $_POST['apellidom'];


        $result = $this->delincuente->guardar($model);

        if($result !== 1) {
            throw new Exception('No se pudo realizar la operación');
        } else {
            echo 1;
        }
    }

    public function editar() {
        $id = $_GET['id'];
        $delincuentes = $this->delincuente->obtener($id);
        //var_dump($usuario);
        //exit;
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'delincuente/editar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function eliminar() {
        $id = $_POST['id'];

        $result = $this->delincuente->eliminar($id);

        if(!$result) {

        } else {
            echo 1;
        }
    }
}