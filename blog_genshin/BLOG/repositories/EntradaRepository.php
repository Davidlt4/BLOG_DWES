<?php

    namespace Repositories;
    use Lib\BaseDatos;
    use Models\Entrada;
    use PDO;
    use PDOException;

    class EntradaRepository{

        private BaseDatos $conexion;
        private EntradaRepository $repository;

        function __construct(){
            $this-> conexion = new BaseDatos();
        }

        //guardamos una entrada en la base de datos
        public function save($entrada):bool{

            $ins = $this->conexion->prepara("INSERT INTO entradas (id,usuario_id,categoria_id,titulo,descripcion,fecha) values (:id,:usuario_id, :categoria_id,:titulo,:descripcion,:fecha)");

            $fechaActual = date('y-m-d');

            $ins->bindParam(':id',$id,PDO::PARAM_INT);
            $ins->bindParam(':usuario_id',$entrada['usuario_id'], PDO::PARAM_STR);
            $ins->bindParam(':categoria_id',$entrada['categoria_id'], PDO::PARAM_STR);
            $ins->bindParam(':titulo',$entrada['titulo'], PDO::PARAM_STR);
            $ins->bindParam(':descripcion',$entrada['descripcion'], PDO::PARAM_STR);
            $ins->bindParam(':fecha',$fechaActual, PDO::PARAM_STR);

            $id=0;

            try{
                $ins->execute();
                $result = true;
            }catch(PDOException $err){
                $result = false;
            }
            return $result;
        }

        //borramos la entrada que le pasamos como parámetro
        public function borrar($entrada):bool{

            $sql = $this->conexion->prepara("DELETE FROM entradas WHERE id = :id");

            $sql->bindParam(':id',$entrada);

            try{
                $sql -> execute();
                $result=true;
            }catch(PDOException $err){
                $result=false;
            }

            return $result;
            
        }

        //mostramos todas las entradas(se muestra al inicio de nuestra página)

        public static function obtenerEntradas(){
            $entrada=new EntradaRepository();
            $entrada->conexion->consulta("SELECT * FROM entradas ORDER BY id");
            return $entrada->extraer_todos(); 
        }

        public function extraer_todos(): ?array{
            $entradas = [];
            $entrada_datos = $this -> conexion -> extraer_todos();

            foreach($entrada_datos as $datos){
                $entradas[] = Entrada::fromArray($datos);
            }
            return $entradas;
        }


        //mostramos las entradas del usuario que se le pasa como parámetro

        public static function obtenerEntradasUsuario($usuario){

            $entrada=new EntradaRepository();
            $entrada->conexion->consulta("SELECT * FROM entradas WHERE usuario_id='{$usuario}'");
            return $entrada->extraer_todos_usuario();

        }

        //función auxiliar para obtenerEntradasUsuario
        public function extraer_todos_usuario(): ?array{

            $entradas = [];
            $entradas_datos = $this -> conexion -> extraer_todos();

            foreach($entradas_datos as $datos){
                $entradas[] = Entrada::fromArray($datos);
            }
            return $entradas;
        }

        //Obtenemos las entradas pertenecientes a la categoría que se pasa como parámetro

        public static function obtenerEntradasCategoria($categoria){

            $entrada=new EntradaRepository();
            $entrada->conexion->consulta("SELECT * FROM entradas WHERE categoria_id='{$categoria}'");
            return $entrada->extraer_todas_categoria();

        }


        //función auxiliar de obtenerEntradasCategoria
        public function extraer_todas_categoria(): ?array{

            $entradas = [];
            $entradas_datos = $this -> conexion -> extraer_todos();

            foreach($entradas_datos as $datos){
                $entradas[] = Entrada::fromArray($datos);
            }
            return $entradas;
        }

        
        //modificamos la entrada con los datos que se pasan como parámetro
        public function modificar(array $entrada):bool{

            $fechaActual = date('y-m-d');

            $sql=$this->conexion->prepara("UPDATE entradas SET titulo='{$entrada['titulo']}',descripcion='{$entrada['descripcion']}',fecha='$fechaActual' WHERE id='{$entrada['id']}'");


            //daba problemas bindParam a la hora de coger los datos, ya que los datos eran correctos pero no se sustituyen bien por eso he tenido que meterlos directamente
            
            /*$sql->bindParam(':titulo',$entrada['titulo'],PDO::PARAM_STR);

            $sql->bindParam(':descripcion',$entrada['descripcion'],PDO::PARAM_STR);

            $sql->bindParam(':fecha',$fechaActual,PDO::PARAM_STR);

            $sql->bindParam(':id',$entrada['id'],PDO::PARAM_STR);*/

            try{
                $sql->execute();
                $result = true;
            }catch(PDOException $err){
                $result = false;
            }
            return $result;

        }


    
    }


?>