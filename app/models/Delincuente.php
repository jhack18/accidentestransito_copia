<?php
use Exception;
require_once 'core/Database.php';

class Delincuente{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from delincuentes');
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }

    public function obtener($id){
        $result = new Distrito();

        try {
            $stm = $this->pdo->prepare('select * from delincuentes where delincuentes_id = ?');
            $stm->execute([$id]);

            $fecht = $stm->fetch();

            $result->id = $fecht->delincuentes_id;
            $result->nombre = $fecht->delincuentes_nombres;
            $result->apellidop = $fecht->delincuentes_apellidopaterno;
            $result->apellidom = $fecht->delincuentes_apellidomaterno;


        } catch (Exception $e){

        }

        return $result;
    }

    public function guardar($model){
        $result = 2;
        try {
            if(empty($model->id)){
                $sql = 'insert into delincuentes(
                    delincuentes_nombres, delincuentes_apellidopaterno, delincuentes_apellidomaterno
                    ) values(?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $model->apellidop,
                    $model->apellidom
                ]);
            } else {
                $sql = "update delincuentes
                set
                delincuentes_nombres = ?,
                delincuentes_apellidopaterno = ?,
                delincuentes_apellidomaterno = ?
                where delincuentes_id = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $model->apellidop,
                    $model->apellidom,
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
            $stm = $this->pdo->prepare('delete from delincuentes where delincuentes_id = ?');
            $stm->execute([$id]);

            $result = true;
        } catch (Exception $e){

        }

        return $result;
    }
}