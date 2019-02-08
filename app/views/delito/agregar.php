<div id="page-wrapper">
    <div class="row">
        <h1>Tipo de Delito <small>Agregar Tipo de Delito</small></h1>
    </div>
    <form action="index.php?c=Delito&a=guardar" method="post" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Tipo de Delito</label>
            </div>
            <div class="col-lg-3">
                <input type="text" id="delito_nombre" name="nombre" placeholder="Escriba su Delito" style="width: 200px;" required>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-2">
                <label>Descripcion Delito</label>
            </div>
            <div class="col-lg-3">
                <textarea id="delito_descripcion" name="descripcion" placeholder="Escriba su Descripcion" style="width: 200px;" cols="4" required></textarea>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-2">
                <label>Icono</label>
            </div>
            <div class="col-lg-3">
                <input type="file" id="delito_icono" name="imagen" required>

            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-2">
                <button class="btn btn-success" type="submit">Agregar Delito</button>
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
        var nombre = $('#delito_nombre').val();
        var descripcion = $('#delito_descripcion').val();


        if(nombre == ""){
            alertify.error('El campo Nombre  está vacío');
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
                "&descripcion=" + descripcion;
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
