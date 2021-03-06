<?php
    session_start();
    class Item{
        public $itemName, $itemPrice;
        
        function __construct($item_name, $item_price){
            $this->itemName = $item_name;
            $this->itemPrice = $item_price;
        }
        function get_itemName() {
            return $this->itemName;
        }
        function get_itemPrice() {
            return $this->itemPrice;
        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){      
            
            if (isset($_POST['chocolate'])){                
                $selected_item  = "chocolate";
                $selected_item_price = 1.25;
            }
            if (isset($_POST['pop'])){
                $selected_item  = "pop";
                $selected_item_price = 1.50;
            }
            if (isset($_POST['chips'])){
                $selected_item  = "chips";
                $selected_item_price = 1.75;
            } 
            if(isset($selected_item)){
                if(! isset($_SESSION["item_name"]) || $_SESSION["item_name"] != $selected_item){
                    $item = new Item($selected_item, $selected_item_price);
                    $_SESSION["item_name"] = $item->get_itemName();
                    $_SESSION["item_price"] = $item->get_itemPrice();
                    $_SESSION["remainig_price"] = $_SESSION["item_price"];
                    }    
            }           
       
        if(isset($_SESSION["item_name"])){
            //echo "Selected item is ".$item->get_itemName();
            // $remaining_price = 0;
            $selected_amount = 0;
            if(isset($_POST['1'])){
                $selected_amount = 1.00;
            }
            if(isset($_POST['25'])){
                $selected_amount = 0.25;
            }
            if(isset($_POST['10'])){
                $selected_amount = 0.1;
                
            }
            if(isset($_POST['05'])){
                $selected_amount = 0.05;                
            }
            
            $remaining_price = $_SESSION["remainig_price"] - $selected_amount;
            if(isset($selected_amount) && isset($_SESSION["remainig_price"])){
                //echo $selected_amount."<br>";                
                
                if($remaining_price == 0){
                    echo "<p> Enjoy your ".$_SESSION["item_name"];
                    // unset($_SESSION["item_name"]);
                    // $_SESSION["item_price"]= "";
                    // $_SESSION["remainig_price"] = ""
                    session_destroy();
                    
                }
                else if($remaining_price < 0){
                    echo"get your change of  $".number_format(abs($remaining_price),2);
                    echo "<p> Enjoy your ".$_SESSION["item_name"];
                    session_destroy();
                }
                else{
                    $_SESSION["remainig_price"] = $remaining_price;
                    echo "<p>You have to pay ".$_SESSION["remainig_price"]."</p>";
                }
                    
                
            }
            
        }
    }
?>



<html>
<head>
</head>
 <body>
 <div id="display">
 </div>
 <?php
    if(isset($_SESSION["item_name"])){
        echo "<p>Selected item is ".$_SESSION["item_name"]."</p>";
    }
    else{
        echo"<p>Choose Item</p>";
    }
 ?>
 
 <form action="vending_machine.php" method="POST">
    <!-- <input type="submit" name="chocolate" value="Chocolate $1.25" />
    <input type="submit" name="pop" value="Pop $1.50" /> -->
    <button name="chocolate">Chocolate $1.25</button>
    <button name="pop">Pop $1.50</button>
    <button name="chips">Chips $1.75</button>
    <p>Payment</p>
    
            <button name="1">$1</button>
            <button name="25">$0.25</button>
            <button name="10">$0.10</button>
            <button name="05">$0.05</button>
            
       
    
 </form>
 
 
 </p>
 </body>
 </html>