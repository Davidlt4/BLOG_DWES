<link rel="stylesheet" href="../css/index.css">

<?php if(!isset($_SESSION['identity'])):?>

<!--Vista para inciar sesión con un correo y una contraseña-->

<span><?php if(isset($mensaje)) echo "<strong>$mensaje</strong><br>";?></span>

<form action="<?=base_url?>Usuario/login" method="POST" class="formulario">

    <h3>Login</h3>
    <label for="email">Email</label>
    <input type="email" name="data[email]"><br>

    <label for="contra">Contraseña</label>
    <input type="password" name="data[password]">

    <input type="submit" value="Enviar">

</form>

<?php else: ?>
<h3> <?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?> </h3>
<?php endif; ?>