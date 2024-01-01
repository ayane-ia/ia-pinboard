<?php 
namespace app\models;
use app\core\Model;
include_once "app/functions/funcoes.php";


class User extends Model{
    public $USER_PROFILE = USER_PATH;

    private function verifyUserDirectory($id){
        //$max_value = maxValue($this->db,"user_id","user") + 1;
        $directory_name =  "user".$id;
        if(is_dir($this->USER_PROFILE))  $path = "$this->USER_PROFILE$directory_name";
        if(isset($path) && !is_dir($path)){
            mkdir($path);
            if(is_dir($path)) mkdir("$path/profile");
            else return false;
            if(is_dir("$path/profile")) mkdir("$path/profile/image");
            else return false;
            if(!is_dir("$path/profile/image")) die("erro3");
            else {
                chmod($path,0777);
                chmod("$path/profile",0777);
                chmod("$path/profile/image",0777);
                return "$path/profile/image/";
            }
        }else return false;
    }
    public function createUser($userName,$email,$userPswd, $userAge, $userImage = false){
        $columns    = ["user_name", "user_email", "user_password", "user_age"];
        $values     = [$userName, $email, $userPswd, $userAge];
        $insert     = insertDefault($this->db, "user", $columns, $values);
        if(!$insert) return false;
            if($userImage){
                $imagem = filter_input(INPUT_POST, 'imagem', FILTER_DEFAULT);
                     
                list($type, $imagem) = explode(';', $imagem);
                list(, $imagem) = explode(',', $imagem);
                $imagem         = base64_decode($imagem);
                $imagem_nome    = time() . '.png';

                file_put_contents('imagens' . $imagem_nome, $imagem);
            }
    }
    public function getUsers(){
        return selectAll($this->db, "user", 1);
    }
}
?>