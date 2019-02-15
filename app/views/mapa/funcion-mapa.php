
<div id="mapa" class="mapacompleto"></div>


<script>
    var map;
    var map_del;

    window.onload = function () {

        var latLng = new google.maps.LatLng(-3.7440734,-73.2588325);

        var opciones = {
            center: latLng,
            zoom: 10,
        };
        var map = new google.maps.Map(document.getElementById('mapa'), opciones);

            <?php
            $i = '0';
            foreach ($accidentes as $meta){
            $infowindow = "infowindow" . $i;
            $punto = "punto" . $i;
            ?>var <?php echo $infowindow;?> = new google.maps.InfoWindow();
        var <?php echo $punto;?> = new google.maps.Marker({
            position: {lat: <?php echo $meta->calle_x;?>, lng: <?php echo $meta->calle_y;?>},
            map: map});
        <?php echo $infowindow;?>.setContent('' +
            '<label style="color:black;">¿Accidente Fatal?: <?php echo $meta->accidente_fatal;?></label><br>' +
            '<label style="color:black;">Descripción:<?php echo $meta->accidente_descripcion;?></label><br>' +
            '<label style="color:black;">Fecha:<?php echo $meta->accidente_fecha;?></label><br>' +
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
            foreach ($robos as $metas){
            $infowindows = "infowindow" . $j;
            $puntos = "punto" . $j;
            ?>var <?php echo $infowindows;?> = new google.maps.InfoWindow();
        var <?php echo $puntos;?> = new google.maps.Marker({
            position: {lat: <?php echo $metas->calle_x;?>, lng: <?php echo $metas->calle_y;?>},
            map_del: map_del});
        <?php echo $infowindows;?>.setContent('' +
            '<label style="color:black;">Tipo Delito: <?php echo $metas->delito_nombre;?></label><br>' +
            '<label style="color:black;">Tipo Arma: <?php echo $metas->arma_nombre;?></label><br>' +
            '<label style="color:black;">Descripción:<?php echo $metas->robos_descripcion;?></label><br>' +
            '<label style="color:black;">Fecha:<?php echo $metas->robos_fecha;?></label><br>' +
            '');
        <?php echo $puntos;?>.addListener('click', function() {
            <?php echo $infowindow;?>.open(map_del, <?php echo $puntos;?>);
        });


        <?php
        $j++;
        }
        ?>


    }
</script>
