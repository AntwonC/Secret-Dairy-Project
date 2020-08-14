<?php
    session_start(); 
    ob_start(); 

    /**if ( array_key_exists("id", $_COOKIE) ) {
        $_SESSION['id'] = $_COOKIE['id'];
    } */

    if ( !isset($_SESSION['id']) || empty($_SESSION['id']) )  {
       // header("Location: loggedinpage.php");
     //   exit(); 
    }

    $id = $_SESSION['id'];

    if ( $_POST['logout_button'] == '1' )   {
        setcookie("id", "",  time() - 3600); // Unsetting the cookie 
        header("Location: index.php");
    }
    print_r($_POST); 

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Starter Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">


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
    <link href="starter-template.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Secret Diary</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  
    <form class="form-inline my-2 my-lg-0" method = "post">
      <button class = "btn btn-success" type="submit" id = "logout_button" name = "logout_button" value = "1">Log out</button>
    </form>
  </div>
</nav>

<main role="main" class="container">

  <div class="starter-template">
   <textarea id = "user_text" name = "user_text" rows = "35" cols = "268" ></textarea>
  </div>

</main><!-- /.container -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
