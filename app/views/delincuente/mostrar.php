<div id="page-wrapper">
    <div class="row">
        <h1>Distrito</h1>
        <h5>Gestión de Delincuentes<button class="btn btn-xs btn-success" onclick="agregar()">Agregar Delincuente</button></h5>

    </div>
    <br>
    <div class="row">
        <table id="distritomostrar" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $a = 1;
            foreach ($model as $m){
                ?><tr>
                <td><?php echo $a;?></td>
                <td><?php echo $m->delincuentes_nombres;?></td>
                <td><?php echo $m->delincuentes_apellidopaterno;?></td>
                <td><?php echo $m->delincuentes_apellidomaterno;?></td>
                <td><button class="btn btn-xs btn-warning" onclick="editar(<?php echo $m->delincuentes_id;?>)">Editar</button> <button class="btn btn-xs btn-danger" onclick="preguntarSiNo(<?php echo $m->delincuentes_id;?>)">Eliminar</button></td>
                </tr><?php
                $a++;
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
    $('#distritomostrar').DataTable();
    function agregar(){
        location.href = "?c=Delincuente&a=agregar";
    }

    function editar(id_usuario){
        var id = id_usuario;
        location.href = "?c=Delincuente&a=editar&id=" + id;
    }

    function preguntarSiNo(id){
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este delincuente?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id_distrito){
        var id = id_distrito;
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "?c=Delincuente&a=eliminar",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Delincuente Eliminado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }
</script>