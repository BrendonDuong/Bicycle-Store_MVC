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
    class feedback 
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_feedback($customerId){
            // $productId = $_POST['productId_comment'];
            $customerName = $_POST['customerName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $content = $_POST['content'];
            $customerId = mysqli_real_escape_string($this->db->link, $customerId);
            if($customerName=='' || $email=='' || $phone=='' || $content==''){
                $alert = "<span class='error'>Fields must be not empty!</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_feedback(customerName,email,phone,content,date_update,customerId) VALUES('$customerName','$email','$phone','$content','".date('Y-m-d H:i:s')."','$customerId')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Feedbacks will be moderated by Admin</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Feedbacks Not Success</span>";
                    return $alert;
                }
            }
        }
        public function show_feedback(){
            $query = "SELECT * FROM tbl_feedback order by feedbackId desc";
            $result = $this->db->select($query);
            return $result;
        }
        // public function update_brand($brandName,$id){

        //     $brandName = $this->fm->validation($brandName);
        //     $brandName = mysqli_real_escape_string ($this->db->link, $brandName);
        //     $id = mysqli_real_escape_string ($this->db->link, $id);

        //     if(empty($brandName)){
        //         $alert = "<span class='error'>Brand must be not empty!</span>";
        //         return $alert;
        //     }else{
        //         $query = "UPDATE brand SET brandName='$brandName' WHERE brandId='$id'";
        //         $result = $this->db->update($query);
        //         if($result){
        //             $alert = "<span class='success'>Brand Updated Successfully</span>";
        //             return $alert;
        //         }else{
        //             $alert = "<span class='error'>Brand Updated Not Success</span>";
        //             return $alert;
        //         }
                
        //     }
        // }
        public function del_feedback($id){
            $query = "DELETE FROM tbl_feedback WHERE feedbackId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Feedback Deleted Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Feedback Deleted Not Success</span>";
                return $alert;
            }
        }
        // public function getbrandbyId($id){
        //     $query = "SELECT * FROM brand WHERE brandId = '$id'";
        //     $result = $this->db->select($query);
        //     return $result;
        // }
        // public function get_product_by_brand($id){
        //     $query = "SELECT * FROM product WHERE brandId = '$id' order by brandId desc LIMIT 8";
        //     $result = $this->db->select($query);
        //     return $result;
        // }
        // public function get_name_by_brand($id){
        //     $query = "SELECT product.*, brand.brandName,brand.brandId FROM product,brand WHERE product.brandId = brand.brandId AND product.brandId ='$id' LIMIT 1";
        //     $result = $this->db->select($query);
        //     return $result;
        // }
    }
?>