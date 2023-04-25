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
    class customer 
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_comment($customerId){
            $productId = $_POST['productId_comment'];
            $commentName = $_POST['commenterName'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];
            $rating = $_POST['rating'];
            $customerId = mysqli_real_escape_string($this->db->link, $customerId);
            if($commentName=='' || $email=='' || $comment=='' || $rating==''){
                $alert = "<span class='error'>Fields must be not empty!</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_comment(commentName,email,comment,rating,productId,dated,customerId) VALUES('$commentName','$email','$comment','$rating','$productId','".date('Y-m-d H:i:s')."','$customerId')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Comments will be moderated by Admin</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Comment Not Success</span>";
                    return $alert;
                }
            }
        }
        public function show_comment($id){
            $query = "SELECT * FROM tbl_comment WHERE productId = '$id' order by commentId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function del_comment_in_product($commentid){
            $commentid = mysqli_real_escape_string($this->db->link, $commentid);
            $query = "DELETE FROM tbl_comment WHERE commentId = '$commentid'";
            $result = $this->db->delete($query);
            if($result){
                echo "<script>window.location.href ='details.php';</script>";//header('Location:cart.php');
                $msg = "<span class='success'>Your Comment About Product Deleted Successfully</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Your Comment About Product Deleted Not Success</span>";
                return $msg;
            }
        }
        public function insert_customers($data){
            $customerName = mysqli_real_escape_string ($this->db->link, $data['customerName']);
            $city = mysqli_real_escape_string ($this->db->link, $data['city']);
            $gender = mysqli_real_escape_string ($this->db->link, $data['gender']);
            $zipcode = mysqli_real_escape_string ($this->db->link, $data['zipcode']);
            $email = mysqli_real_escape_string ($this->db->link, $data['email']);
            $address = mysqli_real_escape_string ($this->db->link, $data['address']);
            $country = mysqli_real_escape_string ($this->db->link, $data['country']);
            $phone = mysqli_real_escape_string ($this->db->link, $data['phone']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
            $confirm_password = mysqli_real_escape_string($this->db->link, md5($data['confirm_password']));
            // if($password != 0){
            //     if($password == $confirm_password){
            //         $alert = "<span class='success'>Passwords match</span>";
            //         return $alert;
            //     }else{
            //         $alert = "<span class='error'>Passwords don't match</span>";
            //         return $alert;
            //     }
            if($customerName=="" || $city=="" || $gender=="" || $zipcode=="" || $email=="" || $address=="" || $country=="" || $phone=="" || $password=="" || $confirm_password==""){
                $alert = "<span class='error'>Fields must be not empty!</span>";
                return $alert;
            }else{
                if($password != 0){
                if($password != $confirm_password){
                    $alert = "<span class='error'>Passwords don't match</span>";
                    return $alert;
                    }
                }
                $check_email = "SELECT * FROM customer WHERE email='$email' LIMIT 1";
                $result_check = $this->db->select($check_email);
                if($result_check){
                    $alert = "<span class='error'>Email Already Existed! Please, Enter Another Email</span>";
                return $alert;
                }else{
                $query = "INSERT INTO customer(customerName,city,gender,zipcode,email,address,country,phone,password,confirm_password,date_create) VALUES('$customerName','$city','$gender','$zipcode','$email','$address','$country','$phone','$password','$confirm_password','".date('Y-m-d H:i:s')."')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Customer Created Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Customer Created Not Success</span>";
                    return $alert;
                }
              }
            }
        }
        public function login_customers($data){
            $email = mysqli_real_escape_string ($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
            if($email=="" || $password==""){
                $alert = "<span class='error'>Email and Password must be not empty!</span>";
                return $alert;
            }else{
                $check_login = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
                $result_check = $this->db->select($check_login);
                if($result_check){
                    $value = $result_check->fetch_assoc();
                    Session::set('customer_login',true);
                    Session::set('customer_customerId',$value['customerId']);
                    Session::set('customer_customerName',$value['customerName']);
                    echo "<script>window.location.href ='index.php';</script>";//header('Location:index.php');
                }else{
                    $alert = "<span class='error'>Email or Password are incorrect</span>";
                    return $alert;
                }
            }
        }
        public function confirmAndChangePassword($data, $customerId){
            // $email = mysqli_real_escape_string ($this->db->link, $data['email']);
            $new_password = mysqli_real_escape_string($this->db->link, md5($data['new_password']));
            $confirm_new_password = mysqli_real_escape_string($this->db->link, md5($data['confirm_new_password']));
            if($new_password=="" || $confirm_new_password==""){
                $alert = "<span class='error'>Password and Confirm Password must be not empty!</span>";
                return $alert;
            }else{
                if($new_password != 0){
                    if($new_password != $confirm_new_password){
                        $alert = "<span class='error'>Passwords don't match</span>";
                        return $alert;
                        }
                    }
                $query = "UPDATE customer SET password='$new_password', confirm_password='$confirm_new_password' WHERE customerId='$customerId'";
                $result= $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Your Password Has Been Changed Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Your password Has Not Been Changed Success</span>";
                    return $alert;
                }
            }
        }
        public function del_customer($id){
            $query = "DELETE FROM customer WHERE customerId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Customer Account Deleted Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Customer Account Deleted Not Success</span>";
                return $alert;
            }
        }
        public function show_customers($customerId){
            $query = "SELECT * FROM customer WHERE customerId='$customerId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function show_customers_list(){
            $query = "SELECT * FROM customer order by customerId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_type_customer($id,$type){
            $type = mysqli_real_escape_string ($this->db->link, $type);
            $query = "UPDATE customer SET type = '$type' WHERE customerId='$id'";
             $result = $this->db->update($query);
             return $result;
        }
        
        public function update_customers($data, $customerId){
            $customerName = mysqli_real_escape_string ($this->db->link, $data['customerName']);
            $city = mysqli_real_escape_string ($this->db->link, $data['city']);
            $gender = mysqli_real_escape_string ($this->db->link, $data['gender']);
            $zipcode = mysqli_real_escape_string ($this->db->link, $data['zipcode']);
            $email = mysqli_real_escape_string ($this->db->link, $data['email']);
            $address = mysqli_real_escape_string ($this->db->link, $data['address']);
            $country = mysqli_real_escape_string ($this->db->link, $data['country']);
            $phone = mysqli_real_escape_string ($this->db->link, $data['phone']);
            // $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
            if($customerName=="" || $city=="" || $gender=="" || $zipcode=="" || $email=="" || $address=="" || $country=="" || $phone==""){
                $alert = "<span class='error'>Fields must be not empty!</span>";
                return $alert;
            }else{
                
                $query = "UPDATE customer SET customerName='$customerName',city='$city',gender='$gender',zipcode='$zipcode',email='$email',address='$address',country='$country',phone='$phone' WHERE customerId='$customerId'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Profile Customer Updated Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Profile Customer Updated Not Success</span>";
                    return $alert;
                }
            }
        }
    }
?>