<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Imagem;
use app\models\Adm;
use app\models\User;

class AdmController extends Controller{
   public function index(){
      $objImagem = new Imagem;
      $objUser   = new User;
      $objAdm    = new Adm;
      if(!isset($_SESSION)) session_start();
      if(!isset($_SESSION["adm"]) && !isset($_SESSION["adm"]->adm_id)) header("location: ".URL_BASE);
      if(!$objAdm->verifyAdm($_SESSION["adm"])) header("location: ".URL_BASE);

        $data["view"]         = "adm/home";
        $this->load("adm/template", $data);
   }
   
   public function users($adm){
      
      $objImagem = new Imagem;
      $objUser   = new User;
      $objAdm    = new Adm;

      if(!isset($_SESSION)) session_start();
      if(!isset($_SESSION["adm"]) && !isset($_SESSION["adm"]->adm_id)) header("location: ".URL_BASE);
      if(!$objAdm->verifyAdm($_SESSION["adm"])) header("location: ".URL_BASE);
      $objUser->updateFollowing($_SESSION["adm"]->adm_id);
      $data["users"] = $objUser->getUsers();

      $data["view"]  = "adm/listausuarios";
      $this->load("adm/template",$data);

   }

   public function conteudo($user){
      
      $objImagem = new Imagem;
      $objUser   = new User;
      $objAdm    = new Adm;
      if(!isset($_SESSION)) session_start();
      if(!isset($_SESSION["adm"]) && !isset($_SESSION["adm"]->adm_id)) header("location: ".URL_BASE);
      if(!$objAdm->verifyAdm($_SESSION["adm"])) header("location: ".URL_BASE);

      $data["imagens"] = $objImagem->getAllImages();

      $data["view"]  = "adm/conteudo";
      $this->load("adm/template",$data);
   }
   public function categorias($id){
      $objImagem = new Imagem;
      $objUser   = new User;
      $objAdm    = new Adm;
      if(!isset($_SESSION)) session_start();
      if(!isset($_SESSION["adm"]) && !isset($_SESSION["adm"]->adm_id)) header("location: ".URL_BASE);
      if($id != $_SESSION["adm"]->adm_id) header("location: ".URL_BASE);
      if(!$objAdm->verifyAdm($_SESSION["adm"])) header("location: ".URL_BASE);
      

      $data["categorias"] = $objImagem->getCategories();

      if(isset($_POST) && isset($_POST["name"])){  

         if($objAdm->setCategory($_POST["name"],$_FILES["image"])) header("location: ".URL_BASE."adm/categorias/$id");
         else header("location: ".URL_BASE);
      }

      $data["view"]  = "adm/categorias";
      $this->load("adm/template",$data);
   }
   public function ixnel($id){
      $objImagem = new Imagem;
      $objUser   = new User;
      $objAdm    = new Adm;
      if(!isset($_SESSION)) session_start();
      if(!isset($_SESSION["adm"]) && !isset($_SESSION["adm"]->adm_id)) header("location: ".URL_BASE);
      if($id != $_SESSION["adm"]->adm_id) header("location: ".URL_BASE);
      if(!$objAdm->verifyAdm($_SESSION["adm"])) header("location: ".URL_BASE);

      $objUser->deleteUser($id, $_SESSION["adm"]);
      $admId = $_SESSION["adm"]->adm_id;
      if($objUser->deleteUser($id, $_SESSION["adm"])) header("location: ".URL_BASE."adm/users/$admId");
      else header("location: ".URL_BASE);
   }
}