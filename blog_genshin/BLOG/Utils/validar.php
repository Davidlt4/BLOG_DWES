<?php
    
    //funciones para validar

    function validarRequerido(string $texto){
            return !(trim($texto) == '');
        }
    
    //validamos un texto
    function validar_texto(string $texto){
        $texto_valido = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïüöÄËÏÖÜàèìùòÀÈÙÌÒ\s]+$/";
        return preg_match($texto_valido,$texto);
    }
    
    //limpiamos el texto
    function limpiarTexto(string $texto){
        return preg_replace('/[a-zA-Z]/','',$texto);
    }

    //validamos número
    function validarInt($numero,$minimo){
        return(filter_var($numero,FILTER_VALIDATE_INT)) && ($numero > $minimo);
    }

    //validamos email
    function is_valid_email($str)
    {
        return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
    }


?>