<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIG - UNAP LOGIN</title>
    <link rel="icon" href="styles/admin/vendor/icono.png">

    <!-- Bootstrap Core CSS -->
    <link href="styles/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="styles/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="styles/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Alertify -->
    <script src="styles/admin/alertifyjs/alertify.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/admin/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="styles/admin/alertifyjs/css/themes/default.css">

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Inicio de Sesion</h3>
                </div>
                <div class="panel-body">
                    <div>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Usuario" id="usuario" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Contraseña" id="contrasenha" type="password">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button onclick="loginsistema()" class="btn btn-lg btn-success btn-block">Login</button>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="styles/admin/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="styles/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
    function loginsistema() {
        var usuario = $('#usuario').val();
        var contrasenha = $('#contrasenha').val();
        var cadena = "usuario=" + usuario +
                    "&contrasenha=" + contrasenha;
        $.ajax({
            type: "POST",
            url: "index.php?c=Admin&a=loguearse",
            data: cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Ingreso exitoso');
                    location.href = "index.php?c=Admin&a=index"
                } else {
                    alertify.error('Usuario y/o Contraseña Incorrectos');
                }

            }
        });
    }
</script>


</body>

</html>
