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
                $userName   = trim($_POST["user_name"]);
                $email      = $_POST["user_email"];
                $pswd       = $_POST["user_password"];
                $age        = $_POST["user_age"];
                $create     = $objUser->createUser($userName,$email,$pswd,$age);
                if($create){
                    $url = URL_BASE."login";
                    header("location: $url");
                }
                else
                {
                    echo getcwd().'<br>';
                    echo dirname(__FILE__).'<br>';
                    echo basename(__DIR__).'<br>';
                    
                    die("erro in db <a href=".URL_BASE.">Voltar ? </a>");
                }
            }
        }
       //$data["view"] = "pages/cadastro";
       $this->load("cadastro/cadastro");
   } 
}
?>