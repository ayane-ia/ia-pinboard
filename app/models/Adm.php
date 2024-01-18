<?php 

namespace app\models;
use app\core\Model;
include_once "app/functions/funcoes.php";


class Adm extends Model{
    
    public function createAdm($admName,$email,$pswd){

        $columns    = ["adm_name", "adm_email", "adm_password"];
        $values     = [$admName, $email, $pswd];
        $insert     = insertDefault($this->db, "adm",$columns, $values);
        if($insert){
            $temp = selectOnceEqual($this->db,"*","adm","adm_id",$insert,1);
            return $temp;
        }
        else return false;

    }

    public function getAdm(){
        return selectAll($this->db, "adm", 1);
    }

    public function getAdmById($id){
    
        return selectOnceEqual($this->db,"*","adm","adm_id",$id,1);

    }

    public function verifyAdm($admData){

        if(!is_object($admData)) return false;
        else return true;
    
    }

    public function getAdmIdByTwo($em,$psw){

        $sql = "SELECT adm_id FROM adm WHERE adm_email = :em AND adm_password = :psw";
        $query = $this->db->prepare($sql);
        $query->bindValue(":em",$em);
        $query->bindValue(":psw",$psw);
        $query->execute();

        $temp = $query->fetch(\PDO::FETCH_OBJ);
        return $temp->adm_id;
        die(print_r($temp));

    }
}

?>