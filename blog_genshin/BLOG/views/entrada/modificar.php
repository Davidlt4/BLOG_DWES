<link rel="stylesheet" href="../css/index.css">

<!--Vista para modificar entradas-->

<?php use Utils\Utils;?>

    <?php if(isset($_SESSION['entrada_modificada']) && $_SESSION['entrada_modificada'] == 'complete'): ?>
        <strong>Modificada correctamente</strong>

    <?php elseif(isset($_SESSION['entrada_modificada']) && $_SESSION['entrada_modificada'] == 'failed'): ?>
        <strong>Esta entrada no se ha podido modificar</strong>

<?php endif;?>

<?php Utils::deleteSession('entrada_modificada');?>

<?php use Repositories\EntradaRepository;?>

<?php $entradas=EntradaRepository::obtenerEntradasUsuario($_SESSION['identity']->id);?>

<!--Mostramos las entradas del usuario que puede modificar-->
<?php foreach($entradas as $ent):?>

    <form action="<?=base_url?>entrada/modificar" method="post" class="formulario">
        <h3>Modificar Entrada </h3>
        <select name="data[id]">
            <option value="<?=$ent->getId()?>"><?=$ent->getTitulo()?></option>
        </select><br><br>
        <label for="titulo">Modificar titulo: </label>
        <input type="text" value="<?=$ent->getTitulo()?>" name="data[titulo]">
        <br><br>

        <label for="descripcion">Nueva Descripcion: </label>
        <textarea name="data[descripcion]"><?=$ent->getDescripcion()?></textarea>
        <br><br>

        <input type="submit" value="Modificar esta Entrada">
    </form><br><br>
    
<?php endforeach; ?>