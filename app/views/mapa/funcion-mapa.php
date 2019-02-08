
<div id="mapa" class="mapacompleto"></div>


<script>
    var map;

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
            '<label style="color:black;">Motivo Accidente: <?php echo $meta->causaaccidente_nombre;?></label><br>' +
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

    }
</script>
