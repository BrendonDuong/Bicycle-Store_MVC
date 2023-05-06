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
    class cart 
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function add_to_cart($quantity, $id, $customerId){

            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $customerId = mysqli_real_escape_string($this->db->link, $customerId);
            $sessionId = session_id();

            $query = "SELECT * FROM product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            // echo '<pre>';
            // echo print_r($result);
            // echo '</pre>';
            $image = $result["image"];
            $price = $result["price"];
            $productName = $result["productName"];

            $query_cart = "SELECT * FROM cart WHERE productId = '$id' AND sessionId = '$sessionId' AND customerId = '$customerId'";
            $check_cart =  $this->db->select($query_cart); 
            if($check_cart){
                $msg = "<span class='error'>This Product Already Added Cart Before! Please recheck this product in Cart Page!</span>";
                return $msg;
            }else{
            $query_insert = "INSERT INTO cart(productId,customerId,quantity,sessionId,image,price,productName) VALUES('$id','$customerId','$quantity','$sessionId','$image','$price','$productName')";
            $result_cart = $this->db->insert($query_insert);
            if($result_cart){
                echo "<script>window.location.href ='cart.php';</script>";//header('Location:cart.php');
            }else{
                echo "<script>window.location.href ='404.php';</script>";//header('Location:404.php');
            }
           }
        }

        public function get_product_cart(){
            $sessionId = session_id();
            $query = "SELECT * FROM cart WHERE sessionId = '$sessionId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_quantity_cart($quantity, $cartId){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            $query = "UPDATE cart SET 
                quantity = '$quantity' 
                
                WHERE cartId = '$cartId'";
            $result = $this->db->update($query);
            if($result){
                echo "<script>window.location.href ='cart.php';</script>";//header('Location:cart.php');
                $msg = "<span class='success'>Product Quantity Updated Successfully</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Product Quantity Updated Not Success</span>";
                return $msg;
            }
        }
        public function del_product_cart($cartid){
            $cartid = mysqli_real_escape_string($this->db->link, $cartid);
            $query = "DELETE FROM cart WHERE cartId = '$cartid'";
            $result = $this->db->delete($query);
            if($result){
                echo "<script>window.location.href ='cart.php';</script>";//header('Location:cart.php');
                $msg = "<span class='success'>Product Quantity Deleted Successfully</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Product Quantity Deleted Not Success</span>";
                return $msg;
            }
        }
        public function check_cart(){
            $sessionId = session_id();
            $query = "SELECT * FROM cart WHERE sessionId = '$sessionId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function check_order($customerId){
            $sessionId = session_id();
            $query = "SELECT * FROM tbl_order WHERE customerId = '$customerId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function del_all_data_cart(){
            $sessionId = session_id();
            $query = "DELETE FROM cart WHERE sessionId = '$sessionId'";
            $result = $this->db->delete($query);
            return $result;
        }
        public function del_compare($customerId){
            $sessionId = session_id();
            $query = "DELETE FROM tbl_compare WHERE customerId = '$customerId'";
            $result = $this->db->delete($query);
            return $result;
        }
        public function insertOfflineOrder($customerId){
            $sessionId = session_id();
            $offline_payment = "Offline Payment";
            $date = new DateTime();
                $date->modify('+3 day');
                $due_date = $date->format('Y-m-d'); 
            $query = "SELECT * FROM cart, customer WHERE sessionId = '$sessionId' AND customer.customerId = '$customerId'";
            $get_product = $this->db->select($query);
            if($get_product){
                while($result = $get_product->fetch_assoc()){
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price'] * $quantity;
                    $image = $result['image'];
                    $address = $result['address'];
                    
                    $customerId = $customerId;
                    $query_order = "INSERT INTO tbl_order(productId,productName,quantity,price,image,address,date_order,delivery_date,payment_method,customerId) VALUES('$productId','$productName','$quantity','$price','$image','$address','".date('Y-m-d H:i:s')."','$due_date','$offline_payment','$customerId')";
                    $insert_order = $this->db->insert($query_order);
                }
            }
        }
        public function insertOnlineOrder($customerId){
            $sessionId = session_id();
            $online_payment = "Online Payment";
            $date = new DateTime();
                $date->modify('+3 day');
                $due_date = $date->format('Y-m-d'); 
            $query = "SELECT * FROM cart, customer WHERE sessionId = '$sessionId' AND customer.customerId = '$customerId'";
            $get_product = $this->db->select($query);
            if($get_product){
                while($result = $get_product->fetch_assoc()){
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price'] * $quantity;
                    $image = $result['image'];
                    $address = $result['address'];
                    
                    $customerId = $customerId;
                    $query_order = "INSERT INTO tbl_order(productId,productName,quantity,price,image,address,date_order,delivery_date,payment_method,customerId) VALUES('$productId','$productName','$quantity','$price','$image','$address','".date('Y-m-d H:i:s')."','$due_date','$online_payment','$customerId')";
                    $insert_order = $this->db->insert($query_order);
                }
            }
        }
        public function getorderbyId($id){
            $query = "SELECT * FROM tbl_order WHERE orderId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_order($delivery_date, $id){

            // $brandName = $this->fm->validation($brandName);
            $delivery_date = mysqli_real_escape_string ($this->db->link, $delivery_date);
            $id = mysqli_real_escape_string ($this->db->link, $id);

            if(empty($delivery_date)){
                $alert = "<span class='error'>Delivery Date Order must be not empty!</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_order SET delivery_date='$delivery_date' WHERE orderId='$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Delivery Date Order Updated Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Delivery Date Order Updated Not Success</span>";
                    return $alert;
                }
                
            }
        }
        public function revenueStatisticsByMonthYear($year, $date_from, $date_to) {
        
            // Loop through the months of the year to get the corresponding revenue
            // for ($month = 1; $month <= 12; $month++) {
                // Build a query to get revenue by month
                $query = "SELECT COUNT(*) AS total_orders,SUM(quantity) AS total_quantity,date_order,SUM(price) AS revenue FROM tbl_order WHERE date_order BETWEEN '$date_from' AND '$date_to' AND status != '4' GROUP BY date_order";//SELECT SUM(price) as 'revenue' FROM tbl_order WHERE YEAR(date_order) = $year AND MONTH(date_order) = $month
        //quantity,date_order,SUM(price) AS revenue
                // Execute the query and save the result
                // $result = $conn->query($query);
                $result = $this->db->select($query);
                // $revenue = $result->fetch_assoc()['revenue'];
        
                // Initialize an array variable to store statistical data
            $revenue_data = array();
                // Add revenue to the statistical data array
                // $revenue_data[] = array(
                //     "month" => $month,
                //     "revenue" => $revenue
                // );
                while($row=mysqli_fetch_array($result)){
                    $revenue_data[] = array(
                        "date"=>$row["date_order"], 
                        "quantity"=>$row["total_quantity"], 
                        "orders"=>$row["total_orders"], 
                        "revenue"=>$row["revenue"]
                    );
                }
            // }
            // Returns the result as a JSON string to display on a Morris chart
            return json_encode($revenue_data);
        }
        public function revenueStatisticsByDate($year) {
        
            // Loop through the months of the year to get the corresponding revenue
            // for ($month = 1; $month <= 12; $month++) {
                // Build a query to get revenue by month
                $query = "SELECT COUNT(*) AS total_orders,SUM(quantity) AS total_quantity,date_order,SUM(price) AS revenue FROM tbl_order WHERE status != '4' GROUP BY date_order";//SELECT SUM(price) as 'revenue' FROM tbl_order WHERE YEAR(date_order) = $year AND MONTH(date_order) = $month
        //quantity,date_order,SUM(price) AS revenue
                // Execute the query and save the result
                // $result = $conn->query($query);
                $result = $this->db->select($query);
                // $revenue = $result->fetch_assoc()['revenue'];
        
                // Initialize an array variable to store statistical data
            $revenue_data = array();
                // Add revenue to the statistical data array
                // $revenue_data[] = array(
                //     "month" => $month,
                //     "revenue" => $revenue
                // );
                while($row=mysqli_fetch_array($result)){
                    $revenue_data[] = array(
                        "date"=>$row["date_order"], 
                        "quantity"=>$row["total_quantity"], 
                        "orders"=>$row["total_orders"], 
                        "revenue"=>$row["revenue"]
                    );
                }
            // }
            // Returns the result as a JSON string to display on a Morris chart
            return json_encode($revenue_data);
        }
        public function get_total_orders(){
            //Execute the query to get the total number of orders
            $query = "SELECT COUNT(*) AS total_orders FROM tbl_order WHERE status != '4'";
            //Get total order value from query result
            $result = $this->db->select($query);
            $row = mysqli_fetch_assoc($result);
            $get_total_orders = $row['total_orders'];
            //Return the total order value
            return $get_total_orders;
        }
        public function get_total_quantity(){
        
            $query = "SELECT SUM(quantity) AS get_total_quantity FROM tbl_order WHERE status != '4'";
            
            $result = $this->db->select($query);
            $row = mysqli_fetch_assoc($result);
            $get_total_quantity = $row['get_total_quantity'];
            
            return $get_total_quantity;
        }
        public function get_total_revenue(){
            
            $query = "SELECT SUM(price) AS get_total_revenue FROM tbl_order WHERE status != '4'";
            
            $result = $this->db->select($query);
            $row = mysqli_fetch_assoc($result);
            $get_total_revenue = $row['get_total_revenue'];
            
            return $get_total_revenue;
        }
        
        public function getAmountPrice($customerId){
            $query = "SELECT price FROM tbl_order WHERE customerId = '$customerId' ";
            $get_price = $this->db->select($query);
            return $get_price;
        }
        public function get_cart_ordered($customerId){
            $query = "SELECT * FROM tbl_order WHERE customerId = '$customerId' ";
            $get_cart_ordered = $this->db->select($query);
            return $get_cart_ordered;
        }
        public function get_inbox_cart(){
            $query = "SELECT * FROM tbl_order ORDER BY date_order desc";
            $get_inbox_cart = $this->db->select($query);
            return $get_inbox_cart;
        }
        public function shifted($orderId,$time,$price){
            $orderId = mysqli_real_escape_string($this->db->link, $orderId);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "UPDATE tbl_order SET status = '1' WHERE orderId = '$orderId' AND date_order = '$time' AND price = '$price'";
        $result = $this->db->update($query);
        if($result){
            $msg = "<span class='success'>Updated Order Successfully</span>";
            return $msg;
        }else{
            $msg = "<span class='error'>Updated Order Not Success</span>";
            return $msg;
        }
        }
        public function del_shifted($orderId,$time,$price){
            $orderId = mysqli_real_escape_string($this->db->link, $orderId);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "DELETE FROM tbl_order WHERE orderId = '$orderId' AND date_order = '$time' AND price = '$price'";
        $result = $this->db->update($query);
        if($result){
            $msg = "<span class='success'>Delete Order Successfully</span>";
            return $msg;
        }else{
            $msg = "<span class='error'>Delete Order Not Success</span>";
            return $msg;
        }
        }
        public function shifted_confirm($orderId,$time,$price){
            $orderId = mysqli_real_escape_string($this->db->link, $orderId);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "UPDATE tbl_order SET status = '2' WHERE customerId = '$orderId' AND date_order = '$time' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;
        }
        public function cancel_order($orderId,$time,$price){
            $orderId = mysqli_real_escape_string($this->db->link, $orderId);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "UPDATE tbl_order SET status = '3' WHERE customerId = '$orderId' AND date_order = '$time' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;
        }
        public function order_cancel($orderId,$time,$price){
            $orderId = mysqli_real_escape_string($this->db->link, $orderId);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "UPDATE tbl_order SET status = '4' WHERE orderId = '$orderId' AND date_order = '$time' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;
        }
    }
?>