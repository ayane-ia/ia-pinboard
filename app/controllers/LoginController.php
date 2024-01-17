<?php

namespace app\controllers;
use app\core\Controller;
use app\models\Adm;
use app\models\Login;
use app\models\User;

class LoginController extends Controller{
   public function index(){
    $objUser     = new User;
    $objLogin    = new Login;
    $data["error"] = false;
        if(isset($_POST)){
            if(isset($_POST["user_email"]) && isset($_POST["user_password"])){
                $email  = $_POST["user_email"];
                $pswd   = $_POST["user_password"];
                $login = $objLogin->login($email, $pswd);
                if($login == "user"){
                    if(vSession_start()){ 
                        
                        $_SESSION["user_id"] = $objUser->getUserIdByEmail($email)->user_id;
                        $_SESSION["user_name"] = $objUser->getUserNameById($_SESSION["user_id"]);
                    } 

                    $url = URL_BASE."user";
                    header("location: $url");
                }
                elseif($login != false || $login != null){
                    
                    $objAdm = new Adm;
                    if(!isset($_SESSION)) session_start();
                    $_SESSION["adm"] = $login;

                    if($_SESSION["adm"]) header("location: ".URL_BASE."adm");
                    else $data["error"] = true;
                }
                else{
                    $data["error"] = true;
                }
            }       
        }
    $this->load("login/login", $data);
   } 
}
?>