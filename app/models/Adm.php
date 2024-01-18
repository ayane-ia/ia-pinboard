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
    public function verifyImage($image){
        $path = "../../assets/images/categories/";
        
        $verify = verifyFile($image,$path,15000000,[".jpg",".png",".jfif",".jpeg"]);
        if(is_string($verify)){
            switch ($verify) {
                case 'error_mime':
                    return 'mime';
                break;
                
                case 'error_size':
                    return 'size';
                break;
            }
        }
        else return true;
    }

    public function enviarImagem($image, $name){

        $extensao       = strchr(substr($image['name'], -5), "."); // pega a extensao
       
        $path           =   date("dmYHi")."$name".$extensao;

        $tempFile       =   $image['tmp_name'];
        $path_dest      =   PATH_BASE."assets/images/categories/"; // caminho de destino

        $image['name']   =  date("dmYHi").$name.$extensao; // seta um nome diferente
        
            if(is_dir($path_dest)){  
               if(move_uploaded_file($tempFile, $path_dest.$image["name"]))
               {
                chmod($path_dest, 0777);
                return $path;
               }
               else
               {   

                 return 1; //die("erro ao enviar o arquivo <hr>".$arquivo_temporario."  -- <b>TO</b> --  ".$path_dest."<hr> code :". $input_file['error']); // nao foi possivel enviar o arquivo
               
                }
            }
            else{
                
                return 2; // not dir
            }

    }

    public function setCategory($name, $image){

        
        if(!$this->verifyImage($image)) return false;
        $sendImage = $this->enviarImagem($image,$name);
        if(!$sendImage) return false;
        if(is_numeric($sendImage)) return false;

        $insert = insertDefault($this->db,"categories",["category_name","category_image"],[$name, $sendImage],1);
        if($insert) return true;
        else return false;

    }
}

?>