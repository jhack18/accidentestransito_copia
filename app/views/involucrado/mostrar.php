<!--<div id="page-wrapper">-->
<div class="row">
        <table id="involucradomostrar" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Nº de contacto</th>
                <th>Nº de licencia</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($model as $m){
                ?><tr>
                    <td><?php echo $m->nombre;?></td>
                    <td><?php echo $m->apellido;?></td>
                    <td><?php echo $m->dni;?></td>
                    <td><?php echo $m->contacto;?></td>
                    <td><?php echo $m->licencia;?></td>
                    <td><?php echo $m->tipo;?></td>

                    <td><button class="btn btn-xs btn-warning" onclick="editar(<?php echo $m->involucrado_id;?>)">Editar</button> <button class="btn btn-xs btn-danger" onclick="preguntarSiNo(<?php echo $m->involucrado_id;?>)">Eliminar</button></td>
                </tr><?php
            }
            ?>

            </tbody>
        </table>
    </div>
    <!-- /.row -->

<!-- /#page-wrapper -->

<!--Cierre de div ubicado en navbar-->
</div>
<!-- /#wrapper -->
<!--Funciones Jquery-->
<script type="text/javascript">
    $('#involucradomostrar').DataTable();
    function agregar(){
        location.href = "?c=Involucrado&a=agregar";
    }

    function editar(id_usuario){
        var id = id_usuario;
        location.href = "?c=Distrito&a=editar&id=" + id;
    }

    function preguntarSiNo(id){
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este distrito?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id_distrito){
        var id = id_distrito;
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "?c=Distrito&a=eliminar",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Distrito Eliminado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }
</script>