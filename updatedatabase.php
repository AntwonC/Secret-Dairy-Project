<?php 
        session_start(); 
        ob_start(); 

        $link =  mysqli_connect("shareddb-p.hosting.stackcp.net", "userss-313135851f", "ux073rj2s3", "userss-313135851f");
            
        if ( mysqli_connect_error() ) {
        die ("There was an error connecting to the database");
        }  

    if ( array_key_exists("content", $_POST) )  {

        // This query updates the database information column by using the ID, this is how you do it. 
        $query = "UPDATE `users` SET `information` = '".mysqli_real_escape_string($link, $_POST['content'])."' WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1"; 
        mysqli_query($link, $query); 

/*        if ( mysqli_query($link, $query) )  {
            echo "success"; 
        }   else    {
            echo " failed";
        } */


      // echo $_POST['content'];
    }


?>