<?php 

require_once 'app/models/Bitacora.php';
require_once 'app/models/Involucrado.php';
require_once 'app/models/Accidente.php';
//require_once 'app/models/Distrito.php';

	use Exception;
	class InvolucradoController{
    private $involucrado;
    private $bitacora;
    private $accidente;

    public function __construct(){
        $this->involucrado = new Involucrado();
        $this->bitacora = new Bitacora();
        $this->accidente = new Accidente();
    }
 	
 	public function agregar() {

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'involucrado/agregar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function mostrar() {
        $model = $this->involucrado->listar();

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'involucrado/mostrar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    public function buscar() {

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'involucrado/buscar.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }

    public function buscar_involucrado(){
        $nombre = $_POST['nombre'];
        $buscar_involucrado = $this->involucrado->buscar_involucrado($nombre);
        $result = "<div class='row'>
        <table id='datos_involucrado' class='table table-bordered table-hover table-striped'>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dni</th>
                <th>Licencia</th>
                <th>Contacto</th>
                <th>Tipo</th>
                <th>Fecha_Accidente</th>
                <th>Accidente_Fatal</th>
                <th>Descripcion_Accidente</th>
                <th>Calle</th>
            </tr>";
            $j = 1;
            foreach ($buscar_involucrado as $bi) {
                $result .= "<tr>
                <td> $j</td>
                <td>" . $bi->nombre . "</td>
                <td>" . $bi->apellido . "</td>
                <td>" . $bi->dni . "</td>
                <td>" . $bi->licencia . "</td>
                <td>" . $bi->contacto . "</td>
                <td>" . $bi->tipo . "</td>
                <td>" . $bi->accidente_fecha . "</td>
                <td>" . $bi->accidente_fatal . "</td>
                <td>" . $bi->accidente_descripcion . "</td>
                <td>" . $bi->calle_nombre . "</td>";
                $j++;
            }
        echo $result;
    }

    public function guardar() {



        $model = new Involucrado();
        $model->id = $_POST['id'];

        $model->nombre = $_POST['nombre'];
        $model->apellido = $_POST['apellido'];
        $model->dni = $_POST['dni'];
        $model->licencia = $_POST['licencia'];
        $model->contacto = $_POST['contacto'];
        $tipo = $_POST['tipo_involucrado'];

       $id_accidente = $_POST['id_accidente'];

        $result = $this->involucrado->guardar($model);

        if($result !== 1) {
            $this->bitacora->guardar('Error al guardar Involucrado','Fallo Sistema');
            echo 2;
            //echo "<script language=\"javascript\">window.location.href=\"index.php?c=Involucrado&a=agregar\";</script>";
        } else {
        	 
        	$ultimo_id_involucrado = $this->involucrado->ultimo_id_involucrado();
        	$idd = $ultimo_id_involucrado->involucrado_id;
        	$result = $this->involucrado->guardar_inv_acc($id_accidente,$idd,$tipo);
            $this->bitacora->guardar('Guardado Involucrado con ID: ' . $model->id,'Guardar');
            //alertify.success("Se envió chevere");
            echo 1;
            //echo "<script language=\"javascript\">window.location.href=\"index.php?c=Involucrado&a=agregar\";</script>";
        }
    }

    public function listar_involucrado_por_id()
    {
        $id = $_POST['id'];
        $involucrado = $this->involucrado->obtener($id);
        $result = "
                   <div class='row'>
                        <div class='col-md-3'>
                            Nombre: 
                        </div>
                        <div class='col-md-3'> 
                            $involucrado->nombre <br><br>
                         </div>
                   </div>
                   <div class='row'>
                        <div class='col-md-3'>
                             Apellido:  
                        </div>
                        <div class='col-md-3'>
                             $involucrado->apellido <br><br>
                        </div>
                   </div>
                   <div class='row'>
                         <div class='col-md-3'>
                              DNI: 
                          </div>
                         <div class='col-md-3'>
                          $involucrado->dni <br><br>
                          </div>
                   </div>
                   <div class='row'>
                          <div class='col-md-3'>
                               Nº de contacto: 
                          </div>
                          <div class='col-md-3'>
                              $involucrado->contacto <br><br>
                          </div>
                   </div>
                   <div class='row'>
                          <div class='col-md-3'>
                                 Nº licencia: 
                           </div>
                          <div class='col-md-3'>        
                                  $involucrado->licencia <br><br>
                          </div>
                   </div>
                   <div class='row'>
                           <div class='col-md-3'>
                                Tipo:
                           </div> 
                           <div class='col-md-3'>
                                $involucrado->tipo <br>
                           </div>
                   </div>
         ";
        echo $result;
    }

        //metodos del involucrado delito

        /*public function mostrar() {
            $model = $this->involucrado->listar();

            require_once _VIEW_PATH_ . 'header-admin.php';
            //require_once _VIEW_PATH_ . 'navbar-admin.php';
            require_once _VIEW_PATH_ . 'involucrado/mostrar.php';
            require_once _VIEW_PATH_ . 'footer-admin.php';
        }*/

        public function agregar_del() {

            require_once _VIEW_PATH_ . 'header-admin.php';
            require_once _VIEW_PATH_ . 'navbar-admin.php';
            require_once _VIEW_PATH_ . 'involucrado/agregardel.php';
            require_once _VIEW_PATH_ . 'footer-admin.php';
        }

        public function guardar_del() {
            $model = new Involucrado();
            $model->id = $_POST['id'];
            $id_robo = $_POST['id_robo'];
            $model->nombre = $_POST['nombre'];
            $model->apellido = $_POST['apellido'];
            $model->dni = $_POST['dni'];
            $model->contacto = $_POST['contacto'];
            $model->licencia = $_POST['licencia'];
            $tipo = $_POST['tipo'];

            $result = $this->involucrado->guardar($model);

            if($result !== 1) {
                $this->bitacora->guardar('Fallo Al Guardar Nuevo involucrado','Falla Sistema');
                echo $result;
            } else {
                $ultimo_id = $this->involucrado->ultimo_id_involucrado();
                $idd=$ultimo_id->involucrado_id;
                $result = $this->involucrado->guardar_involucrado_delito($idd,$id_robo,$tipo);
                $this->bitacora->guardar('Nuevo involucrado con ID: ' . $model->id,'Guardar');

                //$result2 = $this->involucrado->guardar_involucrado_delito($id_robo,$ultimo_id,$model->tipo);
                //if($result2)

                echo 1;
            }
        }

        public function editar_del() {
            $id_involucrado = $_GET['id_involucrado'];
            $involucrado = $this->involucrado->obtener($id_involucrado);
            //var_dump($usuario);
            //exit;
            require_once _VIEW_PATH_ . 'header-admin.php';
            require_once _VIEW_PATH_ . 'navbar-admin.php';
            require_once _VIEW_PATH_ . 'involucrado/editar.php';
            require_once _VIEW_PATH_ . 'footer-admin.php';
        }

        public function eliminar_del() {
            $id = $_POST['id_involucrado'];

            $result = $this->involucrado->eliminar($id);

            if(!$result) {
                $this->bitacora->guardar('Fallo Al Borrar Distrito con ID: ' . $id,'Falla Sistema');
                echo 2;
            } else {
                $this->bitacora->guardar('Distrito Eliminado con ID: ' . $id,'Eliminar');
                echo 1;
            }
        }
        public function buscar_del() {

            require_once _VIEW_PATH_ . 'header-admin.php';
            require_once _VIEW_PATH_ . 'navbar-admin.php';
            require_once _VIEW_PATH_ . 'involucrado/buscardel.php';
            require_once _VIEW_PATH_ . 'footer-admin.php';
        }

        public function buscar_involucrado_del(){
            $nombre = $_POST['nombre'];
            $buscar_involucrado = $this->involucrado->buscar_involucrado_delito($nombre);
            $result = "<div class='row'>
        <table id='datos_involucrado' class='table table-bordered table-hover table-striped'>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dni</th>
                <th>Licencia</th>
                <th>Contacto</th>
                <th>Tipo</th>
                <th>Fecha del Delito</th>
                <th>Descripcion del delito</th>
                <th>Calle</th>
            </tr>";
            $j = 1;
            foreach ($buscar_involucrado as $bi) {
                $result .= "<tr>
                <td> $j</td>
                <td>" . $bi->nombre . "</td>
                <td>" . $bi->apellido . "</td>
                <td>" . $bi->dni . "</td>
                <td>" . $bi->licencia . "</td>
                <td>" . $bi->contacto . "</td>
                <td>" . $bi->tipo . "</td>
                <td>" . $bi->robos_fecha . "</td>
                <td>" . $bi->robos_descripcion . "</td>
                <td>" . $bi->calle_nombre . "</td>";
                $j++;
            }
            echo $result;
        }
        public function listar_involucrado_por_id_del(){
            $id = $_POST['id'];
            $involucrado = $this->involucrado->obtener_delito($id);
            $result = "
                   <div class='row'>
                        <div class='col-md-3'>
                            Nombre: 
                        </div>
                        <div class='col-md-3'> 
                            $involucrado->nombre <br><br>
                         </div>
                   </div>
                   <div class='row'>
                        <div class='col-md-3'>
                             Apellido:  
                        </div>
                        <div class='col-md-3'>
                             $involucrado->apellido <br><br>
                        </div>
                   </div>
                   <div class='row'>
                         <div class='col-md-3'>
                              DNI: 
                          </div>
                         <div class='col-md-3'>
                          $involucrado->dni <br><br>
                          </div>
                   </div>
                   <div class='row'>
                          <div class='col-md-3'>
                               Nº de contacto: 
                          </div>
                          <div class='col-md-3'>
                              $involucrado->contacto <br><br>
                          </div>
                   </div>
                   <div class='row'>
                          <div class='col-md-3'>
                                 Nº licencia: 
                           </div>
                          <div class='col-md-3'>        
                                  $involucrado->licencia <br><br>
                          </div>
                   </div>
                   <div class='row'>
                           <div class='col-md-3'>
                                Tipo:
                           </div> 
                           <div class='col-md-3'>
                                $involucrado->tipo <br>
                           </div>
                   </div>
         ";
            echo $result;
        }
}

