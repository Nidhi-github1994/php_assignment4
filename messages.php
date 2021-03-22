<?php 
    require('mysqli_oop_connect.php');
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $select = "SELECT * FROM messages";
        $r = $mysqli->query($select); 
        $num = $r->num_rows;
        if ($num > 0) {
            echo "<p>There are currently $num messages.</p>\n";
    
            while ($row = $r->fetch_object()) {
                echo '<p> Username: ' . $row->username." || Message: " .$row->message . '</p>';
            }    
        $r->free(); 
        unset($r);    
    } else {     
        echo '<p class="error">There are currently no messages.</p>';    
        }
    } 
?>