<?php

Class LogonAuth {

       private static $instancia;
       private $dbh;

       public function __construct(){
	       $this->dbh = DataBase::conexion();
       }

       public function session_process(){

             $session_name = 'JHCodesSystem';   // Asignar un nombre a la sesion 
             $secure = true;

             // Evisar acceder a la session por mediom de JavaScript
             $httponly = true;

             // Forzar que la sesion solo usa Cookies.
             if (ini_set('session.use_only_cookies', 1) === FALSE) {
                 echo 'Could not initiate a safe session (ini_set)';
                 exit();
             }

             // Gets current cookies params.
             $cookieParams = session_get_cookie_params();
             session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

             // Sets the session name to the one set above.
             session_name($session_name);

             session_start();            // Start the PHP session 
             session_regenerate_id();    // regenerated the session, delete the old one. 

       }

       // Inicio de session
       public function LoginUser($user, $password){

         try{

           $ResCrypt = sha1($password.SALT);
	         $sql = "SELECT * FROM usuarios WHERE usuario = ? AND password = ? AND status = 2";
	         $query = $this->dbh->prepare($sql);
	         $query->bindParam(1, $user);
	         $query->bindParam(2, $ResCrypt);
	         $query->execute();
	         $this->dbh = null;

	         if($query->rowCount() == 1){
                
	              $fila  = $query->fetch();
	              $UserBrowser = $_SERVER['HTTP_USER_AGENT'];
	              $_SESSION['idSession'] = $fila['id'];
	              $_SESSION['usrNameSession'] = $fila['usuario'];
	              $_SESSION['rankSession'] = $fila['rank'];
	              $_SESSION['LoginString'] = sha1($ResCrypt.$UserBrowser);
	              echo 1;

             }else{
             	  echo 2;
             }

             }
	            catch(PDOException $e){
	            print "Error!: " . $e->getMessage();
             }

       }

       public function login_check(){
           // Check if all session variables are set 
           if (isset($_SESSION['idSession'], $_SESSION['usrNameSession'], $_SESSION['LoginString'])){
               $user_id = $_SESSION['idSession'];
               $login_string = $_SESSION['LoginString'];
               $username = $_SESSION['usrNameSession'];

               // Get the user-agent string of the user.
               $user_browser = $_SERVER['HTTP_USER_AGENT'];

               $SQL = 'SELECT password FROM usuarios WHERE id = '.$_SESSION['idSession'].' LIMIT 1';
               $rst = executor($SQL, 1);
               foreach ($rst as $key) {
                   $passworduser = $key['password'];
               }
               
               $login_check = sha1($passworduser.$user_browser);

               if ($login_check == $login_string) {
                   // Logged In!!!!
                   return TRUE;
               } else {
                  // Not logged in
                   return FALSE;
               }

           } else {
               // Not logged in 
               return false;
           }
       }

       public function __clone(){
	       trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
       }













}