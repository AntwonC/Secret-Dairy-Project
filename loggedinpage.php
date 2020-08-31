<?php
    session_start(); 
    ob_start(); 


    // 8-20-20; NOTE: Next time you work on this. You will have to fix the bugs. The login/signup button to change in between needs to be fixed. 

    /**if ( array_key_exists("id", $_COOKIE) ) {
        $_SESSION['id'] = $_COOKIE['id'];
    } */
  //  print_r($_COOKIE);
   // echo "<br>";
   // print_r($_SESSION);
   // echo "<br>"; 
   // echo "hello " . $_SESSION['id'] . "<br>"; 
   // echo "hello " . $_COOKIE['id'] . "<br>";

    // Load the text into the textarea
   if ( array_key_exists("id", $_SESSION) ) {

      $link =  mysqli_connect("shareddb-p.hosting.stackcp.net", "userss-313135851f", "ux073rj2s3", "userss-313135851f");
              
      if ( mysqli_connect_error() ) {
      die ("There was an error connecting to the database");
      }


       // This is the query you use to load the information onto the page so you will have the user data from before 
        $load_query = "SELECT information FROM `users` WHERE id = '".mysqli_real_escape_string($link, $_SESSION['id'])."' LIMIT 1";
        $load_query_result = mysqli_query($link, $load_query); 
        $query = mysqli_fetch_array($load_query_result);
        
        $informationContent = $query['information'];

   }

    // DEAD CODE ( DELETE LATER )
  /*   if ( !isset($_SESSION['id']) || !isset($_COOKIE['id']) )  {
      //  header("Location: index.php");
     //   exit(); 
    } */
    // DEAD CODE ( DELETE LATER )

    $id = $_SESSION['id'];

    if ( $_POST['logout_button'] == '1' )   {
        unset($_SESSION['id']);
       // unset($_SESSION['id']);
        unset($_COOKIE['id']); // Unsets the cookie?
       setcookie("id", "",  time() - 3600); // Unsetting the cookie 
        header("Location: index.php");
    }



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
      <!-- This php code will echo the content in the textarea we get from the database --> 
   <textarea id = "user_text" name = "user_text" rows = "35" cols = "268" ><?php echo $informationContent ?> </textarea>
  </div>

</main><!-- /.container -->
      <!-- NOTE: To use AJAX, the jquery must NOT be the slim version --> 
        <script src="jquery-3.5.1.min.js"></script>

      <script type = "text/javascript"> 

          var oldVal = ""; 
       // On does the same thing as bind and on every changed input to the textarea, it will update the database. 
       $("#user_text").on('change keyup paste', function()   {
            var currentVal = $(this).val(); 
            
            if ( currentVal == oldVal ) {
              return; 
            }

            oldVal = currentVal;
            // This is Ajax to store information in the database
            $.ajax({
              method: "POST",
              url: "updatedatabase.php",
              data: { content: $("#user_text").val() }
            })
              .done(function( msg ) {
            //    alert( "Data Saved: " + msg );
          });
           

       });




      </script> 
</html>
