<?php

use Exception;
require_once 'core/Database.php';

class Bitacora{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $result = [];

        try {
            $stm = $this->pdo->prepare('select * from bitacora b inner join usuario u on b.usuario_id = u.usuario_id order by bitacora_id asc');
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){

        }

        return $result;
    }

    public function guardar($accion, $tipo){
        date_default_timezone_set('America/Lima');
        $fecha = date("Y") . '-' . date("m") . '-' . date('d');

        $hora = date("H") . ':' . date("i") . ':' . date('s');
        $fecha_actual = $fecha . " " . $hora;
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
        } else {
            $id = 1;
        }
        $result = 2;

        $ip = $_SERVER['REMOTE_ADDR'];
        try {
            $sql = 'insert into bitacora(
                  bitacora_accion,
                  bitacora_fecha,
                  usuario_id,
                  bitacora_ip,
                  bitacora_tipo
                    ) values(?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $accion,
                    $fecha_actual,
                    $id,
                    $ip,
                    $tipo
                ]);
                $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            //$a = $e->getMessage();
            //echo "<script language=\"javascript\"> alert('" . $a . "');</script>";
        }
        return $result;
    }
}