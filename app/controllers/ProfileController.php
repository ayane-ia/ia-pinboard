<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Imagem;
use app\models\User;

class ProfileController extends Controller{

   public function index(){
        $objImagem  = new Imagem;
        $objUser    = new User;

        if(isset($_GET["user"])){
            $name       = $_GET["user"];
            if($objUser->isUser($name) == false) header("location: ".URL_BASE); 
            $user_id    = $objUser->getUserIdByName($name);
            if(empty($_SESSION)) session_start();
                
            if(isset($_SESSION["user_id"]) && $user_id->user_id == $_SESSION["user_id"]) $data["edit"] = true;

        }else header("location: ".URL_BASE);
        $id     = $objUser->getUserIdByName($_GET["user"]);
        $id     = $id->user_id;
        $dados  = $objUser->getUserInfo(["user_name", "user_bio", "user_following", "user_followers","user_id","user_publications"], $id);
        
        $data["image"]    = $objImagem->getImagesByUser($id);

        $data["user_name"]  = $dados["user_name"];
        $data["user_bio"]   = $dados["user_bio"];

        //if(isset($dados["user_followers"])) $data["user_followers"]         = $dados["user_followers"];else $data["user_followers"] = 0;
        //if(isset($dados["user_following"])) $data["user_following"]         = $dados["user_following"]; else $data["user_following"] = 0;
        if(isset($dados["user_publications"])) $data["user_publications"]   = $dados["user_publications"]; else $data["user_publications"] = 0;

        $seguindo = $objUser->userIsFollowing($name,$_SESSION["user_id"]);
        if($seguindo) $data["following"] = true;

        $seguindo   = $objUser->getFollowingByUserId($name);
        if(isset($seguindo) ) $data["following"] = $seguindo;
        elseif($seguindo == false) return $data["following"] = 0;
        if(!$data["following"]) $data["following"] = 0;


        $seguidores = $objUser->getfollowersByUserId($name);
        if(isset($seguidores) ) $data["followers"] = $seguidores;
        elseif($seguidores == false) return $data["followers"] = 0;
        if(!$data["followers"]) $data["followers"] = 0;

        $publicacoes = $objUser->getNumOfPubliByUserId($name);
        if(isset($publicacoes) ) $data["publications"] = $publicacoes;
        elseif($publicacoes == false) return $data["publications"] = 0;
        if(!$data["publications"]) $data["publications"] = 0;

        $data["view"]       = "profile/profilevisited";
        $this->load("template", $data);
   }

   public function follow($user){
    $objUser        = new User;

    if($objUser->isUser($user) == false) header("location: ".URL_BASE);
    if(empty($_SESSION)) session_start();

    $follow = $objUser->follow($user,$_SESSION["user_id"]);
    if($follow){ 
        $_SESSION["follow_sucess"] = true;
        header("location: ".URL_BASE."profile/?user=$user");
    }elseif($follow == "exists" || $follow == "isFollowing"){

        $_SESSION["error"]["exists"] = true;
        header("location: ".URL_BASE."profile/?user=$user"); 
    }
   }

   public function unfollow($user){
    $objUser        = new User;
    //if(!$objUser->userIsFollowing($user,$_SESSION["user_id"])) header("location: ".URL_BASE."profile/?user=$user");
    if(empty($_SESSION)) session_start();

    if($objUser->unFollow($user,$_SESSION["user_id"])) header("location: ".URL_BASE."profile/?user=$user");
    else {
        $_SESSION["error"]["unfollow"] = true;
        header("location: ".URL_BASE."profile/?user=$user");
    }
   }

}
