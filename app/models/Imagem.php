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
    
    public function updateProfileImage($image, $userId){

        $user_image = selectOnceEqual($this->db,"user_image","user","user_id",$userId,1);$user_image=$user_image->user_image;
        if($user_image){
            if(is_file(USER_PATH."user$userId/profile/$user_image")){ 
                unlink(USER_PATH."user$userId/profile/$user_image");
            }
        }



        $extensao       = strchr(substr($image['name'], -5), "."); // pega a extensao

        $verify = $this->verifyImage($image,$userId);
        if(is_string($verify)) return $verify;

        $tempFile       =   $image['tmp_name'];

        $image['name']   =  date("dmYHi").$extensao; 
        $name =  $image['name'];

        $tempFile       =   $image['tmp_name'];
        $path_dest      =   USER_PATH."user$userId/profile/"; // caminho de destino

           $tempPath        =   $path_dest.$image['name'];
           
           if(is_dir($path_dest)){  
               if(move_uploaded_file($tempFile, $tempPath))
               {
                chmod($tempPath, 0777);
                updateOnceById($this->db,"user","user_image",$name,"user_id",$userId);
                return true;
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

    public function getImagesPerCategory($categoryName){
         
        if(is_string($categoryName) && !is_numeric($categoryName)){
            $sql  = "SELECT category_id FROM categories as ct WHERE ct.category_name = :vl";
            $qry  = $this->db->prepare($sql);
            $qry->bindValue(":vl", $categoryName);
            $qry->execute();
            $id = $qry->fetch(\PDO::FETCH_OBJ);
            $id = $id->category_id;
        }else{
            $id = $categoryName;
        }
         
        $sql  = "SELECT * FROM images as im WHERE im.image_category = $id";
        $qry  = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }    public function getImagesPerCategory_array($categoryName){
         
        if(is_string($categoryName) && !is_numeric($categoryName)){
            $sql  = "SELECT category_id FROM categories as ct WHERE ct.category_name = :vl";
            $qry  = $this->db->prepare($sql);
            $qry->bindValue(":vl", $categoryName);
            $qry->execute();
            $id = $qry->fetch(\PDO::FETCH_OBJ);
            $id = $id->category_id;
        }else{
            $id = $categoryName;
        }
         
        $sql  = "SELECT * FROM images as im WHERE im.image_category = $id";
        $qry  = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getImagesByUser($user_id){
        
        return selectAll_equal($this->db,"images","image_authorId",$user_id);
    }

    public function getImageById($imageId){

        return selectOnceEqual($this->db,"*","images","image_id",$imageId,1);
         
    }

    public function getUserIdByName($name){
        $temp =  selectOnceEqual($this->db,"user_id","user","user_name",$name,1);
        if(!$temp) return false;
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
        $sql = "SELECT * FROM likes WHERE image = $imageId AND user = $user_id ";
        $query = $this->db->prepare($sql);
        $query->execute();

        $temp = $query->fetch(\PDO::FETCH_OBJ);

        if($temp == true || $temp != null) return true;
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
        for ($i=0; $i < count($temp); $i++) { 
            $_temp = selectOnceEqual($this->db,"user_image","user","user_id",$temp[$i]->user_id,1);
            if($_temp) $temp[$i]->user_image = $_temp->user_image;
        }
        return $temp;
    }

    public function isCategory($ct){
        $temp = selectOnceEqual($this->db,"*","categories","category_id",$ct,1);
        if($temp != false && $temp != null) return $temp;
        else return false;
    }
    public function getImagesByUserCategory($user, $ct){
        $sql = "SELECT * FROM images WHERE image_authorId = $user AND image_category = $ct";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getMoreImages($userId, $category, $currentImageId){
        if(is_string($userId) && !is_numeric($userId)) $userId = $this->getUserIdByName($userId);
        elseif($userId == false || $userId == null) die("fatal error <a href=".URL_BASE.">Voltar a home?</a>");

        $allCategory    = $this->getImagesPerCategory($category);

        for ($j= 0 ; $j < count($allCategory); $j++) { 
            if($allCategory[$j]->image_id != $currentImageId) $total[$j] = $allCategory[$j];
        }

        if(isset($total)){
            if( $total == null || $total == false) return false;
            else return $total;
        }
        else return false;
    }
    public function removeImage($imageId){
            $image = selectOnceEqual($this->db,"*","images","image_id",$imageId,1);
            $userId = $image->image_authorId;
            $user_image = $image->image_path;
            
            
            if(is_file(USER_PATH."$user_image")){ 
                unlink(USER_PATH."$user_image");
              
            }
            else return false;
    }

}
?>