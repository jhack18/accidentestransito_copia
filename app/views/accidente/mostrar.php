<div id="page-wrapper">
    <div class="row">
        <h1>Accidentes</h1>
        <h5>Gestión de Accidentes<button class="btn btn-xs btn-success" onclick="agregar()">Agregar Accidente</button></h5>

    </div>
    <br>
    <div class="row">
        <table id="usuariosistema" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Motivo Accidente</th>
                <th>Fecha Accidente</th>
                <th>Lugar Accidente</th>
                <th>¿Accidente Fatal?</th>
                <th>Descripcion</th>
                <th>Involucrados</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $j = 1;
            foreach ($model as $m){
                $id_accidente = $m->accidentes_id;
                ?><tr>
                <td><?php echo $j;?></td>
                <td><?php echo $m->causaaccidente_nombre;?></td>
                <td><?php echo $m->accidente_fecha;?></td>
                <td><?php echo $m->calle_nombre;?></td>
                <td><?php echo $m->accidente_fatal;?></td>
                <td><?php echo $m->accidente_descripcion;?></td>
                
                <td>
                    <a href="?c=Involucrado&a=agregar&id=<?php echo $id_accidente;?>"><button class="btn btn-xs btn-warning" > <i class="fa fa-plus"></i></button></a>
                    <ul>
                <?php
                for ($k=0;$k<count($involucrados);$k++){
                    if($involucrados[$k]->accidentes_id == $id_accidente){
                        echo "<li><a data-toggle='modal' onclick='llenar_modal_mostrar(".$involucrados[$k]->involucrado_id.")' data-target='#mostrar'>".$involucrados[$k]->nombre." ".$involucrados[$k]->apellido."</a></li>";
                    }
                }
                ?>
                    </ul>
                  <!-- The Modal -->


                </td>

                <td><button class="btn btn-xs btn-warning" onclick="editar(<?php echo $m->accidentes_id;?>)">Editar</button> <button class="btn btn-xs btn-danger" onclick="preguntarSiNo(<?php echo $m->accidentes_id;?>)">Eliminar</button></td>
                </tr><?php
                $j++;
            }
            ?>

            </tbody>
        </table>
        <div class="modal fade" id="mostrar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Datos del Involucrado:</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div id="contenido_modal" class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

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
        location.href = "?c=Accidente&a=agregar";
    }

    function editar(id_usuario){
        var id = id_usuario;
        location.href = "?c=Accidente&a=editar&id=" + id;
    }

    function preguntarSiNo(id){
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este accidente?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id_accidente){
        var id = id_accidente;
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "?c=Accidente&a=eliminar",
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
    function llenar_modal_mostrar(id){
        $.post("index.php?c=Involucrado&a=listar_involucrado_por_id",{id:id},function(data){
            $("#contenido_modal").html(data);
        });
    }

</script>