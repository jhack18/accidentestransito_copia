<?php $id_robo = $_GET['id']; ?>
<div id="page-wrapper">
    
    <div class="row">
        <h1>Involucrado <small>Agregar Involucrado</small></h1>
    </div>
<form>

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Cod. Delito</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="id_robo" readonly value="<?php echo $id_robo;?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Nombre del involucrado</label>
        </div>
        <div class="col-lg-3">

            <input id="nombre" placeholder="Escriba su nombre" style="width: 200px;" ></input>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Apellido del involucrado</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="apellido" placeholder="Escriba su Apellido" style="width: 200px;">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>DNI del involucrado</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="dni" placeholder="Escriba su DNI" style="width:200px;" maxlength="8" minlength="8" pattern="[0-9]+" >
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Nº de contacto</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="contacto" placeholder="Nº de contacto" style="width: 200px;">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Nº de licencia</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="licencia" placeholder="Escriba su Nº de licencia" style="width: 200px;">
        </div>
    </div>
        <div class="row form-group">
        <div class="col-lg-2">
            <label>Tipo </label>
        </div>
        <div class="col-lg-3">
           <select id="tipo" style="width: 200px;">
                <option value="agraviado">agraviado</option>
                 <option value="agraviante">agraviante</option>
                <option value="testigo">testigo</option>                 
            </select>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <button class="btn btn-success" onclick="agregar()" type="submit">Agregar Involucrado</button>
        </div>
    </div>
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
        var id_robo = $('#id_robo').val();
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var dni = $('#dni').val();
        var contacto = $('#contacto').val();
        var licencia = $('#licencia').val();
        var tipo = $('#tipo').val();
        

        if(nombre == ""){
            alertify.error('El campo Nombre está vacío');
            $('#nombre').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#nombre').css('border','');
        }

        if(apellido == ""){
            alertify.error('El campo /*Apellido está vacío');
            $('#apellido').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#apellido').css('border','');
        }
        if(dni == ""){
            alertify.error('El campo DNI  está vacío');
            $('#dni').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#dni').css('border','');
        }
        if(contacto == ""){
            alertify.error('El campo contacto  está vacío');
            $('#contacto').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#contacto').css('border','');
        }
        if(licencia == ""){
            alertify.error('El campo licencia  está vacío');
            $('#licencia').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#licencia').css('border','');
        }
        /*if(tipo == ""){
            alertify.error('El campo tipo  está vacío');
            $('#tipo').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#tipo').css('border','');
        }*/


        if (valor == "correcto"){
            var cadena = "id_robo=" + id_robo +
                "&nombre=" + nombre +
                "&apellido=" + apellido +
                "&dni=" + dni +
                "&contacto=" + contacto +
                "&licencia=" + licencia +
                "&tipo="+tipo;
            $.ajax({
                type:"POST",
                url:"index.php?c=Involucrado&a=guardar_del",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '?c=Involucrado&a=agregar_del';
                    } else {
                        alertify.error(r);
                    }
                }
            });
        }
    }
</script>