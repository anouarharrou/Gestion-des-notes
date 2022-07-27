<?php 
session_start();
include 'connection.php'; // connection
$conn=cnxBD(); // get connection with database

 
if($_POST) {
    $apogee = $_POST['apoge'];
    try {
       
    // query request
    $query = "SELECT marks.id, marks.mark, students.id_apogee, students.first_name, students.last_name, subjects.name FROM marks INNER JOIN students ON students.id_apogee = marks.idStudent INNER JOIN subjects ON marks.idSubject = subjects.id WHERE students.id_apogee = $apogee ";
        $statement = $conn->prepare($query);  
        $statement->execute();
        $studentsMarks = $statement->fetchAll();
        
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
    <title>ENSA | Student Area</title>
    <!--Bootstrap CSS Framework-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="icon.png">

    
  
    

</head>

<body>
    <nav class="navbar navbar-default">
        <!-- /.navbar-collapse -->
        <div class="navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="home.php"><button type="button" class="btn btn-info">Go Back</button></a></li>
                
            </ul>

        </div>
    </nav>
    <h1 style="text-align: center;">Enter your Apogee ID to get your marks</h1>
    <!-- form with bootstrap to show marks -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <form action="student.php" method="post">
                    <div class="form-group">
                        <label for="username">Numero Apogée</label>
                        <input type="text" name="apoge" class="form-control" id="apoge" placeholder="Apogee" required>
                    </div>

                    <button type="submit" value="submit" class="btn btn-info btn-block" >Get Marks</button>
                </form>
            </div>
        </div>
    </div>

    <!-- show all marks in a bootstrap table -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Show all marks</h1>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                           <th scope="col">#</th>
                            <th scope="col">Num Apogee</th>
                            <th scope="col">Nom & Prenom</th>
                            <th scope="col">Matiere</th>
                            <th scope="col">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php global $studentsMarks; ?>
                    <?php foreach ( (array) $studentsMarks as $out) {?>
                        <tr>
                            <td><?php echo $out['id'];?></td>
                            <td><?php echo $out['id_apogee'];?></td>
                            <td><?php echo $out['first_name']." ".$out['last_name'];?></td>
                            <td><?php echo $out['name'];?></td>
                            <td><?php echo $out['mark'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                    $moyenne = 0 ;
                    if($_POST) {
                    
                    $somme = 0;
                    $count = 0;
                    foreach ($studentsMarks as $out) {
                        if(!empty($out['mark'])){
                            $somme += $out['mark']; // Ou $somme = $somme + $valeur;
                            $count += 1;
                        }
                    }
                    $moyenne = $somme/$count;
                 }
                    ?>
                <h3 style='text-align: center;' class='alert alert-info'>Votre moyenne :<?php echo $moyenne ?></h3>
            </div>
        </div>
    </div>

</body>

</html>