<button  value="<?php echo $id_robo; ?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#mostrar">Involucrado</button>

<!-- The Modal -->
<div class="modal fade" id="mostrar">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
        <table id="distritomostrar" class="table table-bordered table-hover table-striped">
          <thead>
          <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>DNI</th>
              <th>Nº de contacto</th>
              <th>Nº de licencia</th>
              <th>Acciones</th>
          </tr>
          </thead>
          <tbody>
            <?php
              foreach ($model as $m){
                $id_involucrado = $m->id_involucrado;
                ?><tr>
                    <td><?php echo $m->nombre;?></td>
                    <td><?php echo $m->apellido;?></td>
                    <td><?php echo $m->dni;?></td>
                    <td><?php echo $m->n_contacto;?></td>
                    <td><?php echo $m->n_licencia;?></td>

                    <td><button class="btn btn-xs btn-warning" onclick="editar(<?php echo $id_involucrado;?>)">Editar</button> <button class="btn btn-xs btn-danger" onclick="preguntarSiNo(<?php echo $id_involucrado;?>)">Eliminar</button></td>
                </tr><?php
            }
            ?>

          </tbody>
        </table>
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        
                      </div>
                    </div>
                  </div>
<script type="text/javascript">
    $('#usuariosistema').DataTable();
    function agregar(){
        location.href = "?c=Robo&a=agregar";
    }
    /*function mostrar(){
        location.href = "?c=Involucrado&a=mostrar";
    }*/

    function editar(id_usuario){
        var id = id_usuario;
        location.href = "?c=Robo&a=editar&id=" + id;
    }

    function preguntarSiNo(id){
        alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este robo?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id_accidente){
        var id = id_accidente;
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "?c=Involucrado&a=eliminar",
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