<?php
namespace app\controllers;
use app\core\Controller;

class HomeController extends Controller{
    
   public function index(){
        $data["view"] = "home";
        $this->load("template", $data);
   } 
   public function user(){
         $data["view"] = "user_logged/home";
         $this->load("user_logged/template", $data);
   }
}
