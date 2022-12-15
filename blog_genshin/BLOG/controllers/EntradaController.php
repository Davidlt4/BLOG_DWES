<?php

    //Controlador para Entradas
    namespace Controllers;
    use Lib\Pages;
    use Repositories\EntradaRepository;

    class EntradaController{

        private Pages $pages;
        private EntradaRepository $repository;

        public function __construct()
        {
            $this->pages=new Pages();
            $this->repository=new EntradaRepository();
        }

         //para registrar a un usuario:
         //Comprobamos los datos que nos llega del formulario y los guardamos llamando a la función save del repositorio

         public function agregar(){
        
            if($_SERVER['REQUEST_METHOD']==='POST'){
                
                if($_POST['data']){

                    $registrado=$_POST['data'];
                    $registrado['usuario_id']=$_SESSION['identity']->id;
                    $save= $this->repository->save($registrado);
    
                    if ($save) {
                        $_SESSION['entrada_agregada']= "complete";
                    }
                    else{
                        $_SESSION['entrada_agregada']= "failed";
                    }
                }else{
                    $_SESSION['entrada_agregada']="failed";
                }
            }

            $this->pages->render('entrada/agregar');
        }

        //funcion que carga la vista que nos muestra todas las entradas
        public function mostrarEntradas(){
            $this->pages->render('entrada/mostrarEntradas');
        }

        //Borramos la entada a través de la función borrar del repositorio
        public function borrar(){
            
            if($_SERVER['REQUEST_METHOD']==='POST'){

                if($_POST['data']){
                    
                    $entrada=$_POST['data'];
                    $borrado= $this->repository->borrar($entrada);
    
                    if ($borrado) {
                        $_SESSION['entrada_borrada']= "complete";
                    }
                    else{
                        $_SESSION['entrada_borrada']= "failed";
                    }
                }else{
                    $_SESSION['entrada_borrada']="failed";
                }
            }

            $this->pages->render('entrada/borrar');

        }


        //Modifica las entradas llamando a la función modificar del repositorio

        public function modificar(){
            //datos a modificar:nombre,apellidos,email y password
            $this->pages->render('entrada/modificar');
            
            if($_SERVER['REQUEST_METHOD']=='POST'){

                $entrada = $_POST['data'];

                if($entrada['titulo']!="" && $entrada['descripcion']!=""){
                    $modificado=$this->repository->modificar($entrada);
                }else{
                    $modificado=false;
                }
                
                if($modificado){
                    $mensaje="Datos cambiados correctamente";
                }else{
                    $mensaje="No se ha podido modificar los datos";
                }

                header('Location:'.base_url.'entrada/modificar');
            }

        }
    
    }

?>