<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Imagem;

class UserController extends Controller{
    
   public function index(){
      if(empty($_SESSION)){
         session_start();
         if(!isset($_SESSION["user_id"])){
               $url = URL_BASE;
               header("location: $url");
         }
      }
      $data["view"] = "user_logged/home";
      $this->load("user_logged/template", $data);
   }
   public function criar(){
      $objImagem = new Imagem;
      if(empty($_SESSION)){
         session_start();
         if(!isset($_SESSION["user_id"])){
            $data["view"] = "user_logged/criar/notLogged";
            $this->load("user_logged/template", $data);
         }
      }
      $data["categorias"] = $objImagem->getCategories();
      if(isset($_FILES["image_file"]) && isset($_POST["image_title"]) && isset($_POST["image_description"]) && isset($_POST["image_category"])){
         // se todos os campos forem preenchidos
         $image   = $_FILES["image_file"];
         $title   = $_POST["image_title"];
         $userId  = $_SESSION["user_id"];
         $ctg     = $_POST["image_category"];
         $desc    = $_POST["image_description"];
         if($objImagem->enviarImagem($image,$title, $userId, $desc, $ctg)) echo "<scrpit>Enviado com Sucesso!<scpript>";
         else echo "<scprit>error ao enviar !</script>";
      }
      $data["view"] = "user_logged/criar/criar";
      $this->load("user_logged/template", $data);
   }
 
}
