<?php
  
include 'db.php';

// NECESSARY WHEN VUEJS RUNS IN DEV MODE
if(isset($_GET['session_id'])) {
    $session_id = $_GET['session_id'];
    session_id($session_id);
}

session_start();


// add order to database
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {

    $json=file_get_contents('php://input');
    // {"user_id":"19","totalAmount":"102","status_id":"1","items":[{"id":"1","quantity":"1"},{"id":"2","quantity":"2"}]}
    $data = json_decode($json, true);

    if (isset($data['totalAmount']) && isset($data['status_id']) && isset($data['items'])) {
        // ligação base de dados
        $db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
        if($db) {
            // criar query numa string
            $query  = "INSERT INTO orders SET user_id='" . $_SESSION['user_id'] . "',total='" . $data['totalAmount']  . "',status_id='" . $data['status_id'] . "',created_at=NOW()";

            // executar a query
            if(!($result = @ mysqli_query($db, $query)))
                showerror($db);
                
            // get last order id
            $query = "select * from orders order by id desc limit 1";
            if(!($result = @ mysqli_query($db, $query)))
                showerror($db);
                    
            // insert order items
            $last_order = mysqli_fetch_assoc($result);
            foreach($data['items'] as $item) {
                $query  = "INSERT INTO order_items SET order_id='" . $last_order['id'] . "',product_id='" . $item['id'] . "',quantity='" . $item['quantity'] . "'";
                if(!($result = @ mysqli_query($db, $query)))
                    showerror($db);
            }

            header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
            header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");        
            
            // convert to JSON
            $json=json_encode($last_order);
            echo $json;

            // fechar a ligação à base de dados
            mysqli_close($db);
        }
    }
    else {
    	header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad Request");    
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");
        die('{"Error":"missing one or more properties \'totalAmount\' or \'status_id\' or \'items\' in data object"}');         
    }
}

// get user orders
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // ligação base de dados
    $db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
    if($db) {
            // get user orders
            $query = "select o.*, s.description as status_description from orders as o inner join status as s on o.status_id=s.id where user_id='$user_id' order by created_at desc";
        
        if(!($result = @ mysqli_query($db, $query)))
            showerror($db);
        $nrows  = mysqli_num_rows($result);
        $orders = [];
        for($i=0; $i<$nrows; $i++) {
            $orders[$i] = mysqli_fetch_assoc($result);
            // get order items
            $query = "select product_id, name, price, quantity from order_items inner join products on order_items.product_id=products.id where order_id='" . $orders[$i]['id'] . "' order by quantity desc";
            if(!($result2 = @ mysqli_query($db, $query)))
                showerror($db);
            $nrows2  = mysqli_num_rows($result2);   
	    $items = [];  
            for($j=0; $j<$nrows2; $j++) {
                $items[$j] = mysqli_fetch_assoc($result2);                
            }
            $orders[$i]['items'] = $items;

        }

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");        
        // convert to JSON
        $ordersJSON = json_encode(mb_convert_encoding($orders,'UTF-8'));
        echo $ordersJSON; 

        // fechar a ligação à base de dados
        mysqli_close($db);        
    }   
    
}

// allow cross-origin requests (CORS)
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");	
}




?>
