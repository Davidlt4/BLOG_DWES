<link rel="stylesheet" href="../css/index.css">

<?php use Repositories\EntradaRepository;?>

<!--Vista que nos muestra todas las entradas-->

<?php $entradas=EntradaRepository::obtenerEntradas();?>

<h2 class="titulo_entradas">Entradas</h2>
<table class="entradas">
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