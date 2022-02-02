<?php
$con = new mysqli("localhost","root","","fitness hub");
// Check connection
if ($con->connect_error) {
  die("Failed to connect to MySQL: " .$con->connect_error);
  exit();
}

if(isset ($_POST["password"]) && isset($_POST["username"])){
  $Password=$_POST["password"];
  $Username=$_POST["username"];
  
  $stmt = $con->prepare("SELECT * FROM login WHERE UserName = ?");
  $stmt->bind_param("s", $Username);
  $stmt->execute();
  $stmt_result = $stmt->get_result();
  
  if($stmt_result->num_rows > 0) {
    $data = $stmt_result->fetch_assoc();
    if($data["password"] === $Password) {
      echo'<script>alert ("Login Successfully")</script>';
      $stmts = $con->prepare("SELECT programId FROM userprogram WHERE userId in (SELECT userId from login where UserName=?)");
      $stmts->bind_param("s", $Username);
      $stmts->execute();
      $stmts_result = $stmts->get_result();
      if($stmts_result->num_rows > 0) {
        $data = $stmts_result->fetch_assoc();
          $one=1;
          $two=2;
          $three=3;
        if($data["programId"] ==$one){
          echo '<script>window.location.replace("http://localhost/project/registration/extra.php");</script>;';
          }
        elseif($data["programId"] ==$two){
          echo '<script>window.location.replace("http://localhost/project/regcardio/extracardio.php");</script>;';
        }
        elseif($data["programId"] ==$three){
          echo '<script>window.location.replace("http://localhost/project/regwl/extrawl.php");</script>;';
        }


      }
      }
    else {
      echo '<html>
            <head>
            <meta http-equiv="refresh" content="1;url=#" />
            </head>
            <body>
           <div>';
              echo '<script>alert ("Invalid Email or password")</script>';
              echo '</div></body></html>';
    }
  } else {
  echo '<html>
  <head>
  <meta http-equiv="refresh" content="1;url=#" />
  </head>
  <body>
  <div>';
    echo '<script>alert ("Invalid Email or password")</script>';
    echo '</div></body></html>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
        <style>
    #loginbkg {
    width: 1536px;
    height: 721px;
    background-size: cover;
  } 
  .responsive{
    width:100vh;
    height:100%;
  }
  
  .box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 28rem;
    padding: 2.5rem;
    box-sizing: border-box;
    background: rgba(0, 0, 0, 0.6);
    border-radius: 0.625rem;
  }
  
  .box h2 {
    margin: 0 0 1.875rem;
    padding: 0;
    color: #fff;
    text-align: center;
  }
  
  .box .inputBox {
    position: relative;
  }
  
  .box .inputBox input {
    width: 100%;
    padding: 0.625rem 0;
    font-size: 1rem;
    color: #fff;
    letter-spacing: 0.062rem;
    margin-bottom: 1.875rem;
    border: none;
    border-bottom: 0.065rem solid #fff;
    outline: none;
    background: transparent;
  }
  
  .box .inputBox label {
    position: absolute;
    top: 0;
    left: 0;
    padding: 0.625rem 0;
    font-size: 1rem;
    color: #fff;
    pointer-events: none;
    transition: 0.5s;
  }
  
  .box .inputBox input:focus ~ label,
  .box .inputBox input:valid ~ label,
  .box .inputBox input:not([value=""]) ~ label {
    top: -1.125rem;
    left: 0;
    color: #03a9f4;
    font-size: 0.75rem;
  }
  
  .box input[type="submit"] {
    border: none;
    display: block;
    margin-left: auto;
    margin-right: auto;
    outline: none;
    color: #fff;
    background-color: #03a9f4;
    padding: 0.625rem 1.25rem;
    font-weight: bold;
    cursor: pointer;
    border-radius: 0.312rem;
    font-size: 1rem;
  }
  
  .box input[type="submit"]:hover {
    background-color: #1cb1f5;
  }
  </style>
</head>
<body>
  <div>
    <!-- <?php include('\login.php\index.php')?> -->
    <div class='responsive' ><img  id="loginbkg" src="loginbkg.jpg" alt=""></div>
  <div class="box">
    <h2>Welcome to Fitness Hub</h2>
    <form method="post" action="#">
      <div class="inputBox">
        <input type="text" required onkeyup="this.setAttribute('value', this.value);" value="" name="username">
        <label>Username</label>
      </div>
      <div class="inputBox">
        <input type="password" name="password" required value=""
               onkeyup="this.setAttribute('value', this.value);">
        <label>Password</label>
      </div id="button_clear">
      <input  type="submit" name="sign-in" value="Login">
    </form>
  </div>
</div>

<!-- <script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" 
        crossorigin="anonymous">
    </script> -->

</body>
</html>