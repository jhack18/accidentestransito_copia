<?php
require_once 'app/models/Admin.php';
require_once 'app/models/Usuario.php';
require_once 'app/models/Rol.php';
require_once 'app/models/Bitacora.php';
use Exception;
class AdminController{
    private $usuario;
    private $admin;
    private $rol;
    private $bitacora;
    public function __construct(){
        $this->admin =  new Admin();
        $this->usuario = new Usuario();
        $this->rol = new Rol();
        $this->bitacora = new Bitacora();
    }
    public function index() {
        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'admin/index.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function edicion() {
        if(isset($_SESSION['rol'])){
            $id_usuario = $_SESSION['id'];
            $usuario = $this->usuario->obtener($id_usuario);
            $roles = $this->rol->listar();
            //var_dump($usuario);
            //exit;
            require_once _VIEW_PATH_ . 'header-admin.php';
            require_once _VIEW_PATH_ . 'navbar-admin.php';
            require_once _VIEW_PATH_ . 'admin/editar.php';
            require_once _VIEW_PATH_ . 'footer-admin.php';
        } else {
            echo "<script language=\"javascript\">window.location.href=\"index.php?c=Admin&a=index\";</script>";
            $this->bitacora->guardar('Intento Ilegal de Acesso Vista Admin/Editar','Prohibido');
        }
    }

    public function login(){
        require _VIEW_PATH_ . 'admin/login.php';
    }

    public function loguearse(){
        $usuario = $_POST['usuario'];
        $contrasenha = $_POST['contrasenha'];
        $model = $this->admin->loguear($usuario, $contrasenha);
        if(isset($model->id)){
            $_SESSION['id'] = $model->id;
            $_SESSION['nombre'] = $model->nombre;
            $_SESSION['apellido'] = $model->apellido;
            $_SESSION['dni'] = $model->dni;
            $_SESSION['nickname'] = $model->nickname;
            $_SESSION['contrasenha'] = $model->contrasenha;
            $_SESSION['rol'] = $model->rol;
            $this->bitacora->guardar('Inicio Sesion ' . $_SESSION['nickname'],'Inicio Sesion');
            echo 1;
        } else {
            $this->bitacora->guardar('Inicio de Sesión Fallido Usuario: ' . $usuario,'Prohibido');
            echo 2;
        }
    }

    public function salir(){
        $accion = $this->bitacora->guardar('LogOut Usuario ' . $_SESSION['nickname'],'Cierre de Sesion');
        unset($_SESSION['id']);
        unset($_SESSION['nombre']);
        unset($_SESSION['apellido']);
        unset($_SESSION['dni']);
        unset($_SESSION['nickname']);
        unset($_SESSION['contrasenha']);
        unset($_SESSION['rol']);
        header('Location: index.php');
    }
}