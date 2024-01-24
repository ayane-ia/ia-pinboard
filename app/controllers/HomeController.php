<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Imagem;

class HomeController extends Controller{
   public function index(){
      $objImagem = new Imagem;
        $data["imagens"]      = $objImagem->getAllImages();
        $data["view"]         = "home";
        $this->load("template", $data);
   } 
}
