<div id="page-wrapper">
    <div class="row">
        <h1>Armas</h1>
        <h5>Gestión de Armas    <button class="btn btn-xs btn-success" onclick="agregar()">Agregar Arma</button></h5>

    </div>
    <br>
    <div class="row">
        <table id="armatabla" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Arma</th>
                <th>Descripcion</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($model as $m){
                ?><tr>
                <td><?php echo $m->arma_id;?></td>
                <td><?php echo $m->arma_nombre;?></td>
                <td><?php echo $m->arma_descripcion;?></td>

                <td><button class="btn btn-xs btn-warning" onclick="editar(<?php echo $m->arma_id;?>)">Editar</button> <button class="btn btn-xs btn-danger" onclick="preguntarSiNo(<?php echo $m->arma_id;?>)">Eliminar</button></td>
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
    $('#armatabla').DataTable();
    function agregar(){
        location.href = "?c=arma&a=agregar";
    }

    function editar(id_usuario){
        var id = id_usuario;
        location.href = "?c=arma&a=editar&id=" + id;
    }

    function preguntarSiNo(id){
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar esta arma?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id_arma){
        var id = id_arma;
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "?c=arma&a=eliminar",
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