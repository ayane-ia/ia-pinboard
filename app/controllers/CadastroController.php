<?php
namespace app\controllers;
use app\core\Controller;
use app\models\User;
include_once "app/functions/funcoes.php";

class CadastroController extends Controller{
   public function index(){
    $objUser = new User;
        if(isset($_POST)){
            if(isset($_POST["user_name"]) && isset($_POST["user_email"]) && isset($_POST["user_password"]) && isset($_POST["user_age"])){
                $userName   = $_POST["user_name"];
                $email      = $_POST["user_email"];
                $pswd       = $_POST["user_password"];
                $age        = $_POST["user_age"];
                if($_FILES["user_image"]){
                    
                }
                else $userImage = false;
                if($objUser->createUser($userName, $email, $pswd, $age, $userImage)){ 
                    $url = URL_BASE."Login";
                    header("location: $url");
                }
                else{
                    die("ERRO AO CADASTRAR !");
                }
            }
        }
       //$data["view"] = "pages/cadastro";
       $this->load("cadastro/cadastro");
   } 
}
?>