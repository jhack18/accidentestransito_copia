<div id="page-wrapper">
    <div class="row">
        <h1>Involucrado <small>Buscar Involucrado</small></h1>
    </div>

    <label for="name">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Escribe el nombre o dni" required>
    <button id="btnbuscar" onclick="buscar_involucrado()">Buscar</button>
    <div id="resultados"></div>
</div>

<script type="text/javascript">
    function buscar_involucrado() {
        var nombre = $("#nombre").val();
        if(nombre!==""){
            $.post("index.php?c=Involucrado&a=buscar_involucrado_del",{nombre:nombre},function(data){
                $("#resultados").html(data);
                $("#datos_involucrado").DataTable();
            });
        }else{
            alert('Escribe algo');
        }
    }

</script>


