<?php

use Exception;
require_once 'core/Database.php';

class Arma{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from arma');
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }

    public function obtener($id){
        $result = new distrito;

        try {
            $stm = $this->pdo->prepare('select * from  arma  WHERE arma_id = ?');
            $stm->execute([$id]);

            $fecht = $stm->fetch();

            $result->id = $fecht->arma_id;
            $result->nombre = $fecht->arma_nombre;
            $result->descripcion = $fecht->arma_descripcion;

        } catch (Exception $e){

        }

        return $result;
    }

    public function guardar($model){
        $result = 2;

        try {

            if(empty($model->id)){
                $sql = 'insert into arma(
                    arma_nombre, 
                    arma_descripcion
                   
                    ) values(?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $model->descripcion
                ]);

            } else {
                $sql = "
                update arma
                set
                arma_nombre = ?,
                arma_descripcion = ?
                where arma_id = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $model->descripcion,
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
            $stm = $this->pdo->prepare('delete from arma where arma_id = ?');
            $stm->execute([$id]);

            $result = true;
        } catch (Exception $e){

        }

        return $result;
    }
}