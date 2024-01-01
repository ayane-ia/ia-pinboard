<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Login;
use app\models\User;

class LoginController extends Controller{
   public function index(){
    $objLogin    = new Login;
    $data["error"] = false;
        if(isset($_POST)){
            if(isset($_POST["user_email"]) && isset($_POST["user_password"])){
                $email  = $_POST["user_email"];
                $pswd   = $_POST["user_password"];
                if($objLogin->login($email, $pswd)){
                    if(vSession_start()) $_SESSION["user_email"] = trim($email);
                    $url    = URL_BASE."home";
                    header("location: $url");
                }else{
                    $data["error"] = true;
                }
            }       
        }
    $this->load("login/login", $data);
   } 
}
?>