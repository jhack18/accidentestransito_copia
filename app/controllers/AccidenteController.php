<?php
require_once 'app/models/Bitacora.php';
require_once 'app/models/Accidente.php';
require_once 'app/models/CausaAccidente.php';
require_once 'app/models/Distrito.php';

use Exception;
class AccidenteController{
    private $accidente;

    private $causaaccidente;
    private $distrito;
    private $bitacora;

    public function __construct(){
        $this->accidente = new Accidente();

        $this->causaaccidente = new CausaAccidente();
        $this->distrito = new Distrito();
        $this->bitacora = new Bitacora();
    }

    public function mostrar() {
        $model = $this->accidente->listar();
        $involucrados = $this->accidente->listar_involucrados();
        //var_dump($model);
        //exit;

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'accidente/mostrar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function agregar() {
        $causaaccidentes = $this->causaaccidente->listar();

        $distritos = $this->distrito->listar();
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'accidente/agregar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function guardar() {
        $model = new Accidente();
        $model->id = $_POST['id'];
        $model->causa = $_POST['causa'];
        $model->fecha = $_POST['fecha'];
        $model->fatal = $_POST['fatal'];
        $model->descripcion = $_POST['descripcion'];
        $model->nombre = $_POST['nombre'];
        $model->distrito = $_POST['distrito'];
        $model->coorx = $_POST['coorx'];
        $model->coory = $_POST['coory'];

        $result = $this->accidente->guardar($model);

        if($result !== 1) {
            $this->bitacora->guardar('Error al guardar Accidente','Fallo Sistema');
        } else {
            if($model->id){
                $this->bitacora->guardar('Editado Accidente con ID: ' . $model->id,'Edicion');
                echo 1;
            } else {
                $this->bitacora->guardar('Guardado Accidente con ID: ' . $model->id,'Guardar');
                echo 1;
            }

        }
    }

    public function editar() {
        $id_accidente = $_GET['id'];
        $causaaccidentes = $this->causaaccidente->listar();
        $accidente = $this->accidente->obtener($id_accidente);
        $distritos = $this->distrito->listar();
        //var_dump($usuario);
        //exit;
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'accidente/editar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function eliminar() {
        $id = $_POST['id'];

        $result = $this->accidente->eliminar($id);

        if(!$result) {
            $this->bitacora->guardar('Fallo Eliminar Accidente','Fallo Sistema');
        } else {
            $this->bitacora->guardar('Accidente Eliminado con ID: ' . $id,'Eliminar');
            echo 1;
        }
    }


     public function editar_id_accidente() {
        $id_accidente = $_GET['id'];
        $accidente = $this->Accidente->obtener_id_accidente($id_accidente);
        //var_dump($usuario);
        //exit;
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'involucrado/agregar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
}