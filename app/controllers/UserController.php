<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Imagem;
use app\models\User;

//use function PHPSTORM_META\type;

class UserController extends Controller{
    
   public function index(){
      $objImagem = new Imagem;
      $objUser   = new User;
      if(empty($_SESSION)){
         session_start();
         if(!isset($_SESSION["user_id"])){
               $url = URL_BASE;
               header("location: $url");
         }
      }
      if($objUser->isBanned($_SESSION["user_id"])) $data["banned"] = true;

      $data["imagens"]      = $objImagem->getAllImages();


 
      $data["view"] = "user_logged/home";
      $this->load("template", $data);
   }
   public function criar(){
      $objUser   = new User;
      $objImagem = new Imagem;
      if(empty($_SESSION)){
         session_start();
         if(!isset($_SESSION["user_id"])){
            $data["view"] = "user_logged/criar/notLogged";
            $this->load("template", $data);
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
      if($objUser->isBanned($_SESSION["user_id"])){ 
         $data["banned"] = true;
         $data["view"] = "user_logged/criar/userBanned";
      }
      else  $data["view"] = "user_logged/criar/criar";
     
      $this->load("template", $data);
   }
   public function edit(){
      
      $objImagem = new Imagem;
      $objUser = new User;

      if(empty($_SESSION)) session_start();
      if(!isset($_SESSION["user_id"])) header("location: ".URL_BASE);
      
      $dados = $objUser->getUserInfo(["user_name", "user_bio"], $_SESSION["user_id"]);
      $data["name"] = $dados["user_name"];
      $data["bio"] = $dados["user_bio"];
      
      if(isset($dados[1]) && is_string($dados[1])) $data["bio"] = $dados[1];
      
      if(isset($_POST) && isset($_POST["name"])){
         $name = $_POST["name"];

         if(isset($_POST["bio"])) $bio = $_POST["bio"];else $bio = null;

         if(isset($_FILES["profile"])){
            
            $temp = $objImagem->updateProfileImage($_FILES["profile"],$_SESSION["user_id"]);
           
         }
         if($objUser->updateNameBio($_SESSION["user_id"], $name , $bio)) header("location: ".URL_BASE."user/edit");

         else die("Houve um erro no sistema, clique <a href=".URL_BASE.">aqui</a> para voltar");
      }
      $data["userData"] = $objUser->getUserInfo(["user_id","user_name","user_image"],$_SESSION["user_id"]);

      $data["view"]         = "user_logged/profile/editprofile";
      $this->load("template", $data);

     }

}
