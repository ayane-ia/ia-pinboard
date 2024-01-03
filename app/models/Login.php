<?php 
namespace app\models;
use app\core\Model;
use app\models\User;
include_once "app/functions/funcoes.php";

class Login extends Model{
    public function login($email,$pswd){
        $objUser = new User;
        $email = trim($email);
        $ac = 0;
        for($i = 0; $i<=3; $i++){
            if($email[$i] == "#"){
                $ac++;
            }
        }
        if($ac == 3){ 
            $a = 0;
            for($k = 3; $k <= (strlen($email) - 1); $k++){
                $temp_email[$a] = $email[$k]; 
                $a++;
            }
            $a = 0; // while parameter
            $temp_password = "";
            for($i = 0; $i < (strlen($email) - 1); $i++){
                if($temp_email[$i] == "#") break;
                $temp_password[$i] = $temp_email[$i];
            }
            if($temp_password == $pswd){ 
                unset($temp_password,$a,$k,$temp_email);
                $adm = selectOnceEqual($this->db, "*","adm","adm_password",$pswd,1);
                $countCrd = strlen($adm->adm_password); //count_credencial now count the password
                if($adm != null &&  strlen($pswd) == $countCrd){ 
                    if($email[2 + ($countCrd + 1)] == "#"){
                        $position = 2 + ($countCrd + 1);
                        if( $email[$position + 2] == "a" &&
                            $email[$position + 3] == "d" &&
                            $email[$position + 4] == "m" &&
                            $email[$position + 5] == "i" &&
                            $email[$position + 6] == "n"){
                                // code
                                if($email[$position + 7] == "#" && $email[$position + 8] == "#"){
                                    for($i = $position + 9; $i < (strlen($email)); $i++){
                                        $temp_email[$i] = $email[$i];
                                    }
                                    $temp_email = implode("",$temp_email);
                                    if($temp_email == $adm->adm_email){
                                        return "adm";
                                    }
                                }
                        }
                    }
                }
            }
        }
        $clmns = ["user_email", "user_password"];
        if (Login_model($this->db,"user",$clmns,$email,$pswd)) return true;
        else return false; 
    }
}
?>