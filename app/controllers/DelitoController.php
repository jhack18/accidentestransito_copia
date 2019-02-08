<?php
require_once 'app/models/Delito.php';
require_once 'app/models/Bitacora.php';
use Exception;
class DelitoController{
    private $delito;
    private $bitacora;
    public function __construct(){
        $this->delito = new delito();
        $this->bitacora = new Bitacora();
    }

    public function mostrar() {
        $model = $this->delito->listar();
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'delito/mostrar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function agregar() {
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'delito/agregar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function guardar() {
        $model = new Delito();
        $carpeta = "iconos/";
        opendir($carpeta);
        $destinoimagen = $carpeta.$_FILES["imagen"]["name"];
        copy($_FILES["imagen"]["tmp_name"],$destinoimagen);

        $model->id = $_POST['id'];
        $model->nombre = $_POST['nombre'];
        $model->descripcion = $_POST['descripcion'];
        $model->imagen = $destinoimagen;


        $result = $this->delito->guardar($model);

        if($result !== 1) {
            $this->bitacora->guardar('Fallo Al Guardar Nuevo Delito','Falla Sistema');
            echo "<script language=\"javascript\">alert(\"Hubo un error. Intentelo otra vez.\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"index.php?c=Delito&a=mostrar\";</script>";
        } else {
            if($model->id){
                $this->bitacora->guardar('Edicion Delito con ID: ' . $model->id,'Edicion');
                echo "<script language=\"javascript\">window.location.href=\"index.php?c=Delito&a=mostrar\";</script>";
            } else {
                $this->bitacora->guardar('Nuevo Delito con ID: ' . $model->id,'Guardar');
                echo "<script language=\"javascript\">window.location.href=\"index.php?c=Delito&a=mostrar\";</script>";
            }
        }
    }

    public function guardaredicion() {
        $model = new Delito();
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


        $result = $this->delito->guardar($model);

        if($result !== 1) {
            $this->bitacora->guardar('Fallo Al Guardar Nuevo Delito','Falla Sistema');
            echo "<script language=\"javascript\">alert(\"Hubo un error. Intentelo otra vez.\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"index.php?c=Delito&a=mostrar\";</script>";
        } else {
            if($model->id){
                $this->bitacora->guardar('Edicion Delito con ID: ' . $model->id,'Edicion');
                echo "<script language=\"javascript\">window.location.href=\"index.php?c=Delito&a=mostrar\";</script>";
            } else {
                $this->bitacora->guardar('Nuevo Delito con ID: ' . $model->id,'Guardar');
                echo "<script language=\"javascript\">window.location.href=\"index.php?c=Delito&a=mostrar\";</script>";
            }
        }
    }

    public function editar() {
        $id_delito = $_GET['id'];
        $delito = $this->delito->obtener($id_delito);

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'delito/editar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function eliminar() {
        $id = $_POST['id'];

        $result = $this->delito->eliminar($id);

        if(!$result) {
            $this->bitacora->guardar('Fallo Al Borrar Delito con ID: ' . $id,'Falla Sistema');
            echo 2;
        } else {
            $this->bitacora->guardar('Delito Eliminado con ID: ' . $id,'Eliminar');
            echo 1;
        }
    }



}