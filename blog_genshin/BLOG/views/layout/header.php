<?php use Repositories\CategoriaRepository; ?>

<!--Vista HEADER-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG - Inicio</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>

    <header>
        <a href="<?=base_url?>" class="titulo">
            <h1>BLOG DE GENSHIN IMPACT</h1>
        </a>
        <nav class="navbar">


            <!--El menú que se muestra cuando hemos iniciado sesión-->
            <?php if(isset($_SESSION['identity'])):?>
                <li><a href="<?=base_url?>entrada/agregar">Añadir entrada</a></li>
                <li><a href="<?=base_url?>entrada/modificar">Modificar Entrada</a></li>
                <li><a href="<?=base_url?>entrada/borrar">Borrar Entrada</a></li>
                <li><a href="<?=base_url?>usuario/modificar">Modificar datos</a></li>
                <li><a href="<?=base_url?>usuario/logout">Cerrar sesión</a></li>
            <?php endif; ?>


            <!--Opción que se añade por ser admin-->
            <?php if(isset($_SESSION['admin'])):?>
                <li><a href="<?=base_url?>categoria/agregar">Añadir categoría</a></li>
            <?php endif; ?>

            
            <?php if(!isset($_SESSION['identity'])):?>
                <li><a href="<?=base_url?>usuario/registro">Crear Cuenta</a></li>
                <li><a href="<?=base_url?>usuario/identifica">Identificate</a></li>
            <?php endif; ?>

        </nav>

        <!--Mostramos todas las categorías-->

        <?php $categorias=CategoriaRepository::obtenerCategorias();
        ?>

        <nav class="categorias">
            <ul>
                <?php foreach($categorias as $cat):
                    ?>
                    <li>
                        <a href="<?=base_url?>Categoria/verCategoria&id=<?=$cat->getId()?>"><?=$cat->getNombre()?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

    </header>