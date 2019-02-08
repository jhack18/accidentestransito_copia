<?php
use Exception;
require_once 'core/Database.php';

class CausaAccidente{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from causaaccidente');
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }

    public function obtener($id){
        $result = new CausaAccidente();

        try {
            $stm = $this->pdo->prepare('select * from causaaccidente where causaaccidente_id = ?');
            $stm->execute([$id]);

            $fecht = $stm->fetch();

            $result->id = $fecht->causaaccidente_id;
            $result->nombre = $fecht->causaaccidente_nombre;
            $result->descripcion = $fecht->causaaccidente_descripcion;
            $result->imagen = $fecht->imagen;

        } catch (Exception $e){

        }

        return $result;
    }

    public function guardar($model){
        $result = 2;

        try {

            if(empty($model->id)){
                $sql = 'insert into causaaccidente(
                    causaaccidente_nombre,
                    causaaccidente_descripcion,
                    imagen
                    ) values(?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $model->descripcion,
                    $model->imagen
                ]);

            } else {
                $sql = "
                update causaaccidente
                set
                causaaccidente_nombre = ?,
                causaaccidente_descripcion = ?,
                imagen = ?
                where causaaccidente_id = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $model->descripcion,
                    $model->imagen,
                    $model->id
                ]);

            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
        }

        return $result;
    }

    public function eliminar($id){
        $result = false;

        try {
            $stm = $this->pdo->prepare('delete from causaaccidente where causaaccidente_id = ?');
            $stm->execute([$id]);

            $result = true;
        } catch (Exception $e){

        }

        return $result;
    }
}