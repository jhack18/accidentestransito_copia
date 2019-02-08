<div id="page-wrapper">
    <div class="row">
        <h1>Distrito</h1>
        <h5>Gestión de Distritos    <button class="btn btn-xs btn-success" onclick="agregar()">Agregar Distrito</button></h5>

    </div>
    <br>
    <div class="row">
        <table id="distritomostrar" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Código Distrito</th>
                <th>Nombre Distrito</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($model as $m){
                ?><tr>
                    <td><?php echo $m->distrito_id;?></td>
                    <td><?php echo $m->distrito_nombre;?></td>

                    <td><button class="btn btn-xs btn-warning" onclick="editar(<?php echo $m->distrito_id;?>)">Editar</button> <button class="btn btn-xs btn-danger" onclick="preguntarSiNo(<?php echo $m->distrito_id;?>)">Eliminar</button></td>
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
    $('#distritomostrar').DataTable();
    function agregar(){
        location.href = "?c=Distrito&a=agregar";
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