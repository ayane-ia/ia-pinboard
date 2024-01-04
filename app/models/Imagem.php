<?php 
namespace app\models;
use app\core\Model;
include_once "app/functions/funcoes.php";

class Imagem extends Model{
    public function getCategories(){        
        $lista = selectAll($this->db, "categories", 1);
        return $lista;
    }
    public function getNumberOfImages($id){
        $sql    = "SELECT COUNT(image_id) as temp FROM images WHERE image_authorId = $id";
        $query  = $this->db->prepare($sql);
        $query->execute();
        $temp = $query->fetch(\PDO::FETCH_OBJ);
        return $temp->temp;
    }
    public function verifyImage($image, $userId){
        $path = USER_PATH."user$userId/";
        
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
    public function enviarImagem($image,$title, $userId, $desc, $ctg){

        $id = $this->getNumberOfImages($userId) + 1;
        $clmns          = ["image_name","image_title","image_authorId","image_category","image_description"];
        $values         = ["user$userId"."image$id", $title, $userId, $ctg, $desc];
           $tempFile        =   $image['tmp_name'];
           $path_dest       =   USER_PATH."user$userId/"; // caminho de destino

           $extensao = strchr(substr($image['name'], -5), "."); // pega a extensao

           $image['name']   =   "user$userId"."image$id".$extensao; // seta um nome diferente

           $tempPath        =   $path_dest.$image['name'];
           if(is_dir($path_dest)){  
               if(move_uploaded_file($tempFile, $tempPath))
               {
                chmod($tempPath, 0777);
                 if(insertDefault($this->db,"images",$clmns,$values)) return true;
                 else return false;
               }
               else
               {   
                 return "notSend";//die("erro ao enviar o arquivo <hr>".$arquivo_temporario."  -- <b>TO</b> --  ".$path_dest."<hr> code :". $input_file['error']); // nao foi possivel enviar o arquivo
               }
            }
            else{
                return "notDir";
            }
        
    }
}
?>