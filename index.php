<?php 
    session_start(); 
    ob_start(); 
    
    if ( isset($_COOKIE['id']) || !isset($_SESSION['id']) || empty($_SESSION['id']) )  {
      header("Location: loggedinpage.php");
    }
    // PROBLEM: It still thinks we are logged in when we go back originally. This is because of the unsetting of the cookie. 
    if ( array_key_exists("submit", $_POST) || array_key_exists("login_submit", $_POST) ) {
      
      $link =  mysqli_connect("shareddb-p.hosting.stackcp.net", "userss-313135851f", "ux073rj2s3", "userss-313135851f");
      
      if ( mysqli_connect_error() ) {
        die ("There was an error connecting to the database");
      } 
      
      



    // START: Sign up verfiication 
      $errors = ""; 
      $success = "";
      $email_signUp = $_POST['signUp_email']; 
      $password_signUp = md5( md5 ( $_POST['signUp_password'] ) . $_POST['signUp_password'] ); 


      if ( $_POST['submit'] == "Sign Up" )  {

          if ( $_POST['signUp_email'] == "" ) {
              $errors .= "Email is required" . "<br>"; 
          }

          if ( $_POST['signUp_password'] == "" )  {
            $errors .= "Password is required" . "<br>";
          }

          // If no errors, continue with validation. 
          if ( $errors == "" )  {
            // Checking if the email already exists. 
            $signUp_query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $email_signUp)."' LIMIT 1";   
            $signUp_result = mysqli_query($link, $signUp_query);
            $rows = mysqli_num_rows($signUp_result); 

            if ( mysqli_num_rows($signUp_result) > 0 )  {

              $errors = "That email address is already taken";

            } else  {

              $add_query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $email_signUp)."', '".mysqli_real_escape_string($link, $password_signUp)."')";
             // echo "This is possible" . "<br>";

             if ( !mysqli_query($link, $add_query) ) {
                $errors = "Could not sign up you up. Try again later." . "<br>";
             }
            // Set session 
           // session_start(); 
             $_SESSION['id'] = mysqli_insert_id($link);

             // If user wants to stay logged in, create cookie. 
             if ( $_POST['stayLoggedIn'] == '1' )  {
              setcookie("id", mysqli_insert_id($link), time() + 60 * 60 * 24 * 365);
             }
             
             $success .= "You are signed up!" . "<br>";

            }
          } 
          
        // END: Sign up verification 
      } else if ( $_POST['login_submit'] == "Login")  {
        // START: Login verification 
          $email_login = $_POST['login_email']; 
          $email_password = md5 ( md5 ( $_POST['login_password'] ) . $_POST['login_password'] );

          if ( $_POST['login_email'] ==  "" ) {
            $errors .= "Email is required." . "<br>"; 
          }

          if ( $_POST['login_password'] == "" ) {
            $errors .= "Password is required." . "<br>";
          }

          // Validating login email here to see if its in the database
          if ( $errors == "" )  {
            $login_query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $email_login)."' LIMIT 1";   
            $login_result = mysqli_query($link, $login_query);
            $login_rows = mysqli_num_rows($login_result); 

            if ( mysqli_num_rows($login_result) > 0 ) {
              // Email already exists in the database which means its valid 
              $database_pass = "SELECT password FROM `users` WHERE email = '".mysqli_real_escape_string($link, $email_login)."' LIMIT 1";
              $db_result = mysqli_query($link, $database_pass); 
              $db_row = mysqli_fetch_array($db_result); 

             // echo $db_row['password'] . "<br>";

            //echo "Email exists" . "<br>";
               if ( $email_password == $db_row['password'] )  {
                 echo "The passwords match." . "<br>";

              //   session_start(); 
                 $_SESSION['id'] = $db_row['id']; 

                  // If user wants to stay logged in, create cookie. 
                    if ( $_POST['stayLoggedIn'] == '1' )  {
                      setcookie("id", $db_row['id'], time() + 60 * 60 * 24 * 365);
                    }

                      header("Location: loggedinpage.php");

                  }  else  {
                      $errors .= "The password is incorrect." . "<br>";
                  }
            } else  {
              $errors .= "Email is not in the database." . "<br>";
            }


          } 
      //  echo "Login attempted" . "<br>";
      }


}

//print_r($_POST);


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel= "stylesheet" href = "styles.css" type = "text/css">
    <title>Secret Dairy</title>
  </head>
  <body>

    <div id = "container"> 
      <h1> Secret Dairy </h1> <br>

      <p id = "both_modes"> Store your thoughts permenantly and securely. </p> 

      <div id = "error"> <?php
                            // echo $errors; 
                             if ( $errors != "" ) {
                               echo $errors; 
                             }  else  {
                               echo $success; 
                             }
                             ?> </div>

    <div> 
      <p id = "signUp_text">      Interested? Sign up now. </p>  <br>

      <!-- START: signUp form  -->
      <div id = "signUp_container"> 

        <form method = post> 
          <input type = "text" name = "signUp_email" placeholder = "Email" id = "email"> 
          <input type = "text" name = "login_email" placeholder = "Email" id = "login_email"> <br>

          <input type = "password" name = "signUp_password" placeholder = "Password" id = "password">
          <input type = "password" name = "login_password" placeholder = "Password" id = "login_password"> 
           <br>
          

          <div id = "checkbox_container">
            <label for = "stayLoggedIn"> Stay Logged In </label> 
            <input type = "checkbox" name = "stayLoggedIn" value = "1" id = "stayLoggedIn">
          </div>

          <br> 

          <input type = "submit" name = "submit" value = "Sign Up" id = "signUp_button">
          <input type = "submit" name = "login_submit" value = "Login" id = "login_button">

        </form> 

      </div>
    <!-- END: SignUp form -->


      <div id = "switch_modes"> 
        Login
      </div>
      


    <!-- Optional JavaScript -->
    <script type = "text/javascript"> 

         // var switch = document.getElementById("switch_modes");

         var mode = 0; // 0 = Sign Up : 1 = Login

          document.getElementById("switch_modes").onclick = function()  {
            myFunction()
          };
          
          // Function to change the page. 
          function myFunction() {

            if ( mode == 0 )  {
              document.getElementById("switch_modes").innerHTML = "     Login"; 
              document.getElementById("signUp_text").innerHTML = "  Log in using your email and password.";
              
              // START: Make the login email and password visible 
              document.getElementById("login_email").style.display = "block";
              document.getElementById("login_email").style.visibility = "visible";

              document.getElementById("login_password").style.display = "block";
              document.getElementById("login_password").style.visibility = "visible";
              // END: Login email and password visible 

              // START: Signup Email and password invisible
              document.getElementById("email").style.display = "none";  
              document.getElementById("email").style.visibility = "hidden"; 

              document.getElementById("password").style.display = "none"; 
              document.getElementById("password").style.visibility = "hidden"; 
              // END: SignUp email and password invisible 
              
              document.getElementById("signUp_button").style.display = "none";
              document.getElementById("signUp_button").style.visibility = "hidden";

              document.getElementById("login_button").style.display = "block";
              document.getElementById("login_button").style.visibility = "visible";


              mode = 1;
            } else  {
              document.getElementById("switch_modes").innerHTML = "Sign Up"; 
              document.getElementById("signUp_text").innerHTML = "Interested? Sign up now.";

              // START: Make the login email and password visible 
              document.getElementById("login_email").style.display = "none";
              document.getElementById("login_email").style.visibility = "hidden";

              document.getElementById("login_password").style.display = "none";
              document.getElementById("login_password").style.visibility = "hidden";
              // END: Login email and password visible 

              // START: Signup Email and password invisible
              document.getElementById("email").style.display = "block";  
              document.getElementById("email").style.visibility = "visible"; 

              document.getElementById("password").style.display = "block"; 
              document.getElementById("password").style.visibility = "visible"; 
              // END: SignUp email and password invisible 

              document.getElementById("signUp_button").style.display = "block";
              document.getElementById("signUp_button").style.visibility = "visible";

              document.getElementById("login_button").style.display = "none";
              document.getElementById("login_button").style.visibility = "hidden";

           //   document.getElementById("signUp_button").value = "Login";

              mode = 0; 
            }
          }


    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>