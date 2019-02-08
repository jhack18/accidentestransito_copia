<div id="page-wrapper">
    <div class="row">
        <h1>Bitacora</h1>
        <h5>Acciones Realizadas en el Sistema</h5>

    </div>
    <br>
    <div class="row">
        <table id="usuariosistema" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Identificacion de Usuario</th>
                <th>Tipo Acción</th>
                <th>IP</th>
                <th>Acción en el Sistema</th>
                <th>Fecha y Hora</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $a = count($model);
            foreach ($model as $m){
                ?><tr>
                <td><?php echo $a;?></td>
                <td><?php echo $m->usuario_nickname;?></td>
                <td><?php echo $m->bitacora_tipo;?></td>
                <td><?php echo $m->bitacora_ip;?></td>
                <td><?php echo $m->bitacora_accion;?></td>
                <td><?php echo $m->bitacora_fecha;?></td>
                </tr><?php
                $a--;
            }
            ?>

            </tbody>
        </table>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<!-- jQuery -->

<!--Cierre de div ubicado en navbar-->
</div>
<!-- /#wrapper -->
<!--Funciones Jquery-->

<script type="text/javascript">
    $('#usuariosistema').DataTable();
    function agregar(){
        location.href = "?c=Usuario&a=agregar";
    }

    function editar(id_usuario){
        var id = id_usuario;
        location.href = "?c=Usuario&a=editar&id=" + id;
    }

    function preguntarSiNo(id){
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este usuario?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id_usuario){
        var id = id_usuario;
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "?c=Usuario&a=eliminar",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Usuario Eliminado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }


</script>