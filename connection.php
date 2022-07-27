<?php 
function cnxBD()
{
    try {
        $conn = new PDO("mysql:host=localhost; dbname=showmarks","root","",); //create a connection
        // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // check connection
    
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }

      return $conn; // return object for avoiding null function 
     
}


