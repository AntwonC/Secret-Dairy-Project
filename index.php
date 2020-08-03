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

    <div> 
      <p id = "signUp_text">      Interested? Sign up now. </p>  <br>

      <!-- START: signUp form  -->
      <div id = "signUp_container"> 

        <form method = post> 
          <input type = "text" name = "signUp_email" placeholder = "Email" id = "email"> 
          <input type = "text" name = "login_email" placeholder = "Email" id = "login_email"> <br>

          <input type = "password" name = "signUp_password" placeholder = "Password" id = "password">
          <input type = "password" nmame = "login_password" placeholder = "Password" id = "login_password"> 
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