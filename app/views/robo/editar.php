
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA68xOsLic_QKxD4EcnwZDrtv-iE09-95M&callback=initMap" type="text/javascript"></script>
<script type="text/javascript">
    var map;
    var geocoder;
    var infoWindow;
    var marker;
    window.onload = function () {
        var latLng = new google.maps.LatLng(<?php echo $robo->calle_x;?>,<?php echo $robo->calle_y;?>);
        var opciones = {
            center: latLng,
            zoom: 15,
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'), opciones);
        geocoder = new google.maps.Geocoder();
        infowindow = new google.maps.InfoWindow();
        marker = new google.maps.Marker({
            position: latLng,
            map: map});

        google.maps.event.addListener(map, 'click', function(event) {
            geocoder.geocode(
                {'latLng': event.latLng},
                function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            document.getElementById('calle_nombre').value = results[0].formatted_address;
                            document.getElementById('calle_x').value = results[0].geometry.location.lat();
                            document.getElementById('calle_y').value = results[0].geometry.location.lng();
                            if (marker) {
                                marker.setPosition(event.latLng);
                            } else {
                                marker = new google.maps.Marker({
                                    position: event.latLng,
                                    map: map});
                            }
                            infowindow.setContent(results[0].formatted_address+'<br/> Coordenadas: '+results[0].geometry.location);
                            infowindow.open(map, marker);
                        } else {
                            document.getElementById('geocoding').innerHTML =
                                'No se encontraron resultados';
                        }
                    } else {
                        document.getElementById('geocoding').innerHTML =
                            'Geocodificación  ha fallado debido a: ' + status;
                    }
                });
        });
    }
    // -->
</script>

<div id="page-wrapper">
    <div class="row">
        <h1>Robo <small>Editar Robo</small></h1>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Fecha Del Robo</label>
        </div>
        <div class="col-lg-3">
            <input type="date" id="robo_fecha" value="<?php echo $robo->fecha;?>" style="width: 200px;">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Descripcion Del Robo</label>
        </div>
        <div class="col-lg-3">
            <textarea id="robo_descripcion" placeholder="Escriba su Descripcion" style="width: 200px;" cols="4"><?php echo $robo->descripcion;?></textarea>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Arma del Robo</label>
        </div>
        <div class="col-lg-3">
            <select id="robo_arma" style="width: 200px;">
                <?php
                $armita = $robo->arma;
                ?>
                <?php
                foreach ($armas as $arma){
                    ?><option  <?php echo $armita == $arma->arma_id ? 'selected' : '';?> value="<?php echo $arma->arma_id;?>"><?php echo $arma->arma_nombre; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Delito</label>
        </div>
        <div class="col-lg-3">
            <select id="robo_delito" style="width: 200px;">
                <?php
                $delitito = $robo->delito;
                ?>
                <?php
                foreach ($delitos as $delito){
                    ?><option <?php echo $delitito == $delito->delito_id ? 'selected' : '';?> value="<?php echo $delito->delito_id;?>"><?php echo $delito->delito_nombre; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Nombre Calle</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="calle_nombre" placeholder="Escriba su Calle" value="<?php echo $robo->nombre?>" style="width: 200px;">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <label>Distrito</label>
        </div>
        <div class="col-lg-3">
            <select id="calle_distrito" style="width: 200px;">
                <?php
                foreach ($distritos as $distrito){
                    ?><option value="<?php echo $distrito->distrito_id;?>"><?php echo $distrito->distrito_nombre; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Coordenada X</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="calle_x" placeholder="Ingresar" value="<?php echo $robo->calle_x;?>" style="width: 200px;">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-lg-2">
            <label>Coordenada Y</label>
        </div>
        <div class="col-lg-3">
            <input type="text" id="calle_y" placeholder="Ingresar" value="<?php echo $robo->calle_y;?>" style="width: 200px;">
        </div>
    </div>
    <div class="row form-group">
        <div>
            <div id="map_canvas" style="width:400px; height:400px"></div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-lg-2">
            <button class="btn btn-success" onclick="agregar()">Editar Robo</button>
        </div>
    </div>

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
        var id = "<?php echo $robo->id; ?>";
        var valor = "correcto";
        var fecha = $('#robo_fecha').val();
        var descripcion = $('#robo_descripcion').val();
        var calle = $('#robo_calle').val();
        var arma = $('#robo_arma').val();
        var delito = $('#robo_delito').val();
        var nombre = $('#calle_nombre').val();
        var distrito = $('#calle_distrito').val();
        var coor_x = $('#calle_x').val();
        var coor_y = $('#calle_y').val();


        if(fecha == ""){
            alertify.error('El campo Fecha está vacío');
            $('#robo_fecha').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#robo_fecha').css('border','');
        }

        if(descripcion == ""){
            alertify.error('El campo Fecha está vacío');
            $('#robo_descripcion').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#robo_descripcion').css('border','');
        }

        if(nombre == ""){
            alertify.error('El campo Nombre  está vacío');
            $('#calle_nombre').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#calle_nombre').css('border','');
        }
        if(distrito == ""){
            alertify.error('El campo Nombre  está vacío');
            $('#calle_distrito').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#calle_distrito').css('border','');
        }
        if(coor_x == ""){
            alertify.error('El campo Nombre  está vacío');
            $('#calle_x').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#calle_x').css('border','');
        }
        if(coor_y == ""){
            alertify.error('El campo Nombre  está vacío');
            $('#calle_y').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#calle_y').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "id=" + id +
                "&arma=" + arma +
                "&fecha=" + fecha +
                "&calle=" + calle +
                "&delito=" + delito +
                "&descripcion=" + descripcion +
                "&nombre=" + nombre +
                "&distrito=" + distrito +
                "&coorx=" + coor_x +
                "&coory=" + coor_y;
            $.ajax({
                type:"POST",
                url:"index.php?c=Robo&a=guardar",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '?c=Robo&a=mostrar';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }
    }
</script>