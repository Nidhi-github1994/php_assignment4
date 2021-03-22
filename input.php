<?php
    require('mysqli_oop_connect.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(empty($_POST['username'])  || empty($_POST['message']) ){
            echo "Please enter the data";
        }

        else{
            $q = 'INSERT INTO messages (username, message) VALUES (?, ?)';
            $stmt = $mysqli->prepare($q);

            $username = $_POST['username'];
            $message = $_POST['message'];

            $stmt->bind_param('ss',$username, $message);   
            $stmt->execute();

            if ($stmt->affected_rows == 0) {
                echo '<p style="font-weight: bold; color: #C00">Your message could not be posted.</p>';
                echo '<p>' . $stmt->error . '</p>';
            }
        
            $stmt->close();
            unset($stmt);

            $mysqli->close();
            unset($mysqli);
        }      
    }
?>