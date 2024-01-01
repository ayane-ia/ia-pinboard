<?php 
namespace app\models;
use app\core\Model;
include_once "app/functions/funcoes.php";

class User extends Model{
    public function createUser($userName,$email,$userPswd, $userAge){
        $columns    = ["user_name", "user_email", "user_password", "user_age"];
        $values     = [$userName, $email, $userPswd, $userAge];
        if(insertDefault($this->db, "user",$columns, $values)) return true;
        else return false;
    }
    public function getUsers(){
        return selectAll($this->db, "user", 1);
    }
}
?>