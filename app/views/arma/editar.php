<div id="page-wrapper">
    <div class="row">
        <h1>Arma <small>Editar   Arma</small></h1>
    </div>
    <input type="text" id="id_arma" value="<?php echo $arma->id?>" style="visibility: hidden;">

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Editar Arma</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="arma_nombre"  value="<?php echo $arma->nombre?>" placeholder="Escriba su Arma" style="width: 200px;">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Editar Arma</label>
        </div>
        <div class="col-lg-2">
            <textarea id="arma_descripcion" placeholder="Escriba su Descripcion" style="width: 200px;" cols="4"><?php echo $arma->descripcion?></textarea>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <button class="btn btn-success" onclick="agregar()">Editar Arma</button>
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
        var id = $('#id_arma').val();
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
                "&descripcion=" + descripcion +
                "&id=" + id;
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