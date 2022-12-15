<link rel="stylesheet" href="../css/index.css">

<!--Vista para registrar a un usuario-->

<?php use Utils\Utils;?>

    <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
        <strong>Registrado correctamente</strong>

    <?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
        <strong>Este correo ya esta registrado</strong>

<?php endif;?>

<?php Utils::deleteSession('register');?>

<!--Formulario para introducir los datos del usuario que serán validados y se mostrará un error en el caso de que alguno sea incorrecto-->

<form action="<?=base_url?>Usuario/registro" method="post" class="formulario">

        <h3>Registrate</h3>

        <label for="nombre">Nombre: </label>
        <input type="text" name="data[nombre]" required><br><br>
        <?php if(isset($_SESSION['errores'])) echo $_SESSION['errores']['nombre']."<br><br>";?>

        <label for="apellidos">Apellidos: </label>
        <input type="text" name="data[apellidos]" required><br><br>
        <?php if(isset($_SESSION['errores'])) echo $_SESSION['errores']['apellidos']."<br><br>";?>


        <label for="email">Email: </label>
        <input type="email" name="data[email]" required><br><br>
        <?php if(isset($_SESSION['errores'])) echo $_SESSION['errores']['email']."<br><br>";?>


        <label for="password">Contraseña: </label>
        <input type="password" name="data[password]" required><br><br>
        <?php if(isset($_SESSION['errores'])) echo $_SESSION['errores']['password']."<br><br>";?>


        <input type="submit" value="Registrarse">

</form>