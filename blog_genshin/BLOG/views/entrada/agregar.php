<?php use Repositories\CategoriaRepository; ?>

<link rel="stylesheet" href="../css/index.css">

<!--Vista para añadir una entrada-->

<?php use Utils\Utils;?>

    <?php if(isset($_SESSION['entrada_agregada']) && $_SESSION['entrada_agregada'] == 'complete'): ?>
        <strong>Entrada añadida correctamente</strong>

    <?php elseif(isset($_SESSION['entrada_agregada']) && $_SESSION['entrada_agregada'] == 'failed'): ?>
        <strong>Algo ha salido mal,revise los datos introducidos.</strong>

<?php endif;?>

<?php Utils::deleteSession('entrada_agregada');?>

<?php $categorias=CategoriaRepository::obtenerCategorias();?>

<form action="<?=base_url?>Entrada/agregar" method="post" class="formulario">

        <h3>Añadir entrada</h3>

        <label for="titulo">Título: </label>
        <input type="text" name="data[titulo]" required><br><br>

        <label for="categoria">Categorias: </label>
        <select name="data[categoria_id]">
            <?php foreach($categorias as $cat):?>
                <option value="<?=$cat->getId()?>">
                    <?=$cat->getNombre()?>
                </option>
            <?php endforeach;?>    
        </select><br><br>

        <label for="descripcion">Descripción: </label>
        <textarea name="data[descripcion]"></textarea><br><br>
        
        <input type="submit" value="Añadir entrada">

</form>