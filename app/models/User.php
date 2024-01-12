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
    public function getUserIdByName($name){
        return  selectOnceEqual($this->db,"user_id","user","user_name",$name,1);
    }
    public function getUserInfo($arr, $id){
        $sql = "SELECT * FROM user WHERE user_id = $id";
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll(\PDO::FETCH_ASSOC);

        if(is_array($arr)){
            $return = [];
            for ($i=0; $i < (count($arr)); $i++) { 
                $return[$arr[$i]] = $data[0][$arr[$i]];
            }
            //die(print_r($return));
            return $return;
        }
        else return $data[0][$arr];
    }
    public function isUser($name){
        $userTrue = selectOnceEqual($this->db,"user_name","user","user_name",$name,1);
        if(!$userTrue) return false;
        $user = $userTrue->user_name;
        
        if($user == $name) return true;
        $userTrue = strtolower($userTrue->user_name);
        if($name == $userTrue) return true;
        else return false;
    }
    public function userIsFollowing($currentUserId, $userToKnow){
        $sql = "SELECT * FROM following as fl WHERE fl.followed = :fl  AND fl.follower = :utk ";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":fl", $currentUserId);
        $qry->bindValue(":utk", $userToKnow);
        $qry->execute();

        $temp = $qry->fetch(\PDO::FETCH_OBJ);
        if(!$temp) return false;

        return $temp;
    }

    public function follow($userIdToFollow, $currentUserId){
        $temp = $this->userIsFollowing($userIdToFollow,$currentUserId);
        if($temp == true) return false;
        if(insertDefault($this->db,"following",["follower","followed"],[$userIdToFollow,$currentUserId])) return true;
        else return false;
    }
    public function getUserNameById($id){
        $return = selectOnceEqual($this->db,"user_name","user","user_id",$id,1);
        return $return->user_name;
    }
}
?>