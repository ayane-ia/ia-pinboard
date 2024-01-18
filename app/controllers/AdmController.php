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
}