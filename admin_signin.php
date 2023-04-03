<!doctype html>
<html lang="en">
  <head>
    <title>Signin</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
if(isset($_POST['signin'])) {
  session_start();
  $un = $_POST['email'];
  $ps = $_POST['password'];
  $_SESSION['usr'] = $un;
  $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query(['email' => $un,'password' => $ps ]);
  $res = $mng->executeQuery("sp.approver",$query);
  $stk = current($res->toArray());
  if(!empty($stk))
        {
              header('location: admin_dash.php');
        }
        else
        {
              echo "<script>alert('Invalid Id or Password.');</script> ";
        }

}

   

?>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" action="" method="POST">
  <img class="mb-4" src="img/icon.png" alt="" width="210" height="200">
  <h1 class="h3 mb-3 font-weight-normal">Admin Sign in</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required><br>
  <button class="btn btn-lg btn-primary btn-block" name="signin" type="submit">Sign in</button>

</form>
</body>
</html>
