<div id="page-wrapper">
    <div class="row">
        <h1>Accidente <small>Agregar Accidente</small></h1>
    </div>
    <form action="index.php?c=CausaAccidente&a=guardar" method="post" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Nombre Accidente</label>
            </div>
            <div class="col-lg-3">
                <input type="text" id="accidente_nombre" name="nombre" placeholder="Escriba su Accidente" style="width: 200px;">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-2">
                <label>Descripcion</label>
            </div>
            <div class="col-lg-3">
                <textarea type="text" id="accidente_descripcion" name="descripcion" placeholder="Escriba su Descripcion"  style="width: 200px;" cols="4"></textarea>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-2">
                <label>Imagen</label>
            </div>
            <div class="col-lg-3">
                <input type="file" id="accidente_imagen" name="imagen" >
            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-2">
                <button class="btn btn-success" type="submit">Agregar Accidente</button>
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
        var nombre = $('#accidente_nombre').val();
        var descripcion = $('#accidente_descripcion').val();

        var cadena = "nombre=" + nombre +
                    "&descripcion=" + descripcion ;

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