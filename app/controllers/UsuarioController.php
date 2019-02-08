<?php
require_once 'app/models/Usuario.php';
require_once 'app/models/Rol.php';
require_once 'app/models/Bitacora.php';
use Exception;
class UsuarioController{
    private $usuario;
    private $rol;
    private $bitacora;
    public function __construct(){
        $this->usuario = new Usuario();
        $this->rol = new Rol();
        $this->bitacora = new Bitacora();
    }

    public function mostrar() {
        if($_SESSION['rol'] == "Administrador"){
            $model = $this->usuario->listar();
            require_once _VIEW_PATH_ . 'header-admin.php';
            require_once _VIEW_PATH_ . 'navbar-admin.php';
            require_once _VIEW_PATH_ . 'usuario/mostrar.php';
            require_once _VIEW_PATH_ . 'footer-admin.php';
        } else {
            $this->bitacora->guardar('Intento de Usuario No Permitido Acceso Administrador','Prohibido');
            echo "<script language=\"javascript\">window.location.href=\"index.php?c=Admin&a=index\";</script>";
        }

    }

    public function agregar() {
        if($_SESSION['rol'] == "Administrador"){
            $roles = $this->rol->listar();
            require_once _VIEW_PATH_ . 'header-admin.php';
            require_once _VIEW_PATH_ . 'navbar-admin.php';
            require_once _VIEW_PATH_ . 'usuario/agregar.php';
            require_once _VIEW_PATH_ . 'footer-admin.php';
        } else {
            $this->bitacora->guardar('Intento de Usuario No Permitido Acceso Administrador','Prohibido');
            echo "<script language=\"javascript\">window.location.href=\"index.php?c=Admin&a=index\";</script>";
        }

    }

    public function guardar() {

            $result = 0;
            $model = new Usuario();
            $model->id = $_POST['id'];
            $model->nombre = $_POST['nombre'];
            $model->apellido = $_POST['apellido'];
            $model->dni = $_POST['dni'];
            $model->nickname = $_POST['nickname'];
            $model->contrasenha = $_POST['contrasenha'];
            $model->rol = $_POST['rol'];

            $verificardni = $this->usuario->consultardni($model->dni);
            $verificarnickname = $this->usuario->consultarnickname($model->nickname);

            if(empty($model->id)){
                if($verificardni != false){
                    $this->bitacora->guardar('Intento de Registro Usuario con DNI Repetido','Prohibido');
                    $result = 2;
                } else {
                    if($verificarnickname == false){
                        $this->bitacora->guardar('Creación de Nuevo Usuario','Guardar');
                        $result = $this->usuario->guardar($model);
                    } else {
                        $this->bitacora->guardar('Intento de Registro Usuario con Nickname Repetido','Prohibido');
                        $result = 3;
                    }
                }
            } else {
                $usuarioantiguo = $this->usuario->obtener($model->id);
                if($usuarioantiguo->dni == $model->dni && $usuarioantiguo->nickname == $model->nickname){
                    $result = $this->usuario->guardar($model);
                    $this->bitacora->guardar('Edicion Usuario con ID: ' . $model->id,'Guardar');
                    $_SESSION['nombre'] = $model->nombre;
                    $_SESSION['apellido'] = $model->apellido;
                } else {
                    if($usuarioantiguo->dni != $model->dni){
                        if($verificardni != false){
                            $this->bitacora->guardar('Intento de Registro Usuario con DNI Repetido','Prohibido');
                            $result = 2;
                        } else {
                            $this->bitacora->guardar('Edicion Usuario con ID: ' . $model->id,'Guardar');
                            $result = $this->usuario->guardar($model);
                            $_SESSION['nombre'] = $model->nombre;
                            $_SESSION['apellido'] = $model->apellido;
                        }
                    } else {
                        if($usuarioantiguo->nickname != $model->nickname){
                            if($verificarnickname != false){
                                $this->bitacora->guardar('Intento de Registro Usuario con Nickname Repetido','Prohibido');
                                $result = 3;
                            } else {
                                $this->bitacora->guardar('Edicion Usuario con ID: ' . $model->id,'Guardar');
                                $result = $this->usuario->guardar($model);
                                $_SESSION['nombre'] = $model->nombre;
                                $_SESSION['apellido'] = $model->apellido;
                            }
                        }
                    }
                }
            }
            if($result !== 1) {
                $this->bitacora->guardar('Error Al Crear Nuevo Usuario','Falla Sistema');
                echo $result;
            } else {
                echo 1;
            }


    }

    public function editar() {
        if($_SESSION['rol'] == "Administrador"){
            $id_usuario = $_GET['id'];
            $usuario = $this->usuario->obtener($id_usuario);
            $roles = $this->rol->listar();
            //var_dump($usuario);
            //exit;
            require_once _VIEW_PATH_ . 'header-admin.php';
            require_once _VIEW_PATH_ . 'navbar-admin.php';
            require_once _VIEW_PATH_ . 'usuario/editar.php';
            require_once _VIEW_PATH_ . 'footer-admin.php';
        } else {
            $this->bitacora->guardar('Intento de Usuario No Permitido Acceso Administrador','Prohibido');
            echo "<script language=\"javascript\">window.location.href=\"index.php?c=Admin&a=index\";</script>";
        }


    }

    public function eliminar() {
        if($_SESSION['rol'] == "Administrador"){
            $id = $_POST['id'];
            $result = $this->usuario->eliminar($id);
            if(!$result) {
                $this->bitacora->guardar('Error Al Eliminar Usuario con ID: ' . $id,'Falla Sistema');
                echo 2;
            } else {
                $this->bitacora->guardar('Usuario Eliminado con ID: ' . $id,'Eliminar');
                echo 1;
            }
        } else {
            $this->bitacora->guardar('Intento de Usuario No Permitido Acceso Administrador','Prohibido');
            echo "<script language=\"javascript\">window.location.href=\"index.php?c=Admin&a=index\";</script>";
        }
    }

}