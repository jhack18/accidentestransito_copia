<?php

use Exception;
require_once 'core/Database.php';

class Usuario{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from usuario u inner join rol r on u.rol_id = r.rol_id inner join plataforma p on r.plataforma_id = p.plataforma_id where p.plataforma_id = "1"');
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }

    public function obtener($id){
        $result = new Usuario;

        try {
            $stm = $this->pdo->prepare('select * from usuario u inner join rol r on u.rol_id = r.rol_id inner join plataforma p on r.plataforma_id = p.plataforma_id where u.usuario_id = ?');
            $stm->execute([$id]);

            $fecht = $stm->fetch();

            $result->id = $fecht->usuario_id;
            $result->nombre = $fecht->usuario_nombre;
            $result->apellido = $fecht->usuario_apellido;
            $result->dni = $fecht->usuario_dni;
            $result->nickname = $fecht->usuario_nickname;
            $result->contrasenha = $fecht->usuario_contrasenha;
            $result->rol = $fecht->rol_id;

        } catch (Exception $e){

        }

        return $result;
    }

    public function guardar($model){
        $result = 4;
        try {
            if(empty($model->id)){
                $sql = 'insert into usuario(
                    usuario_nombre,
                    usuario_apellido,
                    usuario_dni,
                    usuario_nickname,
                    usuario_contrasenha,
                    rol_id
                    ) values(?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $model->apellido,
                    $model->dni,
                    $model->nickname,
                    $model->contrasenha,
                    $model->rol
                ]);
                $result = 1;
            } else {
                $sql = "
                    update usuario
                    set
                    usuario_nombre = ?,
                    usuario_apellido=?,
                    usuario_dni = ?,
                    usuario_nickname = ?,
                    usuario_contrasenha = ?,
                    rol_id = ?
                    where usuario_id = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->nombre,
                    $model->apellido,
                    $model->dni,
                    $model->nickname,
                    $model->contrasenha,
                    $model->rol,
                    $model->id
                ]);
                $result = 1;
            }

        } catch (Exception $e){
            //throw new Exception($e->getMessage());
        }
        return $result;
    }

    public function consultardni($dni){
        $result = false;
        try {
            $sql = 'SELECT usuario_id FROM `usuario` WHERE usuario_dni = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$dni]);
            $fecht = $stm->fetch();
            if(!empty($fecht->usuario_id)){
                $result = true;
            }
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
        }
        return $result;
    }

    public function consultarnickname($nickname){
        $result = false;
        try {
            $sql = 'SELECT usuario_id FROM `usuario` WHERE usuario_nickname = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$nickname]);
            $fecht = $stm->fetch();
            if(!empty($fecht->usuario_id)){
                $result = true;
            }
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
        }
        return $result;
    }

    public function eliminar($id){
        $result = false;

        try {
            $stm = $this->pdo->prepare('delete from usuario where usuario_id = ?');
            $stm->execute([$id]);

            $result = true;
        } catch (Exception $e){

        }

        return $result;
    }
}