<div id="page-wrapper">
    <div class="row">
        <h1>Usuarios</h1>
        <h5>Gestión de Usuarios    <button class="btn btn-xs btn-success" onclick="agregar()">Agregar Usuario</button></h5>

    </div>
    <br>
    <div class="row">
        <table id="usuariosistema" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dni</th>
                <th>Nickname</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($model as $m){
                ?><tr>
                    <td><?php echo $m->usuario_nombre;?></td>
                    <td><?php echo $m->usuario_apellido;?></td>
                    <td><?php echo $m->usuario_dni;?></td>
                    <td><?php echo $m->usuario_nickname;?></td>
                    <td><?php echo $m->usuario_contrasenha;?></td>
                    <td><?php echo $m->rol_nombre;?></td>
                    <td><button class="btn btn-xs btn-warning" onclick="editar(<?php echo $m->usuario_id;?>)">Editar</button> <button class="btn btn-xs btn-danger" onclick="preguntarSiNo(<?php echo $m->usuario_id;?>)">Eliminar</button></td>
                </tr><?php
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