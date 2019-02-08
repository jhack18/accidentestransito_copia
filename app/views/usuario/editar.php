
<div id="page-wrapper">
    <div class="row">
        <h1>Usuario <small>Agregar Usuario</small></h1>
    </div>
    <div class="row form-group">
        <input type="text" id="id_user" value="<?php echo $usuario->id;?>" style="visibility: hidden;">
        <div class="col-lg-2">
            <label>Nombre</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="usuario_nombre" placeholder="Escriba su Nombre" value="<?php echo $usuario->nombre;?>" style="width: 200px;">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Apellido</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="usuario_apellido" placeholder="Escriba su Apellido" value="<?php echo $usuario->apellido;?>" style="width: 200px;">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>DNI</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="usuario_dni" maxlength="8" placeholder="Escriba su DNI" value="<?php echo $usuario->dni;?>" style="width: 200px;">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Nickname</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="usuario_nickname" placeholder="Escriba su Nickname" value="<?php echo $usuario->nickname;?>" style="width: 200px;">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Contraseña</label>
        </div>
        <div class="col-lg-3">
            <input type="password" id="usuario_contrasenha" placeholder="Escriba su Contraseña" value="<?php echo $usuario->contrasenha;?>" style="width: 200px;">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Repetir Contraseña</label>
        </div>
        <div class="col-lg-3">
            <input type="password" id="usuario_contrasenha2" placeholder="Escriba su Contraseña" value="<?php echo $usuario->contrasenha;?>" style="width: 200px;">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Rol</label>
        </div>
        <div class="col-lg-3">
            <select id="usuario_rol" style="width: 200px;">
                <?php
                foreach ($roles as $rol){
                    ?>
                    <?php
                    $role = $usuario->rol;
                    ?>
                    <option <?php echo $role == $rol->rol_id ? 'selected' : '';?> value="<?php echo $rol->rol_id; ?>" ><?php echo $rol->rol_nombre . ' - ' . $rol->plataforma_nombre; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <button class="btn btn-success" onclick="editar()">Editar Usuario</button>
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

    function editar() {
        var valor = "correcto";
        var id = $('#id_user').val();
        var nombre = $('#usuario_nombre').val();
        var apellido = $('#usuario_apellido').val();
        var dni = $('#usuario_dni').val();
        var nickname = $('#usuario_nickname').val();
        var contrasenha = $('#usuario_contrasenha').val();
        var contrasenha2 = $('#usuario_contrasenha2').val();
        var rol = $('#usuario_rol').val();

        if(nombre == ""){
            alertify.error('El campo Nombre  está vacío');
            $('#usuario_nombre').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#usuario_nombre').css('border','');
        }

        if(apellido == ""){
            alertify.error('El campo Apellido  está vacío');
            $('#usuario_apellido').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#usuario_apellido').css('border','');
        }
        if(dni == ""){
            alertify.error('El campo DNI está vacío');
            $('#usuario_dni').css('border','solid red');
            valor = "incorrecto";
        } else {
            if(dni.length !== 8){
                alertify.error('El campo DNI no contiene 8 caracteres');
                $('#usuario_dni').css('border','solid red');
                valor = "incorrecto";
            } else {
                $('#usuario_dni').css('border','');
            }
        }

        if(nickname == ""){
            alertify.error('El campo Nickname está vacío');
            $('#usuario_nickname').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#usuario_nickname').css('border','');
        }

        if(contrasenha == ""){
            alertify.error('El campo Contraseña está vacío');
            $('#usuario_contrasenha').css('border','solid red');
            $('#usuario_contrasenha2').css('border','solid red');
            valor = "incorrecto";
        } else {
            if(contrasenha === contrasenha2){
                $('#usuario_contrasenha').css('border','');
                $('#usuario_contrasenha2').css('border','');
            } else {
                alertify.error('Las contraseñas no coinciden');
                $('#usuario_contrasenha').css('border','solid red');
                $('#usuario_contrasenha2').css('border','solid red');
                valor = "incorrecto";
            }
        }

        if (valor == "correcto"){
            var cadena = "nombre=" + nombre +
                "&apellido=" + apellido +
                "&dni=" + dni +
                "&nickname=" + nickname +
                "&contrasenha=" + contrasenha +
                "&rol=" + rol +
                "&id=" + id;
            $.ajax({
                type:"POST",
                url:"index.php?c=Usuario&a=guardar",
                data: cadena,
                success:function (r) {
                    switch (r){
                        case "1":
                            alertify.success("Se envió chevere");
                            location.href = '?c=Usuario&a=mostrar';
                            break;
                        case "2":
                            alertify.error("El DNI ingresado ya existe en el sistema");
                            $('#usuario_dni').css('border','solid red');
                            break;
                        case "3":
                            alertify.error("El nickname ingresado ya existe en el sistema");
                            $('#usuario_nickname').css('border','solid red');
                            break;
                        default:
                            alertify.error("Fallo el envio");
                    }
                }
            });
        }
    }
</script>
