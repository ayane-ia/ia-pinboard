<?php 
namespace app\models;
use app\core\Model;
include_once "app/functions/funcoes.php";

class Imagem extends Model{
    public function getCategories(){        
        $lista = selectAll($this->db, "categories", 1);
        return $lista;
    }
    public function getAllImages(){
        return selectAll($this->db, "images", 1);
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
        $extensao       = strchr(substr($image['name'], -5), "."); // pega a extensao
        $id             = $this->getNumberOfImages($userId) + 1;
        $path           = "user$userId/"."user$userId"."image$id".$extensao;
        $clmns          = ["image_name","image_title","image_path","image_authorId","image_category","image_description"];
        $values         = ["user$userId"."image$id", $title, $path, $userId, $ctg, $desc];
        $tempFile       =   $image['tmp_name'];
        $path_dest      =   USER_PATH."user$userId/"; // caminho de destino

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
    public function getCategoryIdByName($name){

    }

    public function getImagesPerCategory($categoryName){
         
        $sql  = "SELECT category_id FROM categories as ct WHERE ct.category_name = :vl";
        $qry  = $this->db->prepare($sql);
        $qry->bindValue(":vl", $categoryName);
        $qry->execute();
        $id = $qry->fetch(\PDO::FETCH_OBJ);
        $id = $id->category_id;
         
        $sql  = "SELECT * FROM images as im WHERE im.image_category = $id";
        $qry  = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getImagesByUser($user_id){
        return selectAll_equal($this->db,"images","image_authorId",$user_id);
    }
}
?>