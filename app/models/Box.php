<?php 
namespace app\models;
use app\core\Model;

class Box extends Model{
    
    public function setMessage($text, $user_id,$adm){
        $verify = selectOnceEqual($this->db,"*","adm","adm_id",$adm,1);
        if(!$verify) return false;

        $user = selectOnceEqual($this->db,"*","user","user_id",$user_id,1);
        if(!$user || $user == null || $user == false) return false;

        if(insertDefault($this->db,"messageBox_adm",["adm_id","user_id","content"],[$adm,$user_id,$text])) return true;
        else return false;
    }
    public function getMessageByAdmId($adm_id){
        return selectAll_equal_desc($this->db,"messageBox_adm","adm_id",$adm_id,"create_time");
    }
    public function getMessageByUserId($user_id){
        return selectAll_equal_desc($this->db,"messageBox_adm","user_id",$user_id,"create_time");
    }
    public function deleteMessage($id){
        deleteById($this->db,"messageBox_adm","message_id",$id);
        return true;
    }

}

?>