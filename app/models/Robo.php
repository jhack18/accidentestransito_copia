<?php
use Exception;
require_once 'core/Database.php';

class Robo{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from delito r inner  join arma a on r.arma_id = a.arma_id inner join tipodelito d on r.delito_id = d.delito_id');
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }
     public function listar_involucrado(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('SELECT * FROM involucrado_delito id inner join involucrado i on i.involucrado_id= id.involucrado_id inner join delito d on d.robos_id=id.robos_id');
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }

    public function obtener($id){
        $result = new Robo();

        try {
            $stm = $this->pdo->prepare('select * from delito r inner  join arma a on r.arma_id = a.arma_id  inner join tipodelito d on r.delito_id = d.delito_id where r.robos_id = ?');
            $stm->execute([$id]);

            $fecht = $stm->fetch();

            $result->id = $fecht->robos_id;
            $result->fecha = $fecht->robos_fecha;
            $result->descripcion = $fecht->robos_descripcion;
            $result->calle = $fecht->calle_id;
            $result->arma = $fecht->arma_id;
            $result->delito = $fecht->delito_id;
            $result->nombre = $fecht->calle_nombre;
            $result->distrito = $fecht->distrito_id;
            $result->calle_x = $fecht->calle_x;
            $result->calle_y = $fecht->calle_y;

        } catch (Exception $e){

        }

        return $result;
    }

    public function guardar($model){
        $result = 2;

        try {

            if(empty($model->id)){
                $sql = 'insert into delito(
                    robos_fecha, robos_descripcion, arma_id, delito_id, calle_nombre, distrito_id, calle_x, calle_y
                    ) values(?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->fecha,
                    $model->descripcion,
                    $model->arma,
                    $model->delito,
                    $model->nombre,
                    $model->distrito,
                    $model->coorx,
                    $model->coory
                ]);

            } else {
                $sql = "update delito
                set
                robos_fecha = ?,
                robos_descripcion = ?,
                arma_id = ?,
                delito_id = ?,
                calle_nombre = ?,
                distrito_id = ?,
                calle_x = ?,
                calle_y = ?
                where robos_id = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->fecha,
                    $model->descripcion,
                    $model->arma,
                    $model->delito,
                    $model->nombre,
                    $model->distrito,
                    $model->coorx,
                    $model->coory,
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
            $stm = $this->pdo->prepare('delete from delito where robos_id = ?');
            $stm->execute([$id]);

            $result = true;
        } catch (Exception $e){

        }

        return $result;
    }
}