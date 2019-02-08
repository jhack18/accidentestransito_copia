<div id="page-wrapper">
    <div class="row">
        <h1>Arma <small>Agregar Arma</small></h1>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Nombre Arma</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="arma_nombre" placeholder="Escriba su Distrito" style="width: 200px;">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Descripcion Arma</label>
        </div>
        <div class="col-lg-3">
            <textarea type="text" id="arma_descripcion" placeholder="Escriba su Descripcion" style="width: 200px;"  cols="4"></textarea>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <button class="btn btn-success" onclick="agregar()">Agregar Arma</button>
        </div>
    </div>
    <!-- /.row -->


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
        var nombre = $('#arma_nombre').val();
        var descripcion = $('#arma_descripcion').val();

        if(nombre == ""){
            alertify.error('El campo Nombre está vacío');
            $('#arma_nombre').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#arma_nombre').css('border','');
        }

        if(descripcion == ""){
            alertify.error('El campo Descripcion está vacío');
            $('#arma_descripcion').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#arma_descripcion').css('border','');
        }


        if (valor == "correcto"){
            var cadena = "nombre=" + nombre +
                "&descripcion=" + descripcion;
            $.ajax({
                type:"POST",
                url:"index.php?c=Arma&a=guardar",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '?c=Arma&a=mostrar';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }
    }
</script>
