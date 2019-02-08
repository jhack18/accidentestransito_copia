
<div id="page-wrapper">
    <div class="row">
        <h1>Distrito <small>Agregar Distrito</small></h1>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Nombre Distrito</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="distrito_nombre" placeholder="Escriba su Distrito" style="width: 200px;">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <button class="btn btn-success" onclick="agregar()">Agregar Distrito</button>
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
        var nombre = $('#distrito_nombre').val();


        if(nombre == ""){
            alertify.error('El campo Nombre  está vacío');
            $('#distrito_nombre').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#distrito_nombre').css('border','');
        }
        if (valor == "correcto"){
            var cadena = "nombre=" + nombre;
            $.ajax({
                type:"POST",
                url:"index.php?c=Distrito&a=guardar",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '?c=Distrito&a=mostrar';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }
    }
</script>
