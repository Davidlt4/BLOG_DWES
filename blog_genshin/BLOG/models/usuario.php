<?php

    //Modelo usuario

    namespace Models;

    class Usuario{

        function __construct(
            private int $id,
            private string $nombre,
            private string $apellidos,
            private string $email,
            private string $password,
            private int $rol,
            private string $fecha,
        ){}

        

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

            /**
             * Get the value of apellidos
             */ 
            public function getApellidos()
            {
                        return $this->apellidos;
            }

            /**
             * Set the value of apellidos
             *
             * @return  self
             */ 
            public function setApellidos($apellidos)
            {
                        $this->apellidos = $apellidos;

                        return $this;
            }

            /**
             * Get the value of email
             */ 
            public function getEmail()
            {
                        return $this->email;
            }

            /**
             * Set the value of email
             *
             * @return  self
             */ 
            public function setEmail($email)
            {
                        $this->email = $email;

                        return $this;
            }

            /**
             * Get the value of password
             */ 
            public function getPassword()
            {
                        return $this->password;
            }

            /**
             * Set the value of password
             *
             * @return  self
             */ 
            public function setPassword($password)
            {
                        $this->password = $password;

                        return $this;
            }

            /**
             * Get the value of rol
             */ 
            public function getRol()
            {
                        return $this->rol;
            }

            /**
             * Set the value of rol
             *
             * @return  self
             */ 
            public function setRol($rol)
            {
                        $this->rol = $rol;

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

            //Nos transforma un array de datos en un objeto usuario
            public static function fromArray(array $data): Usuario{
                return new Usuario(
                    $data['id'] ?? 0,
                    $data['nombre'] ?? '',
                    $data['apellidos'] ?? '',
                    $data['email'] ?? '',
                    $data['password'] ?? '',
                    $data['rol'] ?? 2,
                    $data['fecha'] ?? '',
                );
            }


    }

?>