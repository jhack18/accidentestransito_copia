<?php
include('styles/mapa/overall/header-mapa.php');
?>
<body>

<div id="mapa" class="mapacompleto"></div>

<div id="flota" class="flotante">
    <div id="datos-a-cargar">
        <div class="col-sm-12 espacio">
            <label> Este sistema permite visualizar los diferentes accidentes ocurridos en distintas zonas</label>
        </div>
        <div class="col-sm-12 espacio">
            <label>Usando el menú derecho, podrá gestionar mejor la información</label>
        </div>
        <div class="col-sm-12 espacio">
            <a class="btn btn-success" href="index.php?c=Mapa&a=registrarse">Registrarse</a>
        </div>
        <br>
    </div>
</div>

<div id="flota2" class="flotante-derecha">
    <div id="datos-a-cargar">
        <div class="col-sm-12 espacio">
            <div>Filtrar Por:</div>
            <div>
                <input type="checkbox" id="activar_acc"> Accidentes
                <br>
                <input type="checkbox" id="activar_del"> Delitos
            </div>
            <div id="lblacc">Seleccionar Causa del Accidente:</div>
            <div>
                <select id="estadogg" class="opcionador" onchange="mostrarmarcadores()" >
                    <option value="todos">Mostrar Todo</option>
                    <?php
                    function limpia_espacios($cadena){
                        $cadena = str_replace(' ', '', $cadena);
                        return $cadena;
                    }
                    foreach($causas as $op){
                        ?>
                        <option value="<?php $rrr = limpia_espacios($op->causaaccidente_nombre); echo $rrr;?>"><?php echo $op->causaaccidente_nombre;?></option><?php
                    }
                    ?>
                </select>
            </div>

            <div id="lbldel">Seleccionar tipo de Delito:</div>
            <div>
                <select id="tipo_delito" class="opcionador" onchange="mostrarmarcadores_del()" >
                    <option value="todos">Mostrar Todo</option>
                    <?php
                    function limpia_espacios_del($cadena){
                        $cadena = str_replace(' ', '', $cadena);
                        return $cadena;
                    }
                    foreach($delitos as $op){
                        ?>
                        <option value="<?php $rrr = limpia_espacios_del($op->delito_nombre); echo $rrr;?>"><?php echo $op->delito_nombre;?></option><?php
                    }
                    ?>
                </select>
            </div>

        </div>
        <div class="col-sm-12 espacio">
            <div>Fecha de Inicio:</div>
            <div>
                <input type="date" id="fechainicio" onchange="mostrarporfecha()">
            </div>
        </div>
        <div class="col-sm-12 espacio">
            <div>Fecha Fin:</div>
            <div>
                <input type="date" id="fechafin" onchange="mostrarporfecha()" value="<?php echo date("Y-m-d");?>">
            </div>
        </div>
        <br>
    </div>
</div>

<div class="movimiento" onclick="mostraropciones()" id="boton-mostrar">
    <!--<label onclick="alert('Esto funciona')">x</label>-->
</div>

<div class="movimiento-derecha" onclick="mostraropcionesderecha()" id="boton-mostrar-derecha">
    <!--<label onclick="alert('Esto funciona')">x</label>-->
</div>

<div id="flota" class="flotante-superior">
    <div class="contenedor-barra">
        <a href="#" class="logo-barra"><img src="styles/mapa/styles/mapa/img/iiap.png" class="logo-barra" ></a>
        <a href="#" class="logo-barra"><img src="styles/mapa/styles/mapa/img/unap.png" class="logo-barra" ></a>
        <a href="#" class="logo-barra"><img src="styles/mapa/styles/mapa/img/fisi.png"  class="logo-barra" ></a>
        <label class="texto-barra" href="#">SEGCIU - ZONAS DE ALTO RIESGO VEHICULAR</label>
        <a href="?c=Admin&a=login" target="_blank" class="logo-barra"><i class="fa fa-external-link-square fa-fw"></i></a>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        mostraropcionesderecha()
    });

    //validar checkbox

    $('#activar_acc').click(function () {
       if ($('#activar_acc').is(':checked')){
           $('#estadogg').show();
           $('#lblacc').show();
       }
       else {
           $('#estadogg').attr("disabled", "disabled");
           $('#estadogg').hide();
           $('#lblacc').hide();
       }
    });

    $('#activar_del').click(function () {
        if ($('#activar_del').is(':checked')){
            $('#tipo_delito').removeAttr("disabled");
            $('#tipo_delito').show();
            $('#lbldel').show();
        }
        else {
            $('#tipo_delito').attr("disabled", "disabled");
            $('#tipo_delito').hide();
            $('#lbldel').hide();
        }
    });

    var opciones = true;
    var opcionesderecha = true;

    //Inicio Codigo Mostrar/Ocultar Barra Izquierda
    var activar;
    var activar2;
    function mostraropciones() {
        if(opciones === true){
            activar = setInterval(ocultar,10);
            opciones = false;
        } else {
            activar2 = setInterval(mostrar,10);
            opciones = true;
        }
    }

    var tamanhogrande = 0;
    var tamanhopequeño = 220;

    function ocultar() {
        if (tamanhopequeño === 0){
            clearInterval(activar);
            tamanhogrande = 0;
            tamanhopequeño = 220;
        } else {
            tamanhogrande = tamanhogrande - 10;
            tamanhopequeño = tamanhopequeño - 10;
            var uno = "" + tamanhogrande + "px";
            var dos = "" + tamanhopequeño + "px";
        }
        $('#flota').css("margin-left", uno);
        $('#boton-mostrar').css("margin-left", dos);
    }

    var tamanhogrande1 = -220;
    var tamanhopequeño1 = 0;

    function mostrar() {
        if (tamanhopequeño1 === 220){
            clearInterval(activar2);
            tamanhogrande1 = -220;
            tamanhopequeño1 = 0;
        } else {
            tamanhogrande1 = tamanhogrande1 + 10;
            tamanhopequeño1 = tamanhopequeño1 + 10;
            var uno = "" + tamanhogrande1 + "px";
            var dos = "" + tamanhopequeño1 + "px";
        }
        $('#flota').css("margin-left", uno);
        $('#boton-mostrar').css("margin-left", dos);

    }
    //Fin Codigo Mostrar/Ocultar Barra Izquierda
    ////////////////////
    ///////////////////
    //Inicio Codigo Mostrar/Ocultar Barra Derecha
    var activarderecha;
    var activarderecha2;
    function mostraropcionesderecha() {
        if(opcionesderecha === true){
            activarderecha = setInterval(ocultarderecha,10);
            opcionesderecha = false;
        } else {
            activarderecha2 = setInterval(mostrarderecha,10);
            opcionesderecha = true;
        }
    }

    var tamanhograndederecha = 0;
    var tamanhopequeñoderecha = 220;

    function ocultarderecha() {
        if (tamanhopequeñoderecha === 0){
            clearInterval(activarderecha);
            tamanhograndederecha = 0;
            tamanhopequeñoderecha = 220;
        } else {
            tamanhograndederecha = tamanhograndederecha - 10;
            tamanhopequeñoderecha = tamanhopequeñoderecha - 10;
            var unoderecha = "" + tamanhograndederecha + "px";
            var dosderecha = "" + tamanhopequeñoderecha + "px";
        }
        $('#flota2').css("right", unoderecha);
        $('#boton-mostrar-derecha').css("right", dosderecha);
    }

    var tamanhograndederecha1 = -220;
    var tamanhopequeñoderecha1 = 0;

    function mostrarderecha() {
        if (tamanhopequeñoderecha1 === 220){
            clearInterval(activarderecha2);
            tamanhograndederecha1 = -220;
            tamanhopequeñoderecha1 = 0;
        } else {
            tamanhograndederecha1 = tamanhograndederecha1 + 10;
            tamanhopequeñoderecha1 = tamanhopequeñoderecha1 + 10;
            var unoderecha = "" + tamanhograndederecha1 + "px";
            var dosderecha = "" + tamanhopequeñoderecha1 + "px";
        }
        $('#flota2').css("right", unoderecha);
        $('#boton-mostrar-derecha').css("right", dosderecha);

    }
    //Fin Codigo Mostrar/Ocultar Barra Derecha


</script>

<script>
    var map;
    <?php

    $abc = '0';
    foreach ($accidentes as $metados){
        $punto = "punto" . $abc;
        ?> var <?php echo $punto;?>;<?php
            $abc++;
    }

    $ab = '0';
    foreach ($robos as $metad){
    $punt = "punt" . $ab;
    ?> var <?php echo $punt;?>;<?php
    $ab++;
    }


    ?>

    window.onload = function () {

        var latLng = new google.maps.LatLng(-3.7440734,-73.2588325);

        var opciones = {
            center: latLng,
            zoom: 13
        };
        map = new google.maps.Map(document.getElementById('mapa'), opciones);


            <?php
            $i = '0';
            foreach ($accidentes as $meta){
            $infowindow = "infowindow" . $i;
            $punto = "punto" . $i;
            ?>var <?php echo $infowindow;?> = new google.maps.InfoWindow();
        <?php echo $punto;?> = new google.maps.Marker({
            position: {lat: <?php echo $meta->calle_x;?>, lng: <?php echo $meta->calle_y;?>},
            dateI: '<?php echo $meta->accidente_fecha;?>',
            map: map,
            icon: '<?php echo $meta->imagen;?>',
            title:'<?php $datog = limpia_espacios($meta->causaaccidente_nombre); echo $datog;?>' });
        <?php echo $infowindow;?>.setContent('' +
            '<label style="color:black; font-weight: bold;">Motivo Accidente: </label> <label> <?php echo $meta->causaaccidente_nombre;?></label><br>' +
            '<label style="color:black; font-weight: bold;">¿Accidente Fatal?: </label> <label> <?php echo $meta->accidente_fatal;?></label><br>' +
            '<label style="color:black; font-weight: bold;">Comentario Sobre El Accidente: </label> <label> <?php echo $meta->accidente_descripcion;?></label><br>' +
            '<label style="color:black; font-weight: bold;">Fecha: </label> <label> <?php echo $meta->accidente_fecha;?></label><br>' +
            '<label style="color:black; font-weight: bold;">Lugar: </label> <label> <?php echo $meta->calle_nombre;?></label><br>' +
            '');
        <?php echo $punto;?>.addListener('click', function() {
            <?php echo $infowindow;?>.open(map, <?php echo $punto;?>);
        });

        <?php
        $i++;
        }
        ?>

            <?php
            $j = '0';
            foreach ($robos as $met){
            $info = "info" . $j;
            $punt = "punt" . $j;
            ?>var <?php echo $info;?> = new google.maps.InfoWindow();
        <?php echo $punt;?> = new google.maps.Marker({
            position: {lat: <?php echo $met->calle_x;?>, lng: <?php echo $met->calle_y;?>},
            dateI: '<?php echo $met->robos_fecha;?>',
            map: map,
            icon: '<?php echo $met->imagen;?>',
            title:'<?php $datog = limpia_espacios($met->delito_nombre); echo $datog;?>'});
        <?php echo $info;?>.setContent('' +
            '<label style="color:black;">Tipo Delito: <?php echo $met->delito_nombre;?></label><br>' +
            '<label style="color:black;">Tipo Arma: <?php echo $met->arma_nombre;?></label><br>' +
            '<label style="color:black;">Descripción:<?php echo $met->robos_descripcion;?></label><br>' +
            '<label style="color:black;">Fecha:<?php echo $met->robos_fecha;?></label><br>' +
            '<label style="color:black;">Lugar:<?php echo $met->calle_nombre;?></label><br>' +
            '');
        <?php echo $punt;?>.addListener('click', function() {
            <?php echo $info;?>.open(map, <?php echo $punt;?>);
        });

        <?php
        $j++;
        }
        ?>




    }
    
    function mostrarmarcadores() {
        $('#fechainicio').val('');
        $('#fechafin').val("<?php echo date("Y-m-d");?>");
        var activo = $('#estadogg').val();
        var fecha;
        var fechag;
        <?php
        $abcde = '0';
        foreach ($accidentes as $metadosdes){
        $puntotes = "punto" . $abcde;
        ?>
        fecha = new Date(<?php echo $puntotes;?>.dateI);
        fechag = fecha.getDate();
        if(<?php echo $puntotes;?>.title == activo || activo == 'todos'){
            <?php echo $puntotes;?>.setMap(map);
        } else {
            <?php echo $puntotes;?>.setMap(null);
        }
        <?php
        $abcde++;
        }
        ?>



    }

    function mostrarmarcadores_del() {
        $('#fechainicio').val('');
        $('#fechafin').val("<?php echo date("Y-m-d");?>");
        var activ = $('#tipo_delito').val();
        var fech;
        var fechg;
        <?php
        $abcdey = '0';
        foreach ($robos as $mtadosdes){
        $puntots = "punt" . $abcdey;
        ?>
        fech = new Date(<?php echo $puntots;?>.dateI);
        fechg = fech.getDate();
        if(<?php echo $puntots;?>.title == activ || activ == 'todos'){
            <?php echo $puntots;?>.setMap(map);
        } else {
            <?php echo $puntots;?>.setMap(null);
        }
        <?php
        $abcdey++;
        }
        ?>
    }

    function mostrarporfecha() {
        $('#estadogg').val('todos');
        $('#tipo_delito').val('todos');
        var fechai = $('#fechainicio').val();
        var fechaf = $('#fechafin').val();

        if(fechai == "" || fechaf == ""){
            alert("Ambos campos de fecha deben estar llenos");
        } else {
            var fechain = new Date(fechai);
            var fechafi = new Date(fechaf);
            var fechainicio = fechain.getTime();
            var fechafinal = fechafi.getTime();
            if(fechainicio > fechafinal){
                alert("La fecha de inicio no puede ser mayor a la fecha final");
            } else {
                <?php
                $abcdef = '0';
                foreach ($accidentes as $metadosdesa){
                $puntotesi = "punto" . $abcdef;
                $fechasd = "fechasd" . $abcdef;
                $fechas = "fechas" . $abcdef;
                ?>
                var <?php echo $fechasd;?> = new Date(<?php echo $puntotesi;?>.dateI);
                var <?php echo $fechas;?> = <?php echo $fechasd;?>.getTime();
                if(<?php echo $fechas;?> > fechainicio && <?php echo $fechas;?> < fechafinal){
                    <?php echo $puntotesi;?>.setMap(map);
                } else {
                    <?php echo $puntotesi;?>.setMap(null);
                }
                <?php
                $abcdef++;
                }
                ?>

                <?php
                $abcdefg = '0';
                foreach ($robos as $metadosdesai){
                $puntote = "punt" . $abcdefg;
                $fechas = "fechasd" . $abcdefg;
                $fecha = "fechas" . $abcdefg;
                ?>
                var <?php echo $fechas;?> = new Date(<?php echo $puntote;?>.dateI);
                var <?php echo $fecha;?> = <?php echo $fechas;?>.getTime();
                if(<?php echo $fecha;?> > fechainicio && <?php echo $fecha;?> < fechafinal){
                    <?php echo $puntote;?>.setMap(map);
                } else {
                    <?php echo $puntote;?>.setMap(null);
                }
                <?php
                $abcdefg++;
                }
                ?>

            }
        }
    }

</script>
</body>
</html>
