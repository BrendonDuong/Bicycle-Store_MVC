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
    class brand 
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_brand($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string ($this->db->link, $brandName);

            if(empty($brandName)){
                $alert = "<span class='error'>Brand must be not empty!</span>";
                return $alert;
            }else{
                $query = "INSERT INTO brand(brandName) VALUES('$brandName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert Brand Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert Brand Not Success</span>";
                    return $alert;
                }
                
            }
        }
        public function show_brand(){
            $query = "SELECT * FROM brand order by brandId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_brand($brandName,$id){

            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string ($this->db->link, $brandName);
            $id = mysqli_real_escape_string ($this->db->link, $id);

            if(empty($brandName)){
                $alert = "<span class='error'>Brand must be not empty!</span>";
                return $alert;
            }else{
                $query = "UPDATE brand SET brandName='$brandName' WHERE brandId='$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Brand Updated Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Brand Updated Not Success</span>";
                    return $alert;
                }
                
            }
        }
        public function del_brand($id){
            $query = "DELETE FROM brand WHERE brandId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Brand Deleted Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Brand Deleted Not Success</span>";
                return $alert;
            }
        }
        public function getbrandbyId($id){
            $query = "SELECT * FROM brand WHERE brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_product_by_brand($id){
            $query = "SELECT product.*, category.catName, brand.brandName 
            FROM product INNER JOIN category ON product.catId = category.catId 
            INNER JOIN brand ON product.brandId = brand.brandId
            WHERE product.brandId = '$id' order by brandId desc LIMIT 8";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_name_by_brand($id){
            $query = "SELECT product.*, brand.brandName,brand.brandId FROM product,brand WHERE product.brandId = brand.brandId AND product.brandId ='$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>