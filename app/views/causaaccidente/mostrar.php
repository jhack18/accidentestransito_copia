<div id="page-wrapper">
    <div class="row">
        <h1>Causa Accidente</h1>
        <h5>Gestión de CausaAccidente    <button class="btn btn-xs btn-success" onclick="agregar()">Agregar Causa Accidente</button></h5>

    </div>
    <br>
    <div class="row">
        <table id="exampledd" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Accidente</th>
                <th>Descripcion</th>
                <th>Icono</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($model as $m){
                ?><tr>
                <td><?php echo $m->causaaccidente_id;?></td>
                <td><?php echo $m->causaaccidente_nombre;?></td>
                <td><?php echo $m->causaaccidente_descripcion;?></td>
                <td><?php echo $m->imagen;?></td>
                <td><button class="btn btn-xs btn-warning" onclick="editar(<?php echo $m->causaaccidente_id;?>)">Editar</button> <button class="btn btn-xs btn-danger" onclick="preguntarSiNo(<?php echo $m->causaaccidente_id;?>)">Eliminar</button></td>
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
    $('#exampledd').DataTable(); //para buscar en causa accidente
    function agregar(){
        location.href = "?c=CausaAccidente&a=agregar";
    }

    function editar(id_accidente){
        var id = id_accidente;
        location.href = "?c=CausaAccidente&a=editar&id=" + id;
    }

    function preguntarSiNo(id){
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar esta fila?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id_accidente){
        var id = id_accidente;
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "?c=CausaAccidente&a=eliminar",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Accidente Eliminado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }
</script>