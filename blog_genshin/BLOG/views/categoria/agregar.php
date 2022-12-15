<link rel="stylesheet" href="../css/index.css">

<!--Vista para añadir categorías(solo para admin)-->

<?php use Utils\Utils;?>

    <?php if(isset($_SESSION['agregada']) && $_SESSION['agregada'] == 'complete'): ?>
        <strong>Categoría añadida correctamente</strong>

    <?php elseif(isset($_SESSION['agregada']) && $_SESSION['agregada'] == 'failed'): ?>
        <strong>Esta categoría ya existe</strong>

<?php endif;?>

<?php Utils::deleteSession('agregada');?>

<form action="<?=base_url?>Categoria/agregar" method="post" class="formulario">
    <h3>Añadir categoría</h3>
        <label for="nombre">Nombre categoría: </label>
        <input type="text" name="data[nombre]" required><br><br>

        <input type="submit" value="Añadir Categoría">

</form>