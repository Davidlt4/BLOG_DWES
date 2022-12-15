<?php

    namespace Controllers;
    use Lib\Pages;
    use Repositories\UsuarioRepository;
    use Utils\Utils;

    class UsuarioController{

        private Pages $pages;
        private UsuarioRepository $repository;
        private Utils $utils;

        //inicialiamos el repositorio,pages y utils que vamos a utilizar en esta clase

        public function __construct()
        {
            $this->pages=new Pages();
            $this->repository=new UsuarioRepository();
            $this->utils=new Utils();
        }

         //para registrar a un usuario:

         //recogemos los datos del formulario, los validamos y en el caso de que esten validados y que no exista el correo en la base de datos, llamamos a la función del repositorio Save para guardar al usuario
         public function registro(){
        
            if($_SERVER['REQUEST_METHOD']==='POST'){
                
                if($_POST['data']){

                    $registrado=$_POST['data'];
                    $validar=$this->utils->validar_registro($registrado);
                    $existe=$this->repository->existe($registrado);
                    
                    if(!$existe && $this->utils->sinErroresRegistro($validar)){
                        $save= $this->repository->save($registrado);
                    }else{
                        $save=false;
                        $_SESSION['errores']=$validar;
                    }
    
                    if ($save) {
                        $_SESSION['register']= "complete";
                        unset($_SESSION['errores']);
                    }
                    else{
                        $_SESSION['register']= "failed";
                    }
                }else{
                    $_SESSION['register']="failed";
                }
            }
            $this->pages->render('usuario/registro');
        }

        //Iniciamos sesión con un usuario

        //Comprobamos el email y la contraseña y en el caso de que sea correcta iniciamos una sesión que guarda los datos del usuario.

        public function login(){
    
            if($_SERVER['REQUEST_METHOD']==='POST'){
                
                if($_POST['data']){
    
                    $auth=$_POST['data'];
                    $identity=$this->repository->comprobar($auth);
    
                    if($identity && is_object($identity)){
                        $_SESSION['identity']=$identity;
    
                        if($identity->rol==1){
                            $_SESSION['admin']=true;
                        }
                        header("Location: ".base_url);
                    }else{
                        $mens="Este usuario no existe";
                        $this->pages->render("usuario/login",["mensaje"=>$mens]);
                    }
                    
                }
            }
        }
    
        //cerramos sesión
        //destruimos la sesión iniciada en la función login
        public function logout(){
    
            if(isset($_SESSION['identity'])){
                unset($_SESSION['identity']);
            }
    
            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
            }
    
            header("Location: ".base_url);
        }

        public function identifica() {
            $this->pages->render('usuario/login');
        }

        //función para modificar los datos del usuario(esta opción solo estará disponible cuando hayamos logeado)

        //recogemos los datos del usuario y comprobamos que no estén vacíos, si lo están cogemos ese campo de la sesión del usuario
        public function modificar(){
            //datos a modificar:nombre,apellidos,email y password
            $this->pages->render('usuario/modificando');
            $data['id']=$_SESSION['identity']->id;
            
            if($_SERVER['REQUEST_METHOD']=='POST'){

                $usuario = $_POST['data'];

                if($usuario['nombre'] === ""){
                    $data['nombre'] = $_SESSION['identity']->nombre;
                } else{
                    $data['nombre'] = $usuario['nombre'];
                }

                if($usuario['apellidos'] === ""){
                    $data['apellidos'] = $_SESSION['identity']->apellidos;
                } else{
                    $data['apellidos'] = $usuario['apellidos'];
                }

                if($usuario['password'] === ""){
                    $data['password'] = $_SESSION['identity']->password;
                    $data['misma']=true;
                } else{
                    $data['password'] = $usuario['password'];
                    $data['misma']=false;
                }

                if($usuario['email'] === ""){
                    $data['email'] = $_SESSION['identity']->email;
                } else{
                    $data['email'] = $usuario['email'];
                }

                $existe=$this->repository->existe($data);
                
                if(!$existe){
                    $modificado=$this->repository->modificar($data);

                }else{
                    $modificado=false;
                }

                if($modificado){

                    $mensaje="Datos cambiados correctamente";

                }elseif($usuario['nombre']==="" && $usuario['apellidos']==="" && $usuario['password']==="" && $usuario['email']===""){
                    $mensaje="No has introducido ningún dato";
                }else{
                    die("otro");
                    $mensaje="No se ha podido modificar los datos";
                }

                $this->pages->render('usuario/modificando',['mensaje'=>$mensaje]);
            }

        }

    }

?>