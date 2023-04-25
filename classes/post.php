<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<style>
    .success{
	color:royalblue;
	font-size: 18px;
}
.error{
	color:red;
	font-size: 18px;
}
</style>    
<?php
   /**
    * 
    */
    class post 
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_news_category_post($catName,$catDesc,$catStatus){
            $catName = $this->fm->validation($catName);
            $catDesc = $this->fm->validation($catDesc);
            $catStatus = $this->fm->validation($catStatus);
            $catName = mysqli_real_escape_string ($this->db->link, $catName);
            $catDesc = mysqli_real_escape_string ($this->db->link, $catDesc);
            $catStatus = mysqli_real_escape_string ($this->db->link, $catStatus);

            if(empty($catName) || empty($catDesc)){
                $alert = "<span class='error'>Fields must be not empty!</span>";
                return $alert;
            }else{
                $query = "INSERT INTO category_post_news(title,description,status) VALUES('$catName','$catDesc','$catStatus')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert Post Category Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert Post Category Not Success</span>";
                    return $alert;
                }
                
            }
        }
        public function show_category_post(){
            $query = "SELECT * FROM category_post_news order by cate_post_newsId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_news_category_post($catName,$catDesc,$catStatus,$id){

            $catName = $this->fm->validation($catName);
            $catDesc = $this->fm->validation($catDesc);
            $catStatus = $this->fm->validation($catStatus);
            $catName = mysqli_real_escape_string ($this->db->link, $catName);
            $catDesc = mysqli_real_escape_string ($this->db->link, $catDesc);
            $catStatus = mysqli_real_escape_string ($this->db->link, $catStatus);
            $id = mysqli_real_escape_string ($this->db->link, $id);

            if(empty($catName) || empty($catDesc)){
                $alert = "<span class='error'>Fields must be not empty!</span>";
                return $alert;
            }else{
                $query = "UPDATE category_post_news SET title='$catName',description='$catDesc',status='$catStatus' WHERE cate_post_newsId='$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Post Category Updated Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Post Category Updated Not Success</span>";
                    return $alert;
                }
                
            }
        }
        public function del_category_post($id){
            $query = "DELETE FROM category_post_news WHERE cate_post_newsId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Post Category Deleted Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Post Category Deleted Not Success</span>";
                return $alert;
            }
        }
        public function getpostcatbyId($id){
            $query = "SELECT * FROM category_post_news WHERE cate_post_newsId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getnewsbypostcatId($id){
            $query = "SELECT category_post_news.* FROM category_post_news WHERE category_post_news.cate_post_newsId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function show_category_frontend(){
            $query = "SELECT * FROM category order by catId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_post_by_cat($id){
            $query = "SELECT news.* FROM news WHERE news.post_category = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_name_by_cat($id){
            $query = "SELECT product.*, category.catName,category.catId FROM product,category WHERE product.catId = category.catId AND product.catId ='$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getnewsbyId($id){
            $query = "SELECT * FROM news WHERE news.newsId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>