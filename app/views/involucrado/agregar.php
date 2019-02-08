<?php $id_accidente = $_GET['id'] ?>
<div id="page-wrapper">
    <div class="row">
        <h1>Involucrado <small>Agregar Involucrado</small></h1>
    </div>

    <form>
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Cod. Accidente</label>
            </div>
            <div class="col-lg-3">
                <input type="text" id="id_accidente" readonly value="<?php echo $id_accidente;?>"> 
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-2">
                <label>Nombre</label>
            </div>
            <div class="col-lg-3">
                <input type="text" id="nombre" name="nombre" placeholder="Escriba su nombre" style="width: 200px;">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Apellido</label>
            </div>
            <div class="col-lg-3">
                <input type="text" id="apellido" name="apellido" placeholder="Escriba su apellido" style="width: 200px;">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Dni</label>
            </div>
            <div class="col-lg-3">
                <input type="text" id="dni" name="dni" placeholder="Escriba su dni" style="width: 200px;">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Licencia</label>
            </div>
            <div class="col-lg-3">
                <input type="text" id="licencia" name="licencia" placeholder="Escriba su licencia" style="width: 200px;">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Contacto</label>
            </div>
            <div class="col-lg-3">
                <input type="text" id="contacto" name="contacto" placeholder="Escriba su contacto" style="width: 200px;">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Tipo de Involucrado</label>
            </div>
            <div class="col-lg-3">
                <select id="tipo_involucrado" style="width: 200px;">
                    <option value="agraviado">AGRAVIADO</option>
                    <option value="agraviante">AGRAVIANTE</option>
                    <option value="testigo">TESTIGO</option>
                </select>
            </div>
        </div>
        

        <div class="row form-group">
            <div class="col-lg-2">
                <button class="btn btn-success" onclick="agregar()" type="submit">Agregar Involucrado</button> <buton class="btn
                btn-danger" onClick="finalizar()" type="submit">Finalizar</buton>
            </div>
        </div>
    <!-- /.row -->
    </form>


</div>
<!-- /#page-wrapper -->
<!--Cierre de div ubicado en navbar-->
</div>
<!-- /#page-wrapper -->
<!--Cierre de div ubicado en navbar-->
<!--Funciones Jquery-->
<script type="text/javascript">
    function notificar(){
        alertify.success('Chevere');
    }

    function agregar() {
        var valor = "correcto";
        var id_accidente = $('#id_accidente').val();
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var dni = $('#dni').val();
        var licencia = $('#licencia').val();
        var contacto = $('#contacto').val();
        var tipo_involucrado = $('#tipo_involucrado').val();

        if(nombre == ""){
            alertify.error('El campo Fecha está vacío');
            $('#nombre').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#nombre').css('border','');
        }

        if(apellido == ""){
            alertify.error('El campo Fecha está vacío');
            $('#apellido').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#apellido').css('border','');
        }

        if(dni == ""){
            alertify.error('El campo Nombre  está vacío');
            $('#dni').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#dni').css('border','');
        }
        if(licencia == ""){
            alertify.error('El campo Nombre  está vacío');
            $('#licencia').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#licencia').css('border','');
        }
        if(contacto == ""){
            alertify.error('El campo Nombre  está vacío');
            $('#contacto').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#contacto').css('border','');
        }


        if (valor == "correcto"){
            var cadena = "nombre=" + nombre +
                        "&apellido=" + apellido +
                        "&dni=" + dni +
                        "&licencia=" + licencia +
                        "&contacto=" + contacto+
                        "&tipo_involucrado=" + tipo_involucrado+
                        "&id_accidente=" + id_accidente;
                        
            $.ajax({
                type:"POST",
                url:"index.php?c=Involucrado&a=guardar",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se Guardo Correctamente");
                        //setTimeout(function () {
                            location.href = '?c=Involucrado&a=agregar&id='+ id_accidente;
                        //},200);
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }
    }

    function finalizar() {

        location.href = '?c=Accidente&a=mostrar';
    }
</script>