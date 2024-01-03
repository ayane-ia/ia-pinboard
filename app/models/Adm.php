<?php 
namespace app\models;
use app\core\Model;
include_once "app/functions/funcoes.php";

class Adm extends Model{
    public function createAdm($admName,$email,$pswd){
        $columns    = ["adm_name", "adm_email", "adm_password"];
        $values     = [$admName, $email, $pswd];
        if(insertDefault($this->db, "adm",$columns, $values)) return true;
        else return false;
    }
    public function getAdm(){
        return selectAll($this->db, "adm", 1);
    }
}
?>