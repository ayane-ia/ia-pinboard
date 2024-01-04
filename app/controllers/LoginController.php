<?php
namespace app\controllers;
use app\core\Controller;
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
                if($objLogin->login($email, $pswd) == "user"){
                    if(vSession_start()) $_SESSION["user_id"] = $objUser->getUserIdByEmail($email)->user_id; 
                    $url = URL_BASE."user";
                    header("location: $url");
                }
                elseif($objLogin->login($email, $pswd) == "adm"){
                    if(vSession_start()) $_SESSION["adm_email"] = trim($email);
                    $url    = URL_BASE."home/adm";
                    header("location: $url");
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