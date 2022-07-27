<?php 

session_start();
// functions for visitor counter
function read_file() {
    return file_get_contents("file.txt");
}

function writefile() {
    $val=read_file() ;
    $val++;
    file_put_contents("file.txt",$val);
    
}

function counter() {
    $counter =file_get_contents("file.txt");
    echo "$counter";
}
writefile();

include 'loginadmin.php';


if($_POST) {
    testLogin($login, $password);
    // log in using hash
    $login = $_POST['username'];
    $password = $_POST['password'];
    $res = testLogin($login, sha1($password)); // SHA1 of the password
        if($res){
            $_SESSION["username"] = $login;  
            $_SESSION['lgd'] = 1;
            header("location: admin.php");
              }
            else {  
            echo "<h3 style='text-align: center;' class='alert alert-danger'>Login failed! Please check your information again</h3>";
        } 
                        
}  
      



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITIRC | Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="icon" type="image/png" href="icon.png">

    <style>
        body {
            background-color: rgb(237, 237, 230);

        }
  
        .form-control:invalid {
            animation: shake 300ms;
        }
        @keyframes shake {
            25% {
                transform: translatex(4px);
            }
            50% {
                transform: translatex(-4px);
            }
            75% {
                transform: translatex(4px);
            }
        }

        .login {
            background: rgb(237, 237, 230);
            background-size: cover;
            padding: 60px 0;

        }

        .login .image-holder {
            display: table-cell;
            width: auto;
            background: url(ensa.jpg);
            background-size: cover
        }

        .login .form-container {
            display: table;
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);

        }
        
        .login form {
            display: table-cell;
            width: 400px;
            background-color: white;
            padding: 40px 60px;
            color: #4e5761;
        }

        @media (max-width:1200px) {
            .login form {
                padding: 40px;
            }
        }

        .login form h1 {
            font-size: 30px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

/* Student Area studentarea Animation */
        .studentarea {
            color: #fff;
            background-color: #0093E9;
            background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);

            font-size: 15px;
            font-weight: 700;
            padding: 10px 15px;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            transition: all 0.3s cubic-bezier(0.02, 0.01, 0.47, 1);
        }

        .studentarea:hover {
            color: #fff;
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            animation: rotate 0.7s ease-in-out both;
        }

        .studentarea:before,
        .studentarea:after {
            content: '';
            background: #02c799;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            opacity: 0;
            transform: translate(100%, -25%) translate3d(0, 0, 0);
            position: absolute;
            right: 0;
            bottom: 0;
            z-index: -1;
            transition: all 0.15s cubic-bezier(0.02, 0.01, 0.47, 1);
        }

        .studentarea:hover:before,
        .studentarea:hover:after {
            opacity: 0.15;
        }

        .studentarea:hover:before {
            transform: translate3d(50%, 0, 0) scale(0.9);
        }

        .studentarea:hover:after {
            transform: translate(50%, 0) scale(1.1);
        }
        
        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(3deg);
            }

            50% {
                transform: rotate(-3deg);
            }

            75% {
                transform: rotate(1deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }
       

        @media only screen and (max-width: 767px) {
            .studentarea {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>


    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav nav-pills">
                <li class="nav-item navbar-center">
                    <a class="nav-link active" href="http://ensao.ump.ma/" target="_blank"><button type="button"
                            class="btn btn-info">ENSAO</button></a>
                </li>
                <li class="nav navbar-nav navbar-right"><a href="student.php"><button type="button"
                            class="studentarea">Student Area</button></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>


    <!-- create  login form -->

    <div class="login">
        <div class="form-container">
            <div class="image-holder"></div>

            <form action="home.php" method="post">
                <h1 class="text-center">Authentification</h1>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username (no MAJ)"
                        required pattern="[a-z]*">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                        required>
                </div>
                <button type="submit" class="btn btn-success btn-block">Login</button>

            </form>

        </div>
    </div>


</body>

</html>