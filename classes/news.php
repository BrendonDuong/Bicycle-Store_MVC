<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<style>
    .success{
	color: royalblue;
	font-size: 18px;
}
    .error{
	color: red;
	font-size: 18px;
}
</style>    
<?php
   /**
    * 
    */
    class news 
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_news($data,$files){
           
            $title = mysqli_real_escape_string ($this->db->link, $data['title']);
            $post_category = mysqli_real_escape_string ($this->db->link, $data['post_category']);
            $news_desc = mysqli_real_escape_string ($this->db->link, $data['news_desc']);
            $content = mysqli_real_escape_string ($this->db->link, $data['content']);
            $news_status = mysqli_real_escape_string ($this->db->link, $data['news_status']);
            //Check the image and get the image into the upload folder
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($title=="" || $post_category=="" || $news_desc=="" || $content=="" || $news_status=="" || $file_name==""){
                $alert = "<span class='error'>Fields must be not empty!</span>";
                return $alert;
            }else{
                if(!empty($file_name)){   
                    //if the user selects a image            
                if($file_size > 20480){
                    // echo ="<span class='error'>Image should be less than 1MB!</span>";
                     $alert = "<span class='error'>Image should be less than 2MB!</span>";
                    return $alert;
                }
                elseif (in_array($file_ext, $permited) === false)
                {
                    // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                    $alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO news(title,post_category,description,content,status,image) VALUES('$title','$post_category','$news_desc','$content','$news_status','$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert News Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert News Not Success</span>";
                    return $alert;
                }
              }
            }
        }
        public function show_news(){
            // $query = "SELECT p.*, c.catName, b.brandName 
            // FROM product as p, category as c, brand as b WHERE p.catId = c.catId 
            // AND p.brandId = b.brandId
            // order by p.productId desc";

            $query = "SELECT news.*, category_post_news.title 
            FROM news INNER JOIN category_post_news ON news.cate_post_newsId = category_post_news.cate_post_newsId 
            order by news.newsId desc";

            // $query = "SELECT * FROM product order by productId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_news($data,$files,$id){
   
            $title = mysqli_real_escape_string ($this->db->link, $data['title']);
            $post_category = mysqli_real_escape_string ($this->db->link, $data['post_category']);
            $news_desc = mysqli_real_escape_string ($this->db->link, $data['news_desc']);
            $content = mysqli_real_escape_string ($this->db->link, $data['content']);
            $news_status = mysqli_real_escape_string ($this->db->link, $data['news_status']);
            //Check the image and get the image into the upload folder
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            // $file_current = strtolower(current($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($title=="" || $post_category=="" || $news_desc=="" || $content=="" || $news_status==""){
                $alert = "<span class='error'>Fields must be not empty!</span>";
                return $alert;
            }else{
                if(!empty($file_name)){   
                    //if the user selects a image            
                if($file_size > 20480){
                    // echo ="<span class='error'>Image should be less than 1MB!</span>";
                     $alert = "<span class='error'>Image should be less than 2MB!</span>";
                    return $alert;
                }
                elseif (in_array($file_ext, $permited) === false)
                {
                    // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                    $alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "UPDATE news SET 
                title = '$title', 
                post_category = '$post_category', 
                description = '$news_desc', 
                content = '$content', 
                image = '$unique_image', 
                status = '$news_status' 

                WHERE newsId = '$id'";
            }else{
                //if user doesn't select image      
                $query = "UPDATE news SET 
                title = '$title', 
                post_category = '$post_category', 
                description = '$news_desc', 
                content = '$content', 
                status = '$news_status' 

                WHERE newsId = '$id'";
            }
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>News Updated Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>News Updated Not Success</span>";
                    return $alert;
                }
            }  
            
        }
        public function del_news($id){
            $query = "DELETE FROM news WHERE newsId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>News Deleted Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>News Deleted Not Success</span>";
                return $alert;
            }
        }
        public function getnewsbyId($id){
            $query = "SELECT * FROM news WHERE newsId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>