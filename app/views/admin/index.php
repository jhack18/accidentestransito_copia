
        <div id="page-wrapper">
            <div class="row">
                <br><br>
                <center><h1>¡Hola! <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido'];?></h1></center>
                <center><h3>Bienvenido al sistema de registro de incidencias de Iquitos</h3></center>
                <!-- /.col-lg-12 -->
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
    </script>


