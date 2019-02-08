
<div id="page-wrapper">
    <div class="row">
        <h1>Causa Accidente <small>Editar Causa Accidente</small></h1>
    </div>
    <form action="index.php?c=CausaAccidente&a=guardaredicion" method="post" enctype="multipart/form-data">
        <input type="text" id="id_accidente" name="id" value="<?php echo $accidente->id;?>" style="visibility: hidden;">
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Nombre Accidente</label>
            </div>
            <div class="col-lg-3">
                <input type="text" id="accidente_nombre" name="nombre" value="<?php echo $accidente->nombre;?>"  placeholder="Escriba su Accidente" style="width: 200px;" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Descripcion</label>
            </div>
            <div class="col-lg-3">
                <textarea type="text" id="accidente_descripcion" name="descripcion" placeholder="Escriba su Descripcion"   style="width: 200px;" cols="4" required><?php echo $accidente->descripcion;?></textarea>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-2">
                <label>Icono (Sólo si va a modificar)</label>
            </div>
            <div class="col-lg-3">
                <input type="file" name="imagen" required>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-2">
                <input type="text" name="imagena" value="<?php echo $accidente->imagen;?>" style="display: none;">
                <button class="btn btn-success" type="submit">Editar Accidente</button>
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
        var id = $('#id_accidente').val();
        var nombre = $('#accidente_nombre').val();
        var descripcion = $('#accidente_descripcion').val();

        var cadena = "nombre=" + nombre +
            "&descripcion=" + descripcion +
            "&id=" + id;

        if (valor == "correcto"){
            $.ajax({
                type:"POST",
                url:"index.php?c=CausaAccidente&a=guardar",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '?c=CausaAccidente&a=mostrar';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }
    }
</script>