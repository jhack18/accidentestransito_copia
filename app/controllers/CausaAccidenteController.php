<?php
require_once 'app/models/CausaAccidente.php';
require_once 'app/models/Bitacora.php';

use Exception;
class CausaAccidenteController{
    private $causaaccidente;
    private $bitacora;
    public function __construct(){
        $this->causaaccidente = new CausaAccidente();
        $this->bitacora = new Bitacora();
    }

    public function mostrar() {
        $model = $this->causaaccidente->listar();
        //var_dump($model);
        //exit;
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'causaaccidente/mostrar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function agregar() {
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'causaaccidente/agregar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    //Poner bitacora aqui
    public function guardar() {
        $model = new CausaAccidente();
        $carpeta = "iconos/";

        opendir($carpeta);
        $destinoimagen = $carpeta.$_FILES["imagen"]["name"];
        copy($_FILES["imagen"]["tmp_name"],$destinoimagen);

        $model->id = $_POST['id'];
        $model->nombre = $_POST['nombre'];
        $model->descripcion = $_POST['descripcion'];
        $model->imagen = $destinoimagen;

        $result = $this->causaaccidente->guardar($model);

        if($result !== 1) {
            $this->bitacora->guardar('Error al guardar CausaAccidente','Fallo Sistema');
            echo "<script language=\"javascript\">alert(\"Hubo un error. Intentelo otra vez.\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"index.php?c=CausaAccidente&a=mostrar\";</script>";
        } else {
            $this->bitacora->guardar('Guardado CausaAccidente con ID: ' . $model->id,'Guardar');
            echo "<script language=\"javascript\">window.location.href=\"index.php?c=CausaAccidente&a=mostrar\";</script>";
        }
    }

    //Poner bitacora aqui
    public function guardaredicion() {
        $model = new CausaAccidente();
        if($_FILES["imagen"]["name"] === ""){
            $destinoimagen  = $_POST['imagena'];
        } else {
            $borrar = $_POST['imagena'];
            unlink($borrar);
            $carpeta = "iconos/";
            opendir($carpeta);
            $destinoimagen = $carpeta.$_FILES["imagen"]["name"];
            copy($_FILES["imagen"]["tmp_name"],$destinoimagen);
        }

        $model->id = $_POST['id'];
        $model->nombre = $_POST['nombre'];
        $model->descripcion = $_POST['descripcion'];
        $model->imagen = $destinoimagen;

        $result = $this->causaaccidente->guardar($model);

        if($result !== 1) {
            $this->bitacora->guardar('Error al Editar CausaAccidente','Fallo Sistema');
            echo "<script language=\"javascript\">alert(\"Hubo un error. Intentelo otra vez.\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"index.php?c=CausaAccidente&a=mostrar\";</script>";
        } else {
            $this->bitacora->guardar('Editado CausaAccidente con ID: ' . $model->id,'Edicion');
            echo "<script language=\"javascript\">window.location.href=\"index.php?c=CausaAccidente&a=mostrar\";</script>";
        }
    }

    public function editar() {
        $id_accidente = $_GET['id'];
        $accidente = $this->causaaccidente->obtener($id_accidente);

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'causaaccidente/editar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    //Poner bitacora aqui
    public function eliminar() {
        $id = $_POST['id'];

        $result = $this->causaaccidente->eliminar($id);

        if(!$result) {
            $this->bitacora->guardar('Fallo Eliminar CausaAccidente','Fallo Sistema');
            echo 2;
        } else {
            $this->bitacora->guardar('CausaAccidente Eliminado con ID: ' . $id,'Eliminar');
            echo 1;
        }
    }



}