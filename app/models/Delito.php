<?php

use Exception;
require_once 'core/Database.php';

class Delito{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from tipodelito');
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }

    public function obtener($id){
        $result = new delito;

        try {
            $stm = $this->pdo->prepare('select * from  tipodelito  WHERE delito_id = ?');
            $stm->execute([$id]);

            $fecht = $stm->fetch();

            $result->id = $fecht->delito_id;
            $result->nombre = $fecht->delito_nombre;
            $result->descripcion = $fecht->delito_descripcion;
            $result->imagen = $fecht->imagen;

        } catch (Exception $e){

        }

        return $result;
    }

    public function guardar($model){
        $result = 2;

        try {

            if(empty($model->id)){
                $sql = 'insert into tipodelito(
                    delito_nombre, 
                    delito_descripcion,
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
                update tipodelito
                set
                delito_nombre = ?,
                delito_descripcion = ?,
                imagen = ?
                where delito_id = ?";

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
            $stm = $this->pdo->prepare('delete from tipodelito where delito_id = ?');
            $stm->execute([$id]);

            $result = true;
        } catch (Exception $e){

        }

        return $result;
    }
}