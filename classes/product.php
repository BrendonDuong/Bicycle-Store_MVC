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
    class product 
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function search_product($words){
            $words = $this->fm->validation($words);
            $query = "SELECT * FROM product WHERE productName LIKE '%$words%' OR price LIKE '%$words%'";
            $result = $this->db->select($query);
            return $result;
        }
        public function insert_product($data,$files){
           
            $productName = mysqli_real_escape_string ($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string ($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string ($this->db->link, $data['category']);
            $product_desc = mysqli_real_escape_string ($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string ($this->db->link, $data['price']);
            $type = mysqli_real_escape_string ($this->db->link, $data['type']);
            //Check the image and get the image into the upload folder
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type=="" || $file_name==""){
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
                $query = "INSERT INTO product(productName,brandId,catId,product_desc,price,type,image) VALUES('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert Bicycle Product Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert Bicycle Product Not Success</span>";
                    return $alert;
                }
              }
            }
        }
        public function insert_slider($data,$files){
            $sliderName = mysqli_real_escape_string ($this->db->link, $data['sliderName']);
            $type = mysqli_real_escape_string ($this->db->link, $data['type']);
             //Check the image and get the image into the upload folder
             $permited = array('jpg', 'jpeg', 'png', 'gif');
             $file_name = $_FILES['slider_image']['name'];
             $file_size = $_FILES['slider_image']['size'];
             $file_temp = $_FILES['slider_image']['tmp_name'];
 
             $div = explode('.', $file_name);
             $file_ext = strtolower(end($div));
             // $file_current = strtolower(current($div));
             $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
             $uploaded_image = "uploads/".$unique_image;
 
             if($sliderName=="" || $type==""){
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
                 $query = "INSERT INTO slider(sliderName,type,slider_image) VALUES('$sliderName','$type','$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Slider Added Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Slider Added Not Success</span>";
                    return $alert;
                   }
                }
             }  
        }
        public function show_slider(){
             $query = "SELECT * FROM slider WHERE type='1' order by sliderId desc";
             $result = $this->db->select($query);
             return $result;
        }
        public function show_slider_list(){
            $query = "SELECT * FROM slider order by sliderId desc";
            $result = $this->db->select($query);
            return $result;
       }
        public function update_type_slider($id,$type){
            $type = mysqli_real_escape_string ($this->db->link, $type);
            $query = "UPDATE slider SET type = '$type' WHERE sliderId='$id'";
             $result = $this->db->update($query);
             return $result;
        }
        public function del_slider($id){
            $query = "DELETE FROM slider WHERE sliderId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Slider Deleted Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Slider Deleted Not Success</span>";
                return $alert;
            }
        }
        public function show_product(){
            // $query = "SELECT p.*, c.catName, b.brandName 
            // FROM product as p, category as c, brand as b WHERE p.catId = c.catId 
            // AND p.brandId = b.brandId
            // order by p.productId desc";

            $query = "SELECT product.*, category.catName, brand.brandName 
            FROM product INNER JOIN category ON product.catId = category.catId 
            INNER JOIN brand ON product.brandId = brand.brandId
            order by product.productId desc";

            // $query = "SELECT * FROM product order by productId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_slider($data,$files,$id){
   
            $sliderName = mysqli_real_escape_string ($this->db->link, $data['sliderName']);
            // $type = mysqli_real_escape_string ($this->db->link, $data['type']);
             //Check the image and get the image into the upload folder
             $permited = array('jpg', 'jpeg', 'png', 'gif');
             $file_name = $_FILES['slider_image']['name'];
             $file_size = $_FILES['slider_image']['size'];
             $file_temp = $_FILES['slider_image']['tmp_name'];
 
             $div = explode('.', $file_name);
             $file_ext = strtolower(end($div));
             // $file_current = strtolower(current($div));
             $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
             $uploaded_image = "uploads/".$unique_image;
 
             if($sliderName=="" ){//|| $type==""
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
                $query = "UPDATE slider SET 
                sliderName = '$sliderName', 
                slider_image = '$unique_image' 
                

                WHERE sliderId = '$id'";
            }else{
                //if user doesn't select image      
                $query = "UPDATE slider SET 
                sliderName = '$sliderName'

                WHERE sliderId = '$id'";
            }
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Slider Updated Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Slider Updated Not Success</span>";
                    return $alert;
                }
            }  
            
        }
        public function update_product($data,$files,$id){
   
            $productName = mysqli_real_escape_string ($this->db->link, $data['productName']);
            $brand = mysqli_real_escape_string ($this->db->link, $data['brand']);
            $category = mysqli_real_escape_string ($this->db->link, $data['category']);
            $product_desc = mysqli_real_escape_string ($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string ($this->db->link, $data['price']);
            $type = mysqli_real_escape_string ($this->db->link, $data['type']);
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

            if($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $type==""){
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
                $query = "UPDATE product SET 
                productName = '$productName', 
                brandId = '$brand', 
                catId = '$category', 
                product_desc = '$product_desc', 
                price = '$price', 
                image = '$unique_image', 
                type = '$type' 

                WHERE productId = '$id'";
            }else{
                //if user doesn't select image      
                $query = "UPDATE product SET 
                productName = '$productName', 
                brandId = '$brand', 
                catId = '$category', 
                product_desc = '$product_desc', 
                price = '$price', 
                type = '$type' 

                WHERE productId = '$id'";
            }
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Bicycle Product Updated Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Bicycle Product Updated Not Success</span>";
                    return $alert;
                }
            }  
            
        }
        public function del_product($id){
            $query = "DELETE FROM product WHERE productId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Bicycle Product Deleted Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Bicycle Product Deleted Not Success</span>";
                return $alert;
            }
        }
        public function del_wlist($proid, $customerId){
            $query = "DELETE FROM tbl_wishlist WHERE productId = '$proid' AND customerId ='$customerId'";
            $result = $this->db->delete($query);
            return $result;
        }
        public function del_compare($proid, $customerId){
            $query = "DELETE FROM tbl_compare WHERE productId = '$proid' AND customerId ='$customerId'";
            $result = $this->db->delete($query);
            return $result;
        }
        public function getproductbyId($id){
            $query = "SELECT * FROM product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getsliderbyId($id){
            $query = "SELECT * FROM slider WHERE sliderId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        //END BACKEND
        public function getproduct_feathered(){
            $query = "SELECT product.*, category.catName, brand.brandName 
            FROM product INNER JOIN category ON product.catId = category.catId 
            INNER JOIN brand ON product.brandId = brand.brandId
            WHERE type = '0'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getproduct_new(){
            $products_per_page = 4;
            if(!isset($_GET['page'])){
                $page = 1;
            }else{
                $page = $_GET['page'];
            }
            $every_page = ($page-1)*$products_per_page;
            $query = "SELECT product.*, category.catName, brand.brandName 
            FROM product INNER JOIN category ON product.catId = category.catId 
            INNER JOIN brand ON product.brandId = brand.brandId
            order by productId desc LIMIT $every_page,$products_per_page"; //asc or desc
            $result = $this->db->select($query);
            return $result;
        }
        public function get_all_product(){
            $query = "SELECT * FROM product "; //asc or desc
            $result = $this->db->select($query);
            return $result;
        }
        public function get_details($id){
            $query = "SELECT product.*, category.catName, brand.brandName 
            FROM product INNER JOIN category ON product.catId = category.catId 
            INNER JOIN brand ON product.brandId = brand.brandId
            WHERE product.productId = '$id'";

            // $query = "SELECT * FROM product order by productId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestKona(){
            $query = "SELECT * FROM product WHERE brandId ='5' order by productId desc LIMIT 1"; //asc or desc
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestCannondale(){
            $query = "SELECT * FROM product WHERE brandId ='4' order by productId desc LIMIT 1"; //asc or desc
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestSpecialized(){
            $query = "SELECT * FROM product WHERE brandId ='3' order by productId desc LIMIT 1"; //asc or desc
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestTrek(){
            $query = "SELECT * FROM product WHERE brandId ='2' order by productId desc LIMIT 1"; //asc or desc
            $result = $this->db->select($query);
            return $result;
        }
        //
        public function get_compare($customerId){
            $query = "SELECT * FROM tbl_compare WHERE customerId ='$customerId' order by compareId desc"; //asc or desc
            $result = $this->db->select($query);
            return $result;
        }
        public function get_wishlist($customerId){
            $query = "SELECT * FROM tbl_wishlist WHERE customerId ='$customerId' order by wishlistId desc"; //asc or desc
            $result = $this->db->select($query);
            return $result;
        }
        public function insertCompare($productId, $customerId){
    
            $productId = mysqli_real_escape_string($this->db->link, $productId);
            $customerId = mysqli_real_escape_string($this->db->link, $customerId);

            $query = "SELECT * FROM product WHERE productId = '$productId'";
            $result = $this->db->select($query)->fetch_assoc();
            // echo '<pre>';
            // echo print_r($result);
            // echo '</pre>';
            $productName = $result["productName"];
            $price = $result["price"];
            $image = $result["image"];

            $query_compare = "SELECT * FROM tbl_compare WHERE productId = '$productId' AND customerId = '$customerId'";
            $check_compare =  $this->db->select($query_compare); 
            if($check_compare){
                $msg = "<span class='error'>This Product Already Added Compare Before! Please recheck this product in Compare Page!</span>";
                return $msg;
            }else{
            $query_insert = "INSERT INTO tbl_compare(productId,customerId,productName,price,image) VALUES('$productId','$customerId','$productName','$price','$image')";
            $insert_compare = $this->db->insert($query_insert);
            if($insert_compare){
                $alert = "<span class='success'>This Bicycle Product Added Compare Page Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>This Bicycle Product Added Compare Page Not Success</span>";
                return $alert;
            }
          }
        }
        public function insertWishlist($productId, $customerId){
            
            $productId = mysqli_real_escape_string($this->db->link, $productId);
            $customerId = mysqli_real_escape_string($this->db->link, $customerId);

            $query = "SELECT * FROM product WHERE productId = '$productId'";
            $result = $this->db->select($query)->fetch_assoc();
            // echo '<pre>';
            // echo print_r($result);
            // echo '</pre>';
            $productName = $result["productName"];
            $price = $result["price"];
            $image = $result["image"];

            $query_wlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productId' AND customerId = '$customerId'";
            $check_wlist =  $this->db->select($query_wlist); 
            if($check_wlist){
                $msg = "<span class='error'>This Product Already Added Wishlist Before! Please recheck this product in Wishlist Page!</span>";
                return $msg;
            }else{
            $query_insert = "INSERT INTO tbl_wishlist(productId,customerId,productName,price,image) VALUES('$productId','$customerId','$productName','$price','$image')";
            $insert_wlist = $this->db->insert($query_insert);
            if($insert_wlist){
                $alert = "<span class='success'>This Bicycle Product Added Wishlist Page Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>This Bicycle Product Added Wishlist Page Not Success</span>";
                return $alert;
            }
          }
        }
    }
?>