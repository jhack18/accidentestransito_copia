<?php

use Exception;
require_once 'core/Database.php';

class Rol{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from rol r inner join plataforma p on r.plataforma_id = p.plataforma_id');
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }

    public function obtener($id){
        /*$result = new Empleado;

        try {
            $stm = $this->pdo->prepare('select * from empleado where id = ?');
            $stm->execute([$id]);

            $fecht = $stm->fetch();

            $result->id = $fecht->id;
            $result->nombre = $fecht->nombre;
            $result->apellido = $fecht->apellido;
            $result->fecha_nacimiento = $fecht->fecha_nacimiento;
            $result->profesion_id = $fecht->profesion_id;

        } catch (Exception $e){

        }

        return $result;*/
    }

    public function guardar(Empleado $model){
        /*$result = false;

        try {

            if(empty($model->id)){
                $sql = 'insert into empleado(
                    nombre,
                    apellido,
                    fecha_nacimiento,
                    profesion_id
                    ) values(?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $model->apellido,
                    $model->fecha_nacimiento,
                    $model->profesion_id
                ]);

            } else {
                $sql = "
                update empleado
                set
                nombre = ?,
                apellido=?,
                fecha_nacimiento = ?,
                profesion_id = ?
                where id = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $model->apellido,
                    $model->fecha_nacimiento,
                    $model->profesion_id,
                    $model->id
                ]);

            }
            $result = true;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
        }

        return $result;*/
    }

    public function eliminar($id){
        /*$result = false;

        try {
            $stm = $this->pdo->prepare('delete from empleado where id = ?');
            $stm->execute([$id]);

            $result = true;
        } catch (Exception $e){

        }

        return $result;*/
    }
}