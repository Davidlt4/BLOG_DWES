<?php

    //Modelo Categoria
    namespace Models;

    use Lib\BaseDatos;
    use PDO;
    use PDOException;


    class Categoria{

        

        public function __construct(private string $id,
        private string $nombre,) {}

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        //funcio que nos transforma un array de datos en un objeto Categoría
        public static function fromArray(array $data): Categoria{
            return new Categoria(
                $data['id'],
                $data['nombre'],
            );
        }


    }

?>