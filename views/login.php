<!DOCTYPE html>
<html lang="en">

<head>
    <!-- css -->
    <?php
    include('../layout/head.php');
    include('../layout/css.php');
    ?>
</head>

<body>
<div class="app-wrapper d-block">
    <div class="">
        <!-- Body main section starts -->
        <main class="w-100 p-0">
            <!-- Login to your Account start -->
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 p-0">
                        <div class="login-form-container">
                            <div class="mb-4">
                                <a class="logo d-inline-block" href="index.php">
                                    <img src="../assets/images/logo/1.png" width="250" alt="#">
                                </a>
                            </div>
                            <div class="form_container">

                                <form class="app-form" id="sml2020_login_form">
                                    <div class="mb-3 text-center">
                                        <h3>Login</h3>
                                        <p class="f-s-12 text-secondary">Ingresa tu usuario y password</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Usuario</label>
                                        <input class="form-control" id="sml2020_username" name="sml2020_username" type="text" required="" placeholder="Ingrese su usuario" autofocus>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control" id="sml2020_password" name="sml2020_password" type="password" required="" autocomplete="on" placeholder="Ingrese su contraseña">                                    
                                        <div class="error" id="passwordError" style="color: red; display: none;">
                                            La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.
                                        </div>
                                        <div class="success" id="passwordSuccess" style="color: green; display: none;">
                                            Contraseña válida.
                                        </div>
                                    </div>
                                   
                                   

                                    <div class="mb-3 form-check">
                                        
                                        <input type="checkbox" onclick="myFunction()"> Mostrar Password 
                                        
                                    </div>
                                    <div>
                                        
                                        <button class="btn btn-primary w-100" type="submit">Ingresar</button>
                                    </div>
                                    <div class="app-divider-v justify-content-center">
                                        <div id="msgbox"></div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login to your Account end -->
        </main>
        <!-- Body main section ends -->
    </div>
</div>


</body>

<!-- Javascript -->

<!-- latest jquery-->
<script src="../assets/js/jquery-3.6.3.min.js"></script>

<!-- Bootstrap js-->
<script src="../assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    // Función para validar la contraseña
    function validatePassword(password) {
        const minLength = 8;
        const hasUpperCase = /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        return password.length >= minLength && hasUpperCase && hasNumber && hasSpecialChar;
    }

    // Función para mostrar/ocultar contraseña
    function myFunction() {
        var x = document.getElementById("sml2020_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    $(function($) {
        // Validación de la contraseña en tiempo real
        $('#sml2020_password').on('input', function() {
            const password = $(this).val();
            const isValid = validatePassword(password);

            if (isValid) {
                $('#passwordError').hide();
                $('#passwordSuccess').show();
                $(this).removeClass('invalid').addClass('valid');
            } else {
                $('#passwordError').show();
                $('#passwordSuccess').hide();
                $(this).removeClass('valid').addClass('invalid');
            }
        });

        // Enviar formulario de inicio de sesión
        $("#sml2020_login_form").submit(function(e) {
            e.preventDefault();

            const password = $('#sml2020_password').val();
            if (!validatePassword(password)) {
                alert('Por favor, corrige los errores en el formulario.');
                return false;
            }

            $("#msgbox").removeClass().addClass('alert alert-info').text('Verificando....').fadeIn(1000);
            $.post("../controllers/ajax_login.php", {
                username: $('#sml2020_username').val(),
                password: $('#sml2020_password').val(),
                rand: Math.random()
            }, function(data) {
                if (data == 'yes') {
                    $("#msgbox").fadeTo(200, 0.1, function() {
                        $(this).removeClass().html('Ingresando...').addClass('alert btn-success').fadeTo(900, 1, function() {
                            document.location = 'profile.php';
                        });
                    });
                } else {
                    if (data == 'wp') {
                        $("#msgbox").fadeTo(200, 0.1, function() {
                            $(this).removeClass().html('Password incorrecto...').addClass('alert btn-warning').fadeTo(900, 1);
                        });
                    } else {
                        $("#msgbox").fadeTo(200, 0.1, function() {
                            $(this).removeClass().html('Usuario NO registrado...').addClass('alert btn-danger').fadeTo(900, 1);
                        });
                    }
                }
            });
            return false;
        });

        $('#sml2020_username').focus();
    });
</script>

</html>
