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

    public function getImageById($imageId){

        return selectOnceEqual($this->db,"*","images","image_id",$imageId,1);
         
    }

    public function getUserIdByName($name){
        $temp =  selectOnceEqual($this->db,"user_id","user","user_name",$name,1);
        return $temp->user_name;
    }

    public function isImage($image_id){
        $temp = selectOnceEqual($this->db,"*","images","image_id",$image_id,1);
        if(!$temp) return false;
        if($temp != null && $temp != false) return true;
        else return false;
    }

    public function like($image_id, $user_id){
        if(is_string($user_id)) $user_id = $this->getUserIdByName($user_id);
        elseif($user_id == false || $user_id == null) die("fatal error <a href=".URL_BASE.">Voltar a home?</a>");
        if(!$this->isImage($image_id)) return false;

        insertDefault($this->db,"likes",["image","user"],[$image_id,$user_id]);
        return true;

    }

    public function getLikesByImageId($imageId){
        $count = countAll($this->db,"likes","*","image",$imageId);
        return $count;
    }

    public function isLike($imageId, $user_id){
        $temp = selectPerTwoValues_Equals($this->db,"likes","image","user",$imageId,$user_id);
        if($temp == true) return true;
        elseif($temp == false || $temp == null) return false;
    }

    public function unlike($imageId, $user_id){
        if(is_string($user_id)) $user_id = $this->getUserIdByName($user_id);
        elseif($user_id == false || $user_id == null) die("fatal error <a href=".URL_BASE.">Voltar a home?</a>");

        if(!$this->isImage($imageId)) return false;

        if($this->isLike($imageId, $user_id) || $this->isLike($imageId, $user_id) == null){
            deleteById_twoEquals($this->db,"likes","image","user",$imageId,$user_id);
            return true;
        }else return false;
    
    }
    public function isComent($image_id, $user_id, $content){
        $sql = "SELECT * FROM comments AS cm WHERE cm.image_id = :imd AND cm.user_id = :userid AND cm.comment_content = :cntt ";
        $query = $this->db->prepare($sql);
        $query->bindValue(":imd", $image_id);
        $query->bindValue(":userid", $user_id);
        $query->bindValue(":cntt", $content);
        $query->execute();
        $temp = $query->fetch(\PDO::FETCH_OBJ);
        if($temp) return true;
        else return false;
        
    }
    public function insertComment($imageId, $userId, $content){
        if(is_string($userId)) $userId = $this->getUserIdByName($userId);
        elseif($userId == false || $userId == null) die("fatal error <a href=".URL_BASE.">Voltar a home?</a>");
        if(!$this->isImage($imageId)) return false;

        if($this->isComent($imageId,$userId,$content)) return "exist";
        if(insertDefault($this->db,"comments",["image_id","user_id","comment_content"], [$imageId,$userId,$content])) return true;
        else return false;

    }
    public function getCommentsByImageId($imageId){
        $temp = selectAll_equal($this->db,"comments","image_id",$imageId);
        return $temp;
    }
}
?>