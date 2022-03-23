<!DOCTYPE html>

<?php
    
    include "views/header.php";
?>


<html lang="en">
 
    <body>
        <div class="contenedor">

            <form action="<?php echo constant('URL');?>register/registrar" id="register" method="POST">

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Ingrese su email...">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña...">
                <label for="password">Reingrese contraseña:</label>
                <input type="password" id="repassword" name="repassword" placeholder="Reingrese su contraseña...">

                <label for="telefono">Telefono:</label>
                <input type="number" id="telefono" name="telefono">

                <label for="password">Premium:</label>
                
                <select name="premium" id="premium">
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
                
                <button type="submit">Registrar</button>

            </form>

            
        </div>

       
    </body>

</html>