<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Imagem;
use app\models\User;

class ImageController extends Controller{
   public function index(){
      $objImage = new Imagem;
      $objUser  = new User;
    if($_GET["id"]) $imageId = $_GET["id"];
    $data["image"] =  $objImage->getImageById($imageId);

    // se com base no id nao houver imagem, retorna a pagina principal
    if(!$data["image"]) header("location: ".URL_BASE);

      $data["image"]->user_name = $objUser->getUserNameById($data["image"]->image_authorId);

      if(!isset($_SESSION)) session_start();
      if(isset($_SESSION["user_id"])){

         // se cliente estiver logado , verifica se ja deixou o like na imagem
         if($objImage->isLike($imageId,$_SESSION["user_id"])) $data["liked"] = true;  
         else $data["liked"] = false;  
      }


      $data["likes"] = $objImage->getLikesByImageId($imageId);
      if(!$data["likes"]) $data["likes"] = 0;

      $data["view"] = "inimage";
      $this->load("template",$data);
   } 
   public function like($imageId){
      $objImage = new Imagem;
      $objUser  = new User;
      if(!isset($_SESSION)) session_start();
      if(!$_SESSION["user_id"]) header("location: ".URL_BASE."login");

      if($objImage->like($imageId,$_SESSION["user_id"])) header("location: ".URL_BASE."image/?id=$imageId");

   }
   public function unlike($imageId){
      $objImage = new Imagem;
      $objUser  = new User;
      if(!isset($_SESSION)) session_start();
      if(!$_SESSION["user_id"]) header("location: ".URL_BASE."login");

      if($objImage->unlike($imageId,$_SESSION["user_id"])) header("location: ".URL_BASE."image/?id=$imageId");
      else die("fatal error in DB, back to the <a href=".URL_BASE.">Home</a> ");

   }
}
