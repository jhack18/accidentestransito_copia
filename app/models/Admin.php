<?php

use Exception;
require_once 'core/Database.php';

class Admin{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function loguear($usuario, $contrasenha){
        $result = new Admin;

        try {
            $stm = $this->pdo->prepare('select * from usuario u inner join rol r on u.rol_id = r.rol_id inner join plataforma p on r.plataforma_id = p.plataforma_id where u.usuario_nickname = ? and u.usuario_contrasenha = ? and p.plataforma_id = "1"');
            $stm->execute([$usuario, $contrasenha]);

            $fecht = $stm->fetch();

            $result->id = $fecht->usuario_id;
            $result->nombre = $fecht->usuario_nombre;
            $result->apellido = $fecht->usuario_apellido;
            $result->dni = $fecht->usuario_dni;
            $result->nickname = $fecht->usuario_nickname;
            $result->contrasenha = $fecht->usuario_contrasenha;
            $result->rol = $fecht->rol_nombre;

        } catch (Exception $e){

        }

        return $result;
    }


}