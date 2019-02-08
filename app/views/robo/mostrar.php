<div id="page-wrapper">
    <div class="row">
        <h1>Delitos</h1>
        <h5>Gestión de Delito<button class="btn btn-xs btn-success" onclick="agregar()">Agregar Delito</button></h5>

    </div>
    <br>
    <div class="row">
        <table id="usuariosistema" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Descripcion</th>
                <th>Lugar</th>
                <th>Arma</th>
                <th>Delito</th>
                <th>Involucrado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $j = 1;
            foreach ($model as $m){

                ?><tr>
                <td><?php echo $j;?></td>
                <td><?php echo $m->robos_fecha;?></td>
                <td><?php echo $m->robos_descripcion;?></td>
                <td><?php echo $m->calle_nombre;?></td>
                <td><?php echo $m->arma_nombre;?></td>
                <td><?php echo $m->delito_nombre;?></td>
                <td>
                    <ul>
                    <?php 
                    //for ($k=0; $k <count($involucrados) ; $k++)
                    foreach($involucrados as $d)
                    { 
                        //if ($involucrados[$k]->robos_id==$m->robos_id) 
                        if ($d->robos_id==$m->robos_id) 
                        {
                           echo "<li><a data-toggle='modal' onclick='llenar_modal_mostrar(".$d->involucrado_id.")' data-target='#mostrar'>".$d->nombre." ".$d->apellido."</a></li>";

                        }
                    }
                     ?>
                    </ul>
                        <a href="?c=Involucrado&a=agregar_del&id=<?php echo $m->robos_id;?>"><i class="fa fa-plus" >Agregar</i></a>
                </td>
                <td>
                    <button class="btn btn-xs btn-warning" onclick="editar(<?php echo $m->robos_id;?>)"><i class="fa fa-pencil"></i> Editar</button>
                </td>
                </tr><?php
                $j++;
            }
            ?>

            </tbody>
        </table>
    </div>
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
             <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
      </div>
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
        location.href = "?c=Robo&a=agregar";
    }

    function editar(id_usuario){
        var id = id_usuario;
        location.href = "?c=Robo&a=editar&id=" + id;
    }

    function preguntarSiNo(id){
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este robo?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id_accidente)
    {
        var id = id_accidente;
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "?c=Robo&a=eliminar",
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
        $.post("index.php?c=Involucrado&a=listar_involucrado_por_id_del",{id:id},function(data){
            $("#contenido_modal").html(data);
        });
    }


</script>