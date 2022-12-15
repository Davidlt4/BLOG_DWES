<?php
    namespace Models;

    class Entrada{

        function __construct(
            private int $id,
            private int $usuario_id,
            private int $categoria_id,
            private string $titulo,
            private string $descripcion,
            private string $fecha,
            )
        {}

        

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
             * Get the value of usuario_id
             */ 
            public function getUsuario_id()
            {
                        return $this->usuario_id;
            }

            /**
             * Set the value of usuario_id
             *
             * @return  self
             */ 
            public function setUsuario_id($usuario_id)
            {
                        $this->usuario_id = $usuario_id;

                        return $this;
            }

            /**
             * Get the value of categoria_id
             */ 
            public function getCategoria_id()
            {
                        return $this->categoria_id;
            }

            /**
             * Set the value of categoria_id
             *
             * @return  self
             */ 
            public function setCategoria_id($categoria_id)
            {
                        $this->categoria_id = $categoria_id;

                        return $this;
            }

            /**
             * Get the value of titulo
             */ 
            public function getTitulo()
            {
                        return $this->titulo;
            }

            /**
             * Set the value of titulo
             *
             * @return  self
             */ 
            public function setTitulo($titulo)
            {
                        $this->titulo = $titulo;

                        return $this;
            }

            /**
             * Get the value of descripcion
             */ 
            public function getDescripcion()
            {
                        return $this->descripcion;
            }

            /**
             * Set the value of descripcion
             *
             * @return  self
             */ 
            public function setDescripcion($descripcion)
            {
                        $this->descripcion = $descripcion;

                        return $this;
            }

            /**
             * Get the value of fecha
             */ 
            public function getFecha()
            {
                        return $this->fecha;
            }

            /**
             * Set the value of fecha
             *
             * @return  self
             */ 
            public function setFecha($fecha)
            {
                        $this->fecha = $fecha;

                        return $this;
            }

            //Función para transformar un array en un objeto Entrada
            public static function fromArray(array $data): Entrada{
                return new Entrada(
                    $data['id'],
                    $data['usuario_id'],
                    $data['categoria_id'],
                    $data['titulo'],
                    $data['descripcion'],
                    $data['fecha'],
                );
            }
    }
?>