<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <title>:: Epic :: Login</title>

    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css" />

    <!-- Core css -->
    <link rel="stylesheet" href="assets/css/style.min.css" />

</head>

<body class="font-muli theme-cyan gradient">

    <div class="auth option2">
        <div class="auth_left">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <a class="header-brand" href="index.html"><i class="fa fa-futbol-o brand-logo"></i></a>
                        <div class="card-title mt-3">Login to your account</div>
                        <!-- <button type="button" class="btn btn-facebook"><i class="fa fa-facebook mr-2"></i>Facebook</button>
                    <button type="button" class="btn btn-google"><i class="fa fa-google mr-2"></i>Google</button>
                    <h6 class="mt-3 mb-3">Or</h6> -->
                    </div>
                    <form action="login/login" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter user" name="usuario"  autofocus <?=session('tiempo_expiracion')!=null?'disabled':''?>>
                        </div>
                        <div class="form-group">
                            <!-- <label class="form-label"><a href="forgot-password.html" class="float-right small">I forgot password</a></label> -->
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="contraseña" required <?=session('tiempo_expiracion')!=null?'disabled':''?>>
                        </div>
                        <p class="text-danger" id="errorCredenciales"><?= session('error.credenciales') ?></p>
                        <p class="text-danger"><?= session('error.session') ?></p>
                        <p class="text-danger" id="contador"></p>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block" title="" <?=session('tiempo_expiracion')!=null?'disabled':''?>>Sign in</button>
                            <!-- <div class="text-muted mt-4">Don't have account yet? <a href="register.html">Sign up</a></div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Main project js, jQuery, Bootstrap -->
    <script src="assets/bundles/lib.vendor.bundle.js"></script>

    <!-- Start project main js  and page js -->
    <script src="assets/js/core.js"></script>

    <script>
        $(document).ready(function() {
            // Función para verificar si la variable de sesión alcanzó cierto valor y recargar la página
            // function checkSessionVariable() {
            //     $.ajax({
            //         url: '<?= base_url('login/check_session_bloqueado') ?>', // Ruta de tu método en el controlador para verificar la variable de sesión
            //         method: 'GET',
            //         success: function(response) {
            //             if (response === 'reload') {
            //                 // Si la respuesta indica que la página debe recargarse, hazlo
            //                 location.reload();
            //             }
            //         }
            //     });
            // }

            // // Verificar cada cierto intervalo (por ejemplo, cada 10 segundos)
            // setInterval(checkSessionVariable, 10000); // 10000 milisegundos = 10 segundos


            // Función para mostrar el contador regresivo
            function mostrarContador() {
            <?php if (session('tiempo_expiracion') != null): ?>
                
                document.getElementById("errorCredenciales").innerText = "Acceso bloqueado por 15 min.";
                // Fecha y hora objetivo (en milisegundos)
                var fechaObjetivo = <?= session('tiempo_expiracion') ?> * 1000;

                // Calcula la diferencia entre la fecha y hora actual y la fecha y hora objetivo
                var diferencia = fechaObjetivo - Date.now();
                console.log(diferencia)

                // Calcula el tiempo restante en horas, minutos y segundos
                var horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
                var segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

                // Muestra el contador en el formato HH:MM:SS
                document.getElementById("contador").innerText = horas + "h " + minutos + "m " + segundos + "s";

                // Si la diferencia llega a 0, detiene el contador
                if (diferencia <= 0) {
                    clearInterval(intervalo);
                    document.getElementById("contador").innerText = "";
                    document.getElementById("errorCredenciales").innerText = "";
                    
                    desbloquearFormulario();
                }
            <?php endif; ?>
        }


        // Llama a la función mostrarContador cada segundo
        var intervalo = setInterval(mostrarContador, 1000);
        
        // Desbloquea el formulario habilitando todos los campos de entrada y el botón de envío
        function desbloquearFormulario() {
            // Selecciona el formulario
            var formulario = document.querySelector('form[action="login/login"]');

            // Selecciona todos los campos de entrada dentro del formulario
            var campos = formulario.querySelectorAll('input');

            // Habilita cada campo de entrada
            campos.forEach(function(campo) {
                campo.disabled = false;
            });

            // Habilita el botón de envío
            var botonSubmit = formulario.querySelector('button[type="submit"]');
            botonSubmit.disabled = false;
        }

        // Llama a la función para desbloquear el formulario cuando sea necesario
        //desbloquearFormulario();

        
        // Muestra el contador al cargar la página
        mostrarContador();
        });
    </script>
</body>

</html>