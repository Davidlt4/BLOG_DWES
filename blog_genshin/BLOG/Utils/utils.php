<?php

namespace Utils;
require_once('validar.php');

class Utils{
    
    //borramos la sesion
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    //vemos si es admin
    public static function isAdmin(){

        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    //identificamos al usuario
    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    //validamos los datos del registro utilizando las funciones creadas en validar
    public function validar_registro($array):?array{
            
            $errores = [];
    
            if(!validar_texto($array['nombre'])){
                $errores['nombre'] = "Este nombre no es válido";
            }else{
                $errores['nombre'] = "";
            }
    
            if(!validar_texto($array['apellidos'])){
                $errores['apellidos'] = "Debes introducir unos apellidos validos";
            }else{
                $errores['apellidos'] = "";
            }
            $email = filter_var($array['email'],FILTER_SANITIZE_EMAIL);
            if(!is_valid_email($email)){
                $errores['email'] = "Debes introducir un email valido";
            }else{
                $errores['email'] = "";
            }

            if(strlen($array['password']) < 4){
                $errores['password'] = "Ka contraseña debe tener al menos 4 caracteres";
            }else{
                $errores['password'] = "";
            }

            if(strlen($array['password']) > 12){
                $errores['password'] = "La contraseña debe tener 12 caracteres como máx";
            }else{
                $errores['password'] = "";
            }

            if (!preg_match('`[0-9]`',$array['password'])){
                $errores['password'] =  "La contraseña debe contener un número";
            }else{
                $errores['password'] = "";
            }

            if (!preg_match('`[A-Z]`',$array['password'])){
                $errores['password'] =  "La contraseña debe contener una mayúscula";
            }else{
                $errores['password'] = "";
            }
    
            return $errores;
    }
   
    //nos devuelve true si todos los campos son correctos y false si alguno de los campos no ha sido validado

    public function sinErroresRegistro($errores){
        return(($errores['nombre'] == "")&&($errores['apellidos'] == "")&&($errores['email'] == "")&&($errores['password'] == ""));

    }

}

?>