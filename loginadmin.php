<?php 

require_once "connection.php";

/*

// First Methode for Loggin 
function login(){
    $conn=cnxBD(); // global variable
   $query = "SELECT * FROM admin WHERE login = :login AND password = :password";  
                   $statement = $conn->prepare($query);  
                   $statement->execute(  
                        array(  
                             'login'     =>     $_POST["username"],  
                             'password'     =>     $_POST["password"]  
                        )  
                   );  
                   $count = $statement->rowCount();  
                   if($count > 0)  
                   {  
                    $login = $_POST['username'];
                    $password = $_POST['password'];
                    $result = testLogin($login, ($password));
                    if($result){$_SESSION["username"] = $_POST["username"];  
                         $_SESSION['lgd'] = 1;
                         header("location:admin.php");  }
                        
                   }  
                   else  
                   {  
                      echo "<h3 style='text-align: center;' class='alert alert-danger'>Login failed! Please check your information again</h3>";
                   }  
   
   }
   
*/
// second Methode for logging if you want to use hash
   function testLogin($login, $password)
   {
     $conn=cnxBD(); // global variable
   
       $query = "SELECT * FROM admin WHERE login = :login AND password = :password";
       $stmt = $conn->prepare($query);
       $stmt->bindParam(':login', $login);
       $stmt->bindParam(':password', $password);
       //show query
       $stmt->execute();
       $result = $stmt->fetchAll();
       return $result;
   }   