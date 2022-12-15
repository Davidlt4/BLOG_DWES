<?php

    //Repositorio para usuario

    namespace Repositories;
    use Lib\BaseDatos;
    use Models\Usuario;
    use PDO;
    use PDOException;

    class UsuarioRepository{

        private BaseDatos $conexion;
        private UsuarioRepository $repository;

        //constructor donde inicializamos la conexión a la base de datos

        function __construct(){
            $this-> conexion = new BaseDatos();
        }

        //funciones generales
        
        //guardamos al usuario en la base de datos
        public function save($usuario) : bool{

            $ins = $this->conexion->prepara("INSERT INTO usuarios (id, nombre, apellidos, email, password, rol,fecha) values (:id, :nombre, :apellidos, :email,:password,:rol,:fecha)");

            $fechaActual = date('y-m-d');
            $password_segura = password_hash($usuario['password'],PASSWORD_BCRYPT,['cost' => 4]);

            $ins->bindParam(':id',$id,PDO::PARAM_INT);
            $ins->bindParam(':nombre',$usuario['nombre'], PDO::PARAM_STR);
            $ins->bindParam(':apellidos',$usuario['apellidos'], PDO::PARAM_STR);
            $ins->bindParam(':email',$usuario['email'], PDO::PARAM_STR);
            $ins->bindParam(':password',$password_segura, PDO::PARAM_STR);
            $ins->bindParam(':rol',$rol, PDO::PARAM_INT);
            $ins->bindParam(':fecha',$fechaActual, PDO::PARAM_STR);

            $id=0;
            $rol=2;

            try{
                $ins->execute();
                $result = true;
            }catch(PDOException $err){
                $result = false;
            }
            return $result;
        }

        
        //comprobamos email y contraseña
        public function comprobar($usuario): bool|object{

            $result= false;
            $email= $usuario['email'];
            $password= $usuario['password'];
    
            $usuario= $this->buscaMail($email);


            if ($usuario !== false) {
                $verify= password_verify($password, $usuario->password);
    
                if ($verify) {
                    $result= $usuario;
                }
            }
            return $result;
        }

        //función auxiliar para la función comprobar que busca un usuario por su email y devuelve los datos de dicho usuario.

        public function buscaMail($email):bool|object{

            $result= false;
            
            $cons= $this->conexion->prepara("SELECT * FROM usuarios WHERE email= :email");
            $cons->bindParam(':email',$email, PDO::PARAM_STR);

            try {
                $cons->execute();
                if ($cons && $cons->rowCount() >= 1) {
                    $result= $cons->fetch(PDO::FETCH_OBJ);
                }
            }
            catch(PDOEXception $err) {
                $result= false;
            }

            return $result;
        }


        //comprueba si el usuario que se pasa como parámetro
        public function existe(array $usuario):bool{
            
            $sql = ("SELECT email FROM usuarios WHERE email = :email");
            $consulta = $this -> conexion -> prepara($sql);
            $consulta -> bindParam(':email',$usuario['email']);

            try{
                $consulta->execute();
                if($consulta->rowCount()==1){
                    $result = true;
                }else{
                    $result=false;
                }
            }catch(PDOException $err){
                $result = false;
            }
            return $result;

        }


        //modificamos los datos del usuario por los datos que se pasan por parámetro
        public function modificar(array $usuario):bool{
            
            
            if(!$usuario['misma']){
                $password_segura = password_hash($usuario['password'],PASSWORD_BCRYPT,['cost' => 4]);
            }else{
                $password_segura=$usuario['password'];
            }

            $sql = ("UPDATE usuarios SET nombre='{$usuario['nombre']}',apellidos='{$usuario['apellidos']}',email='{$usuario['email']}',password='$password_segura' WHERE id='{$usuario['id']}'");

            $consulta = $this ->conexion->prepara($sql);

            //daba problemas con el bindParam por eso tuve que poner los datos directamente en la preparación
            
            /*$consulta -> bindParam(1,$usuario['nombre'],PDO::PARAM_STR);
            $consulta -> bindParam(2,$usuario['apellidos'],PDO::PARAM_STR);
            $consulta -> bindParam(3,$usuario['email'],PDO::PARAM_STR);
            $consulta -> bindParam(4,$password_segura,PDO::PARAM_STR);
            $consulta -> bindParam(5,$usuario['id']);*/


            try{
                $consulta->execute();
                $result = true;
            }catch(PDOException $err){
                $result = false;
            }
            return $result;

        }
    


    }


?>