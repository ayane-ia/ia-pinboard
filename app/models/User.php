<?php 
namespace app\models;
use app\core\Model;
include_once "app/functions/funcoes.php";


class User extends Model{
    public $USER_PROFILE = USER_PATH;

    private function verifyUserDirectory($id){
        //$max_value = maxValue($this->db,"user_id","user") + 1;
        $directory_name =  "user".$id;
        if(is_dir($this->USER_PROFILE)) $path = "$this->USER_PROFILE$directory_name";   
        if(isset($path) && !is_dir($path)){ 
            mkdir($path);
            if(is_dir($path)) mkdir("$path/profile");
            else return false;
            if(is_dir("$path/profile")) mkdir("$path/profile/image");
            else return false;
            if(!is_dir("$path/profile/image")) return false;
            else {
                chmod("$path", 0777);
                chmod("$path/profile", 0777);
                chmod("$path/profile/image", 0777);
                return true;
            }
        }else return false;
    }
    public function createUser($userName,$email,$userPswd, $userAge){
        $columns    = ["user_name", "user_email", "user_password", "user_age"];
        $values     = [$userName, $email, $userPswd, $userAge];
        $insert = insertDefault($this->db, "user",$columns, $values);
        if($insert){
            if($this->verifyUserDirectory($insert)) return true;
        }
        else return false;
    }
    public function getUsers(){
        return selectAll($this->db, "user", 1);
    }
    public function getUserIdByEmail($email){
        return selectOnceEqual($this->db,"user_id","user","user_email",$email,1);
    }
}
?>