<?php
namespace app\controllers;
use app\core\Controller;

class HomeController extends Controller{
    
   public function index(){
        $data["view"] = "home";
        $this->load("template", $data);
   } 
   public function user(){
         if(empty($_SESSION)){
            session_start();
            if(!isset($_SESSION["user_id"])){
                  $url = URL_BASE;
                  header("location: $url");
            }
         }
         $data["view"] = "user_logged/home";
         $this->load("user_logged/template", $data);
   }
}
