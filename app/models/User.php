<?php 
namespace app\models;
use app\core\Model;
include_once "app/functions/funcoes.php";


class User extends Model{
    public $USER_PROFILE = USER_PATH;

    public function verifyUserDirectory($id){
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
            if($this->verifyUserDirectory($insert)) return $insert;
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
        $temp =  selectOnceEqual($this->db,"user_id","user","user_name",$name,1);
        if($temp) return $temp;
        else return false;
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
        if(is_numeric($name)){
          if($this->getUserNameById($name)) return true;
          else return false;  
        }

        $userTrue = selectOnceEqual($this->db,"user_name","user","user_name",$name,1);
        if(!$userTrue) return false;
        $user = $userTrue->user_name;
        
        if($user == $name) return true;
        $userTrue = strtolower($userTrue->user_name);
        if($name == $userTrue) return true;
        else return false;
    }
    public function userIsFollowing($userToKnow,$currentUserId){
        
        if(is_string($currentUserId)){
            $currentUserId = $this->getUserIdByName($currentUserId);
            $currentUserId = $currentUserId->user_id;
        }
        if(is_string($userToKnow)) { 
            $userToKnow = $this->getUserIdByName($userToKnow);
           if(is_object($userToKnow))  $userToKnow = $userToKnow->user_id;
        } 

        $sql = "SELECT * FROM following WHERE follower = $userToKnow AND followed = $currentUserId";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        
        $temp = $qry->fetch(\PDO::FETCH_OBJ);
            
        if(!$temp) return false;
        return $temp->id;
    }

    public function follow($userToFollow, $currentUserId){
        $temp = $this->userIsFollowing($userToFollow,$currentUserId);
        if($temp == true) return "isFollowing";

        $userIdToFollow = $this->getUserIdByName($userToFollow);
        if(!$userIdToFollow) return false;
        $userIdToFollow = $userIdToFollow->user_id;

        if($userToFollow == $currentUserId) return "equal_users";
        $temp = $this->getUserIdByName($userToFollow);
        if( $temp->user_id == $currentUserId) return "equal_users";
        unset($temp);

        $clmn = ["follower","followed"];
        $vle  = [$userIdToFollow, $currentUserId];
        if(insertDefault($this->db, "following",$clmn,$vle)) return true;
        else return "exists";
    }

    public function getUserNameById($id){
        $return = selectOnceEqual($this->db,"user_name","user","user_id",$id,1);
        return $return->user_name;
    }

    public function unFollow($user, $currentUserId){
        $userId = $this->getUserIdByName($user);

        if($user == $currentUserId) return "equal_users";

        if($user == $currentUserId) return "equal_users";
        $temp = $this->getUserIdByName($user);
        if( $temp->user_id == $currentUserId) return "equal_users";
        unset($temp);

        $userId = $userId->user_id;
        $sql = "DELETE  FROM following  WHERE following.follower = :user AND following.followed = :currentUser";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":user", $userId);
        $qry->bindValue(":currentUser", $currentUserId);
        if($qry->execute()) return true;
        else return false;

    }
    public function getfollowersByUserId($name){
            if(is_string($name)){ 
            $name = $this->getUserIdByName($name);
            $name = $name->user_id;
        }
        $count = countAll($this->db,"following","*","follower",$name);
        if($count) return $count;
        else return false;
    }
    public function getFollowingByUserId($name){
        if(is_string($name)){ 
            $name = $this->getUserIdByName($name);
            $name = $name->user_id;
        }
        $count = countAll($this->db,"following","*","followed",$name);
        if($count) return $count;
        else return false;
    }
    public function getNumOfPubliByUserId($name){
        if(is_string($name)){ 
            $name = $this->getUserIdByName($name);
            $name = $name->user_id;
        }

        $count = countAll($this->db,"images","*","image_authorId",$name);
        if($count) return $count;
        else return false;
    }
    public function updateNameBio($user,$name,$bio){
        if(!is_numeric($user) && is_string($user)) $user = $this->getUserIdByName($user);
        if(is_object($user)) $user = $user->user_id;

        $sql = "UPDATE `user` SET `user_name` = :nome,`user_bio` = :bio  WHERE `user`.`user_id` = $user;";
        $query = $this->db->prepare($sql);
        $query->bindValue(":nome",$name);
        $query->bindValue(":bio",$bio);
        $query->execute();

        return true;
    }
    public function updateFollowing($adm){
        $ver = selectOnceEqual($this->db,"*","adm","adm_id",$adm,1);
        if(!$ver) return false;

        $users = $this->getUsers();
        
        for ($i=0; $i < count($users); $i++) { 

            $count = countAll($this->db,"following","*","follower",$users[$i]->user_id);
            
            if($count > 0){
                $sql = "UPDATE user SET user.user_followers = :vl WHERE user.user_id = :id";
                $query = $this->db->prepare($sql);
                $query->bindValue(":vl",$count);
                $query->bindValue(":id",$users[$i]->user_id);
                $query->execute();

            }elseif($count <= 0){
                $count = 0;
                
                $sql = "UPDATE user SET user.user_followers = :vl WHERE user.user_id = :id";
                $query = $this->db->prepare($sql);
                $query->bindValue(":vl",$count);
                $query->bindValue(":id",$users[$i]->user_id);
                $query->execute(); 
            }

            
            $count = countAll($this->db,"following","*","followed",$users[$i]->user_id);
            
            if($count > 0){
                $sql = "UPDATE user SET user.user_following = :vl WHERE user.user_id = :id";
                $query = $this->db->prepare($sql);
                $query->bindValue(":vl",$count);
                $query->bindValue(":id",$users[$i]->user_id);
                $query->execute();
            }

        }
    }
    public function deleteUser($id , $adm){
        
        if(!selectOnceEqual($this->db,"*","adm","adm_id",$adm->adm_id,1)) return false; 
        
        deleteById($this->db,"following","followed",$id); // deleta todas as relacoes de seguidores com esse usuario
        deleteById($this->db,"following","follower",$id); // deleta todas as relacoes de seguidores com esse usuario
        deleteById($this->db,"likes","user",$id); // deleta os likes
        deleteById($this->db,"comments","user_id",$id); // deleta os comentarios
        deleteById($this->db,"images","image_authorId", $id); // deleta as imagens

        deleteById($this->db,"user","user_id",$id); // deleta o usuario
        
        return true;
    }
    public function removeImage($imageId,$utl,$id){
        if($utl == "user"){
            $temp = selectOnceEqual($this->db,"*","user","user_id",$id,1);
            if(!$temp || $temp == false )   return false; 
        }elseif($utl == "adm"){
            $temp = selectOnceEqual($this->db,"*","adm","adm_id",$id,1);
            if(!$temp || $temp == false )   return false; 
        }

            $image = selectOnceEqual($this->db,"*","images","image_id",$imageId,1);
            $userId = $image->image_authorId;
            $user_image = $image->image_path;
            
            deleteById($this->db,"likes","image",$imageId);
            deleteById($this->db,"comments","image_id",$imageId);
            deleteById($this->db,"images","image_id",$imageId);
            
            if(is_file(USER_PATH."$user_image")){ 
                unlink(USER_PATH."$user_image");
                return true;
            }
            else return false;
    }

    public function deleteUser_user($id){
        $temp = selectOnceEqual($this->db,"*","user","user_id",$id,1);
        if(!$temp) return false;
        
        deleteById($this->db,"following","followed",$id); // deleta todas as relacoes de seguidores com esse usuario
        deleteById($this->db,"following","follower",$id); // deleta todas as relacoes de seguidores com esse usuario
        deleteById($this->db,"likes","user",$id); // deleta os likes
        deleteById($this->db,"comments","user_id",$id); // deleta os comentarios
        deleteById($this->db,"messageBox_adm","user_id",$id);
        deleteById($this->db,"users_baned","user_id", $id); // deleta as imagens
        
        $images = selectAll_equal($this->db,"images","image_authorId",$id);
        foreach($images as $img){
            $this->removeImage($img->image_id,"user",$id);
        }

        deleteById($this->db,"images","image_authorId", $id); // deleta as imagens

        $user_image = selectOnceEqual($this->db,"user_image","user","user_id",$id,1);$user_image=$user_image->user_image;
        if($user_image){
            if(is_file(USER_PATH."user$id/profile/$user_image")){ 
                unlink(USER_PATH."user$id/profile/$user_image");
            }
        }
        rmdir(USER_PATH."user$id");

        deleteById($this->db,"user","user_id",$id); // deleta o usuario
        
        return true;
    }

    public function isBanned($user){
        $temp = selectOnceEqual($this->db,"user_ban","user","user_id",$user,1);

        $temp1 = selectOnceEqual($this->db,"*","users_baned","user_id",$user,1);

        if($temp && $temp1) return true;
        elseif($temp == false || $temp == null && $temp1 == true){
            deleteById($this->db,"users_baned","user_id",$user);
            return false;
        }
        elseif($temp1 == false || $temp1 == null && $temp == true){
            updateOnceById($this->db,"user","user_ban",0,"user_id",$user);
            return false;
        }
        else return false;

    }
    public function deleteAllCommentsByUser($user){
        deleteById($this->db,"comments","user_id",$user);
    }
    public function deleteAllLikesByUser($user){
        deleteById($this->db,"likes","user",$user);
        return true;
    }
    public function deleteAllFollowingByUser($user){
        deleteById($this->db,"following","followed",$user);

        deleteById($this->db,"following","follower",$user);
        return true;
    }
    public function deleteAllImagesByUser($user){
        deleteById($this->db,"images","image_authorId",$user);
        return true;
    }

    public function deleteBoxAdmByUser($user){
        deleteById($this->db,"messageBox_adm","user_id",$user);
        return true;
    }

    public function deleteBoxByUser($user){
        $sql = "DELETE FROM messageBox_adm WHERE user_id = :user";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":user",$user);
        $qry->execute();
        return true;
    }
    public function userBan($user){
        if(!is_numeric($user) && is_string($user)) $user = $this->getUserIdByName($user);
        if(is_object($user)) $user = $user->user_id;

        $email = selectOnceEqual($this->db,"user_email","user","user_id",$user,1);
        $email = $email->user_email;

        $banned = $this->isBanned($user);
        if($banned) return "banned";
        

        updateOnceById($this->db,"user","user_ban",1,"user_id",$user);
        if(insertDefault($this->db,"users_baned",["user_id","user_email"],[$user,$email])){
            $this->deleteAllCommentsByUser($user);
            $this->deleteAllFollowingByUser($user);
            $this->deleteAllLikesByUser($user);
            $this->deleteBoxAdmByUser($user);
            $this->deleteAllImagesByUser($user);
            return true;
        }
        else return false;
      
    }
    public function removerBan($user){
        if(!is_numeric($user) && is_string($user)) $user = $this->getUserIdByName($user);
        if(is_object($user)) $user = $user->user_id;

        if($this->isBanned($user)){
            updateOnceById($this->db,"user","user_ban",0,"user_id",$user);
            deleteById($this->db,"users_baned","user_id",$user);
            
            $this->isBanned($user);
            return true;
        }else return false;
    }
    public function getUserById($id){
        return selectOnceEqual($this->db,"*","user","user_id",$id,1);
       }
       public function getUserById_array($id){
        return selectOnceEqual($this->db,"*","user","user_id",$id,2);
    }
    public function existProfileByUserId($user_id){
        if(selectOnceEqual($this->db,"user_image","user","user_id",$user_id,1)){
            return true;
        }
        else return false;
        
    }
}
?>