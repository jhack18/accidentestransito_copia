<div id="page-wrapper">
    <div class="row">
        <h1>Delito <small>Editar Delito</small></h1>
    </div>
    <form action="index.php?c=Delito&a=guardaredicion" method="post" enctype="multipart/form-data">
        <input type="text" id="id_delito" value="<?php echo $delito->id;?>" name="id"  style="visibility: hidden;">
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Editar Delito</label>
            </div>
            <div class="col-lg-3">
                <input type="text" id="delito_nombre" name="nombre"  value="<?php echo $delito->nombre;?>" placeholder="Escriba su Delito" style="width: 200px;" required >
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-2">
                <label>Editar Descripcion</label>
            </div>
            <div class="col-lg-2">
                <textarea type="text" id="delito_descripcion" name="descripcion"  placeholder="Escriba su Descripcion" style="width: 200px;" cols="4"><?php echo $delito->descripcion;?> required</textarea>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-2">
                <label>Icono (Sólo si va a modificar)</label>
            </div>
            <div class="col-lg-3">
                <input type="file" id="delito_icono" name="imagen" required>

            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-2">
                <input type="text" name="imagena" value="<?php echo $delito->imagen;?>" style="display: none;">
                <button  class="btn btn-success" type="submit" >Editar Delito</button>
            </div>
        </div>
        <!-- /.row -->
    </form>


</div>
<!-- /#page-wrapper -->
<!--Cierre de div ubicado en navbar-->
</div>
<!-- /#wrapper -->
<!--Funciones Jquery-->
<script type="text/javascript">
    function notificar(){
        alertify.success('Chevere');
    }

    function agregar() {
        var valor = "correcto";
        var id = $('#id_delito').val();
        var nombre = $('#delito_nombre').val();
        var descripcion = $('#delito_descripcion').val();

        if(nombre == ""){
            alertify.error('El campo Nombre está vacío');
            $('#delito_nombre').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#delito_nombre').css('border','');
        }

        if(descripcion == ""){
            alertify.error('El campo Descripcion está vacío');
            $('#delito_descripcion').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#delito_descripcion').css('border','');
        }



        if (valor == "correcto"){
            var cadena = "nombre=" + nombre +
                "&descripcion=" + descripcion +
                "&id=" + id;
            $.ajax({
                type:"POST",
                url:"index.php?c=Delito&a=guardar",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '?c=Delito&a=mostrar';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }
    }
</script>