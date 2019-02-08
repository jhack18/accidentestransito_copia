<?php
use Exception;
require_once 'core/Database.php';

class Distrito{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from distrito');
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }

    public function obtener($id){
        $result = new Distrito();

        try {
            $stm = $this->pdo->prepare('select * from distrito where distrito_id = ?');
            $stm->execute([$id]);

            $fecht = $stm->fetch();

            $result->id = $fecht->distrito_id;
            $result->nombre = $fecht->distrito_nombre;


        } catch (Exception $e){

        }

        return $result;
    }

    public function guardar($model){
        $result = 2;

        try {

            if(empty($model->id)){
                $sql = 'insert into distrito(
                    distrito_nombre
                    ) values(?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,

                ]);

            } else {
                $sql = "update distrito
                set
                distrito_nombre= ?
                where distrito_id = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
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
            $stm = $this->pdo->prepare('delete from distrito where distrito_id = ?');
            $stm->execute([$id]);

            $result = true;
        } catch (Exception $e){

        }

        return $result;
    }
}