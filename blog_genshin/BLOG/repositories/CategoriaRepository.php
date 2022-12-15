<?php

    //Repositirio para categorias

    namespace Repositories;
    use Repositories\EntradaRepository;
    use Lib\BaseDatos;
    use Models\Categoria;
    use PDO;
    use PDOException;

    class CategoriaRepository{

        private BaseDatos $conexion;

        function __construct(){
            $this->conexion = new BaseDatos();
        }


        //obtenemos todas las categorias registradas en la base de datos
        public static function obtenerCategorias(){
            $categoria=new CategoriaRepository();
            $categoria->conexion->consulta("SELECT * FROM categorias ORDER BY id");
            return $categoria->extraer_todos(); 
        }

        //función auxiliar para obtener categorias, en la cual realizamos la consulta a la base de datos
        public function extraer_todos(): ?array{
            
            $categorias = [];
            $categorias_datos = $this -> conexion -> extraer_todos();

            foreach($categorias_datos as $datos){
                $categorias[] = Categoria::fromArray($datos);
            }
            return $categorias;
        }

        //Guardamos una categoría en la base de datos
        public function save($categoria) : bool{

            $ins = $this->conexion->prepara("INSERT INTO categorias (id,nombre) values (:id,:nombre)");

            $ins->bindParam(':id',$id,PDO::PARAM_INT);
            $ins->bindParam(':nombre',$categoria['nombre'], PDO::PARAM_STR);

            $id=0;

            try{
                $ins->execute();
                $result = true;
            }catch(PDOException $err){
                $result = false;
            }
            return $result;
        }

        //Comprobamos si la categoría pasada como parametro
        public function comprobar(array $categoria):bool{
            
            $sql = ("SELECT nombre FROM categorias WHERE nombre = :nombre");
            $consulta = $this -> conexion -> prepara($sql);
            $consulta -> bindParam(':nombre',$categoria['nombre']);

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


        //Ver las entradas de la categoría
        public function verEntradas(){
            $id=$_GET['id'];
            $entradas_categoria=EntradaRepository::obtenerEntradasCategoria($id);
            return $entradas_categoria;
        }
        

    }

?>