<?php 
session_start();
include "connection.php";
if(! $_SESSION['lgd']) {
    header("Location: home.php" ); // verify session Authentification
}


$conn=cnxBD(); // global variable

$query = "SELECT marks.id, marks.mark, students.id_apogee, students.first_name, students.last_name, subjects.name FROM marks INNER JOIN students ON students.id_apogee = marks.idStudent INNER JOIN subjects ON marks.idSubject = subjects.id";

try {
    $statement = $conn->prepare($query);  
    $statement->execute();
    $showmarks = $statement->fetchAll();
} catch (PDOException $e){
    echo ($e ->getMessage());
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welome <?php echo $_SESSION['username'] ?></title>
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
                    <li class="active"><a href="admin.php">Show marks</a></li>
                    <li><a href="addMarks.php">add Marks</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="nav-link active" href="Logout.php"><button type="button" class="btn btn-info">Logout</button></a> </li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!-- show all marks in a bootstrap table -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Show all marks</h1>

                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Num Apogee</th>
                            <th scope="col">Nom & Prenom</th>
                            <th scope="col">Matiere</th>
                            <th scope="col">Note</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($showmarks as $output) {?>
                        <tr>
                            <td><?php echo $output['id'];?></td>
                            <td><?php echo $output['id_apogee'];?></td>
                            <td><?php echo $output['first_name']." ".$output['last_name'];;?></td>
                            <td><?php echo $output['name'];?></td>
                            <td><?php echo $output['mark'];?></td>
                                <?php 
                                                            
                                $msg="delete.php?id=".$output['id'];
                                ?>
                            <td><a onclick="return confirm('Are you sure you want to delete this entry?');" href='<?php echo $msg ?>'><img src='delete.png' width='35px' style=' display: block;margin-left: auto; margin-right: auto;'/></a>
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


</body>

</html>