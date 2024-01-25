<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Imagem;
use app\models\Adm;
use app\models\Box;
use app\models\User;


class BoxController extends Controller{
   public function index(){
      $objImagem  = new Imagem;
      $objBox     = new Box;
      $objUser    = new User;
      $objAdm     = new Adm;
      
      if(!isset($_SESSION)) session_start();
      if(!isset($_SESSION["user_id"])) header("location: ".URL_BASE); 

        $messages     = $objBox->getMessageByUserId($_SESSION["user_id"]);
        $adm = $objAdm->getAdm();

        for ($i=0; $i < count($messages); $i++) { 
            for ($j=0; $j < count($adm); $j++) { 
               if($messages[$i]->adm_id == $adm[$j]->adm_id) $messages[$i]->adm_name = $adm[$j]->adm_name;
            }
        }
        $data["messages"] = $messages;
        $data["view"]         = "user_logged/caixa";
        $this->load("template", $data);
   } 
}
