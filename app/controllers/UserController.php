<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Imagem;
use app\models\User;

use function PHPSTORM_META\type;

class UserController extends Controller{
    
   public function index(){
      $objImagem = new Imagem;
      if(empty($_SESSION)){
         session_start();
         if(!isset($_SESSION["user_id"])){
               $url = URL_BASE;
               header("location: $url");
         }
      }
      
      $data["imagens"]      = $objImagem->getAllImages();
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
         $verify  = $objImagem->verifyImage($image,$userId);
         if(!is_string($verify)){
            $sendImage = $objImagem->enviarImagem($image,$title, $userId, $desc, $ctg);
            if($sendImage != false && !is_string($sendImage)){
               header("location: ".URL_BASE."user");
            }elseif(is_string($sendImage)){
               $data["error"] = $sendImage;
            }else{
               $data["error"] = "fatalError";
            }
         }
         else{
            $data["error"] = $verify;
         }
      }
      $data["view"] = "user_logged/criar/criar";
      $this->load("user_logged/template", $data);
   }
   public function edit(){
      $objImagem = new Imagem;
      $objUser = new User;
      if(empty($_SESSION)) session_start();
      if(!isset($_SESSION["user_id"])) header("location: ".URL_BASE);
      
      $dados = $objUser->getUserInfo(["user_name", "user_bio"], $_SESSION["user_id"]);
      $data["name"] = $dados[0];

      if(is_string($dados[1])) $data["bio"] = $dados[1];
      
      $data["view"]         = "user_logged/profile/editprofile";
      $this->load("template", $data);
     }
}
