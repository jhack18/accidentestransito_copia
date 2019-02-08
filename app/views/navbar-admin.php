<body>

<div id="wrapper">
    <!-- Inicio de Configuracion de Navegacion-->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <!--Cuadro Navegacion-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?c=Admin&a=index">SIG - INTEGRADO</a>
        </div>
        <!--Fin Cuadro Navegacion-->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="?c=Admin&a=edicion"><i class="fa fa-gear fa-fw"></i>Editar Datos</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="index.php?c=Admin&a=salir"><i class="fa fa-sign-out fa-fw"></i>Salir</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->



        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="?c=Admin&a=index"><i class="fa fa-dashboard fa-fw"></i>Vista Principal</a>
                    </li>
                    <li>
                        <a href="index.php" target="_blank"><i class="fa fa-laptop fa-fw"></i>Ir Al Mapa</a>
                    </li>
                    <?php
                     if($_SESSION['rol'] == "Administrador"){
                         echo '
                         <li>
                            <a href="#"><i class="fa fa-child fa-fw"></i>Usuarios<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?c=Usuario&a=agregar">Agregar Usuarios</a>
                                </li>
                                <li>
                                    <a href="?c=Usuario&a=mostrar">Ver Usuarios</a>
                                </li>
                            </ul>
                        </li>
                         ';
                     }
                    ?>

                    <!--<li>
                        <a href="#"><i class="fa fa-code-fork fa-fw"></i>Roles<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Agregar Rol</a>
                            </li>
                            <li>
                                <a href="#">Ver Roles</a>
                            </li>
                        </ul>
                    </li>-->
                    <?php
                    if($_SESSION['rol'] == "Administrador"){
                        echo '
                         <li>
                        <a href="#"><i class="fa fa-picture-o fa-fw"></i>Distritos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?c=Distrito&a=agregar">Agregar Distrito</a>
                            </li>
                            <li>
                                <a href="?c=Distrito&a=mostrar">Ver Distrito</a>
                            </li>
                        </ul>
                    </li>
                         ';
                    }
                    ?>


                    <!--<li>
                        <a href="#"><i class="fa fa-paper-plane fa-fw"></i>Calles<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?c=Calle&a=agregar">Agregar Calle</a>
                            </li>
                            <li>
                                <a href="?c=Calle&a=mostrar">Ver Calle</a>
                            </li>
                        </ul>
                    </li>-->
                    <li>
                        <a href="#"><i class="fa fa-ambulance fa-fw"></i>Accidentes<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?c=Accidente&a=agregar">Agregar Accidentes</a>
                            </li>
                            <li>
                                <a href="?c=Accidente&a=mostrar">Ver Accidentes</a>
                            </li>
                            <li>
                                <a href="?c=Involucrado&a=buscar"><i class="fa fa-search fa-fw"></i>Buscar Involucrado</a>
                            </li>
                        </ul>
                    </li>


                    <li>

                        <a href="#"><i class="fa fa-wheelchair fa-fw"></i>Causas Accidentes<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?c=CausaAccidente&a=agregar">Agregar Causas Accidentes</a>
                            </li>
                            <li>
                                <a href="?c=CausaAccidente&a=mostrar">Ver Causas Accidentes</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-pied-piper-alt fa-fw"></i>Delito<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?c=Robo&a=agregar">Agregar Delito</a>
                            </li>
                            <li>
                                <a href="?c=Robo&a=mostrar">Ver Delito</a>
                            </li>
                            <li>
                                <a href="?c=Involucrado&a=buscar_del"><i class="fa fa-search fa-fw"></i>Buscar Involucrado</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fire fa-fw"></i>Tipo de Delitos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?c=delito&a=agregar">Agregar Tipo de Delito</a>
                            </li>
                            <li>
                                <a href="?c=Delito&a=mostrar">Ver Tipo de Delitos</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bomb fa-fw"></i>Armas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?c=arma&a=agregar">Agregar Armas</a>
                            </li>
                            <li>
                                <a href="?c=Arma&a=mostrar">Ver Armas</a>
                            </li>
                        </ul>
                    </li>

                    <?php
                    if($_SESSION['rol'] == "Administrador"){
                        echo '
                    <li>
                        <a href="#"><i class="fa fa-database fa-fw"></i>Bitacora<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?c=Bitacora&a=mostrar">Ver Bitacora</a>
                            </li>
                        </ul>
                    </li>
                         ';
                    }
                    ?>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>