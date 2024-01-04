<?php 
namespace app\models;
use app\core\Model;
include_once "app/functions/funcoes.php";

class Imagem extends Model{
    public function getCategories(){        
        $lista = selectAll($this->db, "categories", 1);
        return $lista;
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
        $clmns          = ["image_name","image_title","image_author","image_category","image_description"];
        $sql            = "SELECT count(id) FROM images WHERE image_authorId = $userId";
        $query          = $this->db->prepare($sql);
        $query->execute(); 
        $imageId        = $query->fetch(\PDO::FETCH_OBJ);
        $image["name"]  = "user$userId"."image$imageId";
        $values         = [$image['name'], $title, $userId, $ctg, $desc];
        if(insertDefault($this->db,"images",$clmns, $values)) return true;
        else return false;
    }
}
?>