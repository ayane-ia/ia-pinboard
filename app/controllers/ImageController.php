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
      $imageUser = $data["image"]->image_authorId;

      $data["moreImages"] = $objImage->getMoreImages($imageUser,$data["image"]->image_category,$data["image"]->image_id);
      

      $data["comments"] = $objImage->getCommentsByImageId($imageId);

      $data["likes"] = $objImage->getLikesByImageId($imageId);
      if(!$data["likes"]) $data["likes"] = 0;

      if(isset($_SESSION["user_id"])){
         if($objUser->userIsFollowing($data["image"]->user_name,$_SESSION["user_id"])) $data["following"] = true;
         else $data["following"] = false;
      }else $data["following"] = false;
      // se o usuario visitado for eu mesmo
      
      if($data["image"]->image_authorId == $_SESSION["user_id"]) $data["itsMe"] = true;
      else $data["itsMe"] = false;

      //die(var_dump($data["itsMe"]));

      if(isset($_POST) && isset($_POST["comment"])){
         if(isset($_SESSION["user_id"])){
            $objImage->insertComment($imageId,$_SESSION["user_id"],$_POST["comment"]);
            $data["comments"] = $objImage->getCommentsByImageId($imageId);
         }else{
            $data["error"]["notLogged"] = true;
         }
      }
      $userData = $objUser->getUserById($data["image"]->image_authorId);
      $data["imageUser"] = $userData->user_image;
      
      if( $data["image"]->image_authorId == $_SESSION["user_id"]){
         $data["remove"] = true;
      }
      
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
   public function follow($user,$imageId){
      
      $objUser        = new User;
      if(!isset($_SESSION)) session_start();
      if(!$_SESSION["user_id"])  header("location: ".URL_BASE."login");
      if($user == $_SESSION["user_id"]) header("location: ".URL_BASE);

      if(is_numeric($user)) $user = $objUser->getUserNameById($user);
      if($objUser->isUser($user) == false) header("location: ".URL_BASE);
      
      if($user == $_SESSION["user_id"]) header("location: ".URL_BASE);
  
      $follow = $objUser->follow($user,$_SESSION["user_id"]);
      if($follow){ 
          // processo de follow com sucesso
          $_SESSION["follow_sucess"] = true;
          header("location: ".URL_BASE."image/?id=$imageId");
      }elseif($follow == "exists" || $follow == "isFollowing"){
          
          // erro no banco de dados
          $_SESSION["error"]["exists"] = true;
          header("location: ".URL_BASE."profile/?user=$user"); 
      }
      elseif($follow == "equal_users"){
         header("location: ".URL_BASE); 
     }
     }
     public function unfollow($user,$imageId){
      $objUser        = new User;
      //if(!$objUser->userIsFollowing($user,$_SESSION["user_id"])) header("location: ".URL_BASE."profile/?user=$user");
      
      @session_start();
      if($user == $_SESSION["user_id"]) header("location: ".URL_BASE);

      if(is_numeric($user)) $user = $objUser->getUserNameById($user);

      if($user == $_SESSION["user_id"]) header("location: ".URL_BASE);
      $unfollow = $objUser->unFollow($user,$_SESSION["user_id"]);
      if($unfollow) header("location: ".URL_BASE."image/?id=$imageId");
      elseif($unfollow == "equal_users"){
         header("location: ".URL_BASE);
      }
      else {
          // erro no banco de dados
          $_SESSION["error"]["unfollow"] = true;
          header("location: ".URL_BASE."profile/?user=$user");
      }
     }
     public function nelixremm($image_id){
      $objImage = new Imagem;
      $objUser  = new User;
      if(!isset($_SESSION)) session_start();
      if(!$_SESSION["user_id"]) header("location: ".URL_BASE."login");
      $image = $objImage->getImageById($image_id);
      
      if($_SESSION["user_id"] != $image->image_authorId) header("location: ".URL_BASE);
      if($objImage->removeImage($image_id)) header("location: ".URL_BASE);
      else header("location: ".URL_BASE."image/?id=$image_id");
      
     }
     
}
