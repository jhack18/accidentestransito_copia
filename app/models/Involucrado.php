<?php 


	use Exception;
	require_once 'core/Database.php';

	class Involucrado{
    private $pdo;
    private $accidentes;

    public function __construct(){
        $this->pdo = Database::getConnection();
        
    }

    public function guardar($model){
        $result = 2;

        try {



            if(empty($model->id)){
                $sql = 'insert into involucrado(
                    nombre, apellido, dni, licencia, contacto
                    ) values(?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([

                    $model->nombre,
                    $model->apellido,
                    $model->dni,
                    $model->licencia,
                    $model->contacto,

                ]);

            } /*else {
                $sql = "update accidentes
                set
                causaaccidente_id = ?,
                accidente_fecha = ?,
                accidente_fatal = ?,
                accidente_descripcion = ?,
                calle_nombre = ?,
                distrito_id = ?,
                calle_x = ?,
                calle_y = ?
                where accidentes_id = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->causa,
                    $model->fecha,
                    $model->fatal,
                    $model->descripcion,
                    $model->nombre,
                    $model->distrito,
                    $model->coorx,
                    $model->coory,
                    $model->id
                ]);

            }*/
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
        }

        return $result;
    }



    public function get_id_accidente(){
        


        
        	

        	       $result = new Accidentes();

        	try {
            $stm = $this->pdo->prepare('select accidentes_id from accidentes order by accidentes_id desc LIMIT 1 ');
            $stm->execute();
            $result = $stm->fetch();
	        } catch (Exception $e){

	        }

	        return $result;

	}

	public function ultimo_id_involucrado(){


       $result = new Involucrado();

        try {
            $stm = $this->pdo->prepare('select involucrado_id from involucrado order by involucrado_id desc LIMIT 1 ');
            $stm->execute();
            $result = $stm->fetch();
        } catch (Exception $e){

        }

        return $result;
    }

    public function guardar_inv_acc($id_acc,$id_inv,$tipo){

    	$result = 2;

        try {
                $sql = 'insert into involucrado_accidente(
                    accidentes_id, involucrado_id, tipo
                    ) values(?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $id_acc,
                    $id_inv,
                    $tipo
                ]);
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
        }

        return $result;

    }

    public function listar(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from involucrado');
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    	
    }
        public function obtener($id){
            $result = new Involucrado();

            try {
                $stm = $this->pdo->prepare('select * from involucrado i inner join involucrado_accidente ic on i.involucrado_id = ic.involucrado_id  where i.involucrado_id = ?');
                $stm->execute([$id]);
                $result = $stm->fetch();
            } catch (Exception $e){

            }

            return $result;
        }

        public function buscar_involucrado($nombre){

            $result = [];

            try {
                $stm = $this->pdo->prepare("select * from involucrado i inner join involucrado_accidente ic 
                                                      on i.involucrado_id = ic.involucrado_id
                                                    inner join accidentes ac on ic.accidentes_id=ic.accidentes_id
                                                    where i.nombre like concat('%',?,'%') or i.dni like concat('%',?,'%')  ");
                $stm->execute([$nombre,$nombre]);
                $result = $stm->fetchAll();
            } catch (Exception $e){

            }

            return $result;

        }

        //metodos para el involucrado del delito

        /*public function listar(){
            $result = [];

            try {
                $stm = $this->pdo->prepare('select * from involucrado');
                $stm->execute();

                $result = $stm->fetchAll();
            } catch (Exception $e){

            }

            return $result;
        }*/
        public function buscar_involucrado_delito($nombre){

            $result = [];

            try {
                $stm = $this->pdo->prepare("select * from involucrado i inner join involucrado_delito ic 
                                                      on i.involucrado_id = ic.involucrado_id
                                                    inner join delito ac on ic.robos_id=ic.robos_id
                                                    where i.nombre like concat('%',?,'%') or i.dni like concat('%',?,'%')  ");
                $stm->execute([$nombre,$nombre]);
                $result = $stm->fetchAll();
            } catch (Exception $e){

            }

            return $result;

        }
        public function obtener_delito($id){
            $result = new Involucrado();

            try {
                $stm = $this->pdo->prepare('select * from involucrado i inner join involucrado_delito id on i.involucrado_id=id.involucrado_id  where i.involucrado_id = ? ');
                $stm->execute([$id]);
                $result = $stm->fetch();
            } catch (Exception $e){

            }

            return $result;
        }

        /*public function obtener_ultimo_id_involucrado(){
            $result = new Involucrado();

            try {
                $stm = $this->pdo->prepare('select id_involucrado from involucrado order by id_involucrado desc limit 1');
                $stm->execute();
                $result = $stm->fetch();
            } catch (Exception $e){

            }

            return $result;
        }
        public function guardar_inv_delito($model){
            $result = 2;

            try {

                if(empty($model->id)){
                    $sql = 'insert into involucrado(
                    nombre,apellido,dni,n_contacto,n_licencia
                    ) values(?,?,?,?,?)';
                    $stm = $this->pdo->prepare($sql);
                    $stm->execute([
                        $model->nombre,
                        $model->apellido,
                        $model->dni,
                        $model->contacto,
                        $model->licencia
                    ]);


                } else {
                    $sql = "update involucrado
                set
                nombre= ?, apellido=?,dni=?,n_contacto=?,n_licencia=?
                where id_involucrado = ?";

                    $stm = $this->pdo->prepare($sql);
                    $stm->execute([
                        $model->nombre,
                        $model->apellido,
                        $model->dni,
                        $model->contacto,
                        $model->licencia,
                        $model->id
                    ]);

                }
                $result = 1;
            } catch (Exception $e){
                //throw new Exception($e->getMessage());
            }

            return $result;
        }*/
        public function guardar_involucrado_delito($id_in,$id_robo,$tipo){

            $result = 2;

            try {
                $sql = 'insert into involucrado_delito(
                    involucrado_id,robos_id,tipo
                    ) values(?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $id_in,
                    $id_robo,
                    $tipo
                ]);
                $result = 1;
            } catch (Exception $e){
                //throw new Exception($e->getMessage());
            }

            return $result;

        }

        public function eliminar($id){
            $result = false;

            try {
                $stm = $this->pdo->prepare('delete from involucrado where id_involucrado = ?');
                $stm->execute([$id]);

                $result = true;
            } catch (Exception $e){

            }

            return $result;
        }
}
