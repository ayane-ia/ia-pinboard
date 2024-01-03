<?php
namespace app\controllers;
use app\core\Controller;

class UserController extends Controller{
    
   public function index(){
        $data["view"] = "user_logged/home";
        $this->load("template", $data);
   } 
}
