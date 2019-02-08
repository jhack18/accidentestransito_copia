<div id="page-wrapper">
    <div class="row">
        <h1>Tipo deDelitos</h1>
        <h5>Gestión de Tipo de Delitos    <button class="btn btn-xs btn-success" onclick="agregar()">Agregar Tipo de Delito</button></h5>

    </div>
    <br>
    <div class="row">
        <table id="delitotabla" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Delito</th>
                <th>Descripcion</th>
                <th>Icono</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($model as $m){
                ?><tr>
                <td><?php echo $m->delito_id;?></td>
                <td><?php echo $m->delito_nombre;?></td>
                <td><?php echo $m->delito_descripcion;?></td>
                <td><?php echo $m->imagen;?></td>

                <td><button class="btn btn-xs btn-warning" onclick="editar(<?php echo $m->delito_id;?>)">Editar</button> <button class="btn btn-xs btn-danger" onclick="preguntarSiNo(<?php echo $m->delito_id;?>)">Eliminar</button></td>
                </tr><?php
            }
            ?>

            </tbody>
        </table>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<!--Cierre de div ubicado en navbar-->
</div>
<!-- /#wrapper -->
<!--Funciones Jquery-->
<script type="text/javascript">
    $('#delitotabla').DataTable();
    function agregar(){
        location.href = "?c=delito&a=agregar";
    }

    function editar(id_usuario){
        var id = id_usuario;
        location.href = "?c=delito&a=editar&id=" + id;
    }

    function preguntarSiNo(id){
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este delito?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id_delito){
        var id = id_delito;
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "?c=delito&a=eliminar",
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