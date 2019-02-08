<div id="page-wrapper">
    <div class="row">
        <h1>Delincuentes <small>Editar Delincuente</small></h1>
    </div>
    <div class="row form-group">
        <input type="text" id="id" value="<?php echo $delincuentes->id;?>" style="visibility: hidden;">
        <div class="col-lg-2">
            <label>Nombre Delincuente</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="delincuente_nombre" value="<?php echo $delincuentes->nombre;?>" placeholder="Escriba su Nombre" style="width: 200px;">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Apellido Paterno</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="delincuente_apellidop" placeholder="Escriba su Apellido Paterno" value="<?php echo $delincuentes->apellidop;?>" style="width: 200px;">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Apellido Materno</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="delincuente_apellidom" placeholder="Escriba su Apellido Materno" value="<?php echo $delincuentes->apellidom;?>" style="width: 200px;">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <button class="btn btn-success" onclick="agregar()">Editar Delincuente</button>
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
        var id = $('#id').val();
        var nombre = $('#delincuente_nombre').val();
        var apellidop = $('#delincuente_apellidop').val();
        var apellidom = $('#delincuente_apellidom').val();


        if(nombre == ""){
            alertify.error('El campo Nombre  está vacío');
            $('#delincuente_nombre').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#delincuente_nombre').css('border','');
        }

        if(apellidop == ""){
            alertify.error('El campo Apellido Paterno  está vacío');
            $('#delincuente_apellidop').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#delincuente_apellidop').css('border','');
        }

        if(apellidom == ""){
            alertify.error('El campo Apellido Materno  está vacío');
            $('#delincuente_apellidom').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#delincuente_apellidom').css('border','');
        }



        if (valor == "correcto"){
            var cadena = "id=" + id +
                "&nombre=" + nombre +
                "&apellidop=" + apellidop +
                "&apellidom=" + apellidom;
            $.ajax({
                type:"POST",
                url:"index.php?c=Delincuente&a=guardar",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '?c=Delincuente&a=mostrar';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }
    }
</script>