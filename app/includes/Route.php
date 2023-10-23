<?php

namespace Core;

Class Router
{

    public function URL($url)
    {
    	$getUrl = $this-> removeQueryStringVariables($url);
        $this->Views($getUrl);
    }

    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    public function Views($param){

        // Contar diagonales "/"
        $exp = explode('/', $param);

        // Contar las Diagonales
        $count = count($exp);


        if ($count == 1){

              // Cerrar Sesion
              if ($param == 'salir'){

                  // Unset all session values 
                  $_SESSION = array();
                  // get session parameters 
                  $params = session_get_cookie_params();
                  // Delete the actual cookie. 
                  setcookie(session_name(),'', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
                  // Destroy session 
                  session_destroy();
                  header('Location: '.URLSITE);
                  return;
              }


              // Hacemos la comprobacion de las paginas que estan restringidas
              if (is_null($param) || empty($param) || ctype_space($param)){
                  $this -> getTheHeader();

                  $login = isLogin();
                  if ($login == false) {
                    loginModulo();
                  }else{

                    // Menu del usuario
                     MenuModulo();
                     
                     //CubesModulo();
                     mesasModulo();

                  }

              }else{
                  $this -> getTheHeader();
                  

                  // Area de configuracion
                  if ($param == 'testing'){
                  //----------------------------------------------------------
                     
                  }
                  //----------------------------------------------------------

                  $login = isLogin();
                  if ($login == false) {
                    loginModulo();
                  }else{
                     
                     // Menu del usuario
                     MenuModulo();

                     // Area de configuracion
                     if ($param == 'insumos'){
                        if (isAdmin() == false){
                          echo '<div class="col-md-12 text-center">Este Modulo es solo para Administradores.</div>';
                          return;
                        }
                        InsumosModulo();
                     }

                     if ($param == 'ordenes'){
                        ListOrdenesPerCate();
                     }

                     if ($param == 'categorias'){
                        if (isAdmin() == false){
                          echo '<div class="col-md-12 text-center">Este Modulo es solo para Administradores.</div>';
                          return;
                        }
                        categoriasModulo();
                     }

                     if ($param == 'usuarios'){
                        if (isAdmin() == false){
                          echo '<div class="col-md-12 text-center">Este Modulo es solo para Administradores.</div>';
                          return;
                        }
                        usuariosModulo();
                     }

                     if ($param == 'informes'){
                        if (isAdmin() == false){
                          echo '<div class="col-md-12 text-center">Este Modulo es solo para Administradores.</div>';
                          return;
                        }
                        informesModulo();
                     }

                     // Area de configuracion
                     if ($param == 'config'){
                        if (isAdmin() == false){
                          echo '<div class="col-md-12 text-center">Este Modulo es solo para Administradores.</div>';
                          return;
                        }
                        ConfigModulo();
                     }

                  }
                 
              }
              $this -> getTheFooter();

        }else{

              $action = '';
              for ($i= 1; $i < $count; $i++){ 
                $action .= $exp[$i].'/';
              }
              $param = $exp[0];
              $controller = new Controller();
              $controller -> ParamControl($param,substr($action, 0, -1));

        }

    }

      public function getTheHeader(){
           $this -> getTitlePage();
           echo'<!doctype html><html lang="es" data-bs-theme="dark"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>'.TITLENAME.'</title><link href="'.URLSITE.'style.css" rel="stylesheet"></head><body><div class="container"><div class="row">';
      }

      public function getTheFooter(){
             echo '<div id="appdata"></div></div></div><script src="'.URLSITE.'assets/js/jquery.min.js"></script><script src="'.URLSITE.'assets/js/bootstrap-datepicker.min.js"></script><script src="'.URLSITE.'assets/js/bootstrap.min.js"></script><script src="'.URLSITE.'assets/js/jquery.dataTables.min.js"></script><script src="'.URLSITE.'assets/js/dataTables.bootstrap5.min.js"></script><script src="'.URLSITE.'assets/js/script.js"></script><script>var baseurl = "'.URLSITE.'";</script></body></html>';
      }

      public function getArchive($request){
         $file = PUBLICPATH.'/'.$request.'.php';
         if (!file_exists($file)){
             //header('Location: '.URLSITE.'404');
         }else{
            require $file;
         }

      }
  
      public function readArchive($request){
         $file = PUBLICPATH.'/'.$request.'.php';
         if (!file_exists($file)){
             return 'No se encuentra el archivo '.$request.' solicitado.';
         }else{
            $read = file_get_contents(PUBLICPATH.'/'.$request.'.php', true);
            return $read;
         }
      }

      public function getTitlePage(){

          // Traemos el titulo desde la base de datos.
          $title = normalTitleSite();
          define('TITLENAME', $title);

      }

}
