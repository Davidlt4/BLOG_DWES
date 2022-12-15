<?php

    //Controlador de categorias
    namespace Controllers;
    use Lib\Pages;
    use Repositories\CategoriaRepository;

    class CategoriaController{

        private Pages $pages;
        private CategoriaRepository $repository;

        public function __construct()
        {
            $this->pages=new Pages();
            $this->repository=new CategoriaRepository();
        }

        //añadimos una categoria llamando a la función safe del repositorio
        public function agregar(){
        
            if($_SERVER['REQUEST_METHOD']==='POST'){
                
                if($_POST['data']){

                    $nombre_categoria=$_POST['data'];
                    $existe=$this->repository->comprobar($nombre_categoria);
    
                    if(!$existe){
                        $save= $this->repository->save($nombre_categoria);
                    }else{
                        $save=false;
                    }
    
                    if ($save) {
                        $_SESSION['agregada']= "complete";
                    }
                    else{
                        $_SESSION['agregada']= "failed";
                    }
                }else{
                    $_SESSION['agregada']="failed";
                }
            }
            $this->pages->render('categoria/agregar');
        }

        //vermos las entradas de la categoría
        public function verCategoria(){
            $entradas=$this->repository->verEntradas();
            $this->pages->render('categoria/mostrarCategoria',['entradas'=>$entradas]);
        }


    }

?>