<!DOCTYPE html>

<?php

    require "views/header.php";
?>

<html lang="en">

    <body>

        <div class="contenedor">

            <?php
            
                if (!$_SESSION["logged"]){

            ?>
                <form action="<?php echo constant('URL');?>login/logearUsuario" id="login" method="POST">
                    <label for="Email">Email:</label>
                    <input type="text" id="email" name="email" placeholder="Ingrese su email..." >
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña...">
                    <button type="submit">Login</button>
                </form>
            <?php
                }else{
                    header("Location: " . constant("URL"));
                }
            ?>


            
            <p>¿No tienes cuenta? Registrate!</p>
            <button><a href= '<?php constant("URL") ?>register'>Registrar</a></button>
        </div>

    </body>

</html>