<?php
use Exception;
require_once 'core/Database.php';

class Accidente{
    private $pdo;
    public $obtener_id;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from accidentes a inner join causaaccidente c2 on a.causaaccidente_id = c2.causaaccidente_id');
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }

    public function obtener($id){
        $result = new Accidente();

        try {
            $stm = $this->pdo->prepare('select * from accidentes a inner join causaaccidente c2 on a.causaaccidente_id = c2.causaaccidente_id  where a.accidentes_id = ?');
            $stm->execute([$id]);

            $fecht = $stm->fetch();

            $result->id = $fecht->accidentes_id;
            $result->causa = $fecht->causaaccidente_id;
            $result->fecha = $fecht->accidente_fecha;
            $result->calle = $fecht->calle_id;
            $result->fatal = $fecht->accidente_fatal;
            $result->descripcion = $fecht->accidente_descripcion;
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
                $sql = 'insert into accidentes(
                    causaaccidente_id, accidente_fecha, accidente_fatal, accidente_descripcion, calle_nombre, distrito_id, calle_x, calle_y
                    ) values(?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->causa,
                    $model->fecha,
                    $model->fatal,
                    $model->descripcion,
                    $model->nombre,
                    $model->distrito,
                    $model->coorx,
                    $model->coory
                ]);
                //$this->pdo->LastInsertId();

            } else {
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
            $stm = $this->pdo->prepare('delete from accidentes where accidentes_id = ?');
            $stm->execute([$id]);

            $result = true;
        } catch (Exception $e){

        }

        return $result;
    }

     public function obtener_id_accidente($id){
        $result = new Accidente();

        try {
            $stm = $this->pdo->prepare('select * from accidentes where accidentes_id = ?');
            $stm->execute([$id]);

            $fecht = $stm->fetch();

            $result->id = $fecht->accidentes_id;
            //$result->nombre = $fecht->distrito_nombre;


        } catch (Exception $e){

        }

        return $result;
    }

    public function listar_accidentes(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select accidentes_id from accidentes order by accidentes_id desc LIMIT 1 ');
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }

    public function listar_accidentes2(){
        $result = new Involucrado();

        try {
            $stm = $this->pdo->prepare('select accidentes_id from accidentes order by accidentes_id desc LIMIT 1 ');
            $stm->execute();
            $result = $stm->fetch();
        } catch (Exception $e){

        }

        return $result;
    }

    public function listar_involucrados(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from accidentes a inner join involucrado_accidente ia on a.accidentes_id = ia.accidentes_id
                                          inner join involucrado iv on ia.involucrado_id = iv.involucrado_id');
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;

    }

    
}