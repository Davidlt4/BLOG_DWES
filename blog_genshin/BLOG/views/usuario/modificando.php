<link rel="stylesheet" href="../css/index.css">

<!--Vista para modificar datos de un usuario-->

    <form action="<?=base_url?>Usuario/modificar" method="post" class="formulario">

        <h3>Modificar Datos</h3>
        <strong><?php if(isset($mensaje))echo $mensaje;?></strong>

        <label for="nombre">Nuevo Nombre: </label>
        <input type="text" name="data[nombre]">
        <br><br>

        <label for="apellidos">Nuevos Apellidos: </label>
        <input type="text" name="data[apellidos]">
        <br><br>

        <label for="email">Nuevo Email: </label>
        <input type="email" name="data[email]">
        <br><br>

        <label for="password">Nueva Contraseña: </label>
        <input type="password" name="data[password]">
        <br><br>

        <input type="submit" value="Modificar datos">
</form>