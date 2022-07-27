<?php 

session_start();
include "connection.php";
if(!$_SESSION['lgd']) {
    header("Location: home.php" ); // verify session Authentification
}

$conn=cnxBD(); // global variable
$query = "SELECT * FROM students";
// select from students table
try {
    $statement = $conn->prepare($query);  
    $statement->execute();
    $result = $statement->fetchAll();
} catch (PDOException $e){
    echo ($e ->getMessage());
}
// select from subjects table
$query1 = "SELECT * FROM subjects";
try {
    $stm = $conn->prepare($query1);  
    $stm->execute();
    $res = $stm->fetchAll();
} catch (PDOException $em){
    echo ($em ->getMessage());
}

if(isset($_POST['submit'])) {
    
    foreach ($res as $key){
        $post_id=@$key['id']; //@ignor error message
    }
    foreach ($result as $output){
        $post_idstudent=@$output['id_apogee'];
    }
    
    $post_mark = @$_POST['mark'];
    $post_idstudent = @$_POST['student'];
    $post_id = @$_POST['subject'];
  // insert notes to  marks table  
try {
$insert= "INSERT INTO marks (idSubject,idStudent,mark) VALUES ($post_id,$post_idstudent,$post_mark)"; // query request for insert data into  marks table
$stm1 = $conn->prepare($insert); 
$mark = $stm1->execute();

if ($mark){
    echo  "<p style='text-align: center;'  class='alert alert-info'>Mark Successfully Added.</p> "; 
  }
    
} 
catch (PDOException $erreur) { echo "<p style='text-align: center;'  class='alert alert-danger'>$erreur->getMessage()</p>"; }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITIRC | Add Marks</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="icon" type="image/png" href="icon.png">

</head>

<body>
    <!-- affichage d'un menu de navigation -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">ITIRC Show Marks</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="admin.php">Show marks</a></li>
                    <li class="active"><a href="addMarks.php">add Marks</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <li><a class="nav-link active" href="Logout.php"><button type="button" class="btn btn-info">Logout</button></a> </li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!-- affichage d'un formulaire de saisie des notes -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form action="addMarks.php" method="post">
                    <div class="form-group">
                        <label for="student">Student</label>
                        <select  name="student" class="form-control" id="student">
                            <option >----- Select Student Name ----</option>
                            <?php foreach ($result as $output) {?>
                            <option value ="<?php echo $output['id_apogee'] ?>" ><?php echo $output['first_name']." ".$output['last_name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select name="subject" class="form-control" id="subject">
                            <option >------- SELECT MATIERE-----</option>
                            <?php foreach ($res as $key) {?>
                            <option value ="<?php echo $key['id'] ?>"><?php echo $key['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mark">Mark</label>
                        <input type="number" min="0" max="20" name="mark" class="form-control" id="mark" placeholder="Put Mark Here" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-info btn-block">Submit</button>
                    
                </form>
            </div>
        </div>
    </div>

</body>

</html>