<?php
namespace app\controllers;
use app\core\Controller;

class HomeController extends Controller{
    
   public function index(){
        $data["view"] = "home";
        $this->load("template", $data);
   } 
   public function user(){

   }
}
