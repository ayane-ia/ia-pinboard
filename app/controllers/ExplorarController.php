<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Imagem;

class ExplorarController extends Controller{
   public function index(){
      $objImage               = new Imagem;
      $data["categories"]     = $objImage->getCategories();
      $data["view"]           = "explorar";
      $this->load("template", $data);
   }
   public function categorias($name){
      $objImage               = new Imagem;
      $data["imagens"]        = $objImage->getImagesPerCategory($name);
      //die(print_r($data["imagens"]));
      $data["ct_name"]        = $name;
      $data["view"]           = "categorias";
      $this->load("template", $data);  
      }
}
