<link rel="stylesheet" href="../css/index.css">

<!--Vista para borrar entradas-->

<!--mostramos las entradas del usuario logeado y damos la opción para borrarlas por el título-->

<?php use Utils\Utils;?>

    <?php if(isset($_SESSION['entrada_borrada']) && $_SESSION['entrada_borrada'] == 'complete'): ?>
        <strong>Borrado correctamente</strong>

    <?php elseif(isset($_SESSION['entrada_borrada']) && $_SESSION['entrada_borrada'] == 'failed'): ?>
        <strong>Esta entrada no se ha podido borrar</strong>

<?php endif;?>

<?php Utils::deleteSession('entrada_borrada');?>

<?php use Repositories\EntradaRepository;?>


<!--Obtenemos las entradas llamando a la función estatica ObtenerEntradasUsuario que nos muestra la entradas del usuario logeado a través de su id y las guardamos en un array-->
<?php $entradas=EntradaRepository::obtenerEntradasUsuario($_SESSION['identity']->id);

//esta variable se ha creado para borrar todas las entradas que se mostrará solo si eres administrador.

$todas_entradas=EntradaRepository::obtenerEntradas()?>


<!--Mostramos las entradas del usuario en forma de formulario para realizar la petición de borrar la entrada seleccionada por su título-->
<form action="<?=base_url?>Entrada/borrar" method="post" class="formulario">
    <h3>Borrar entradas</h3>
    <select name="data">
        <?php foreach($entradas as $ent):?>
            <option value="<?=$ent->getId()?>">
                <?=$ent->getTitulo()?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Borrar entrada">
</form><br><br>

<!--Mostramos todas las entradas(solo para admin)en forma de formulario para realizar la petición de borrar la entrada seleccionada por su título-->

<?php if(isset($_SESSION['admin'])):?>
    <form action="<?=base_url?>Entrada/borrar" method="post" class="formulario">
        <h3>Borrar entradas de usuarios</h3>
        <select name="data">
            <?php foreach($todas_entradas as $ent):?>
                <option value="<?=$ent->getId()?>">
                    <?=$ent->getTitulo()?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Borrar entrada">
    </form>
<?php endif; ?>

<h3 class="titulo_entradas">Tus entradas: </h3>

<table>
    <tbody>
        <?php foreach($entradas as $ent):
            ?>
            <tr>
                <td class="titulo_entrada"><b><?=$ent->getTitulo()?></b></td>
            </tr>
            <tr></tr>
            <tr>
                <td><?=$ent->getDescripcion()?></td>
            </tr>
            <tr>
                <td><?=$ent->getFecha()?></td>
            </tr>
            <tr></tr>
            <tr></tr>
        <?php endforeach; ?>
    </tbody>
</table>