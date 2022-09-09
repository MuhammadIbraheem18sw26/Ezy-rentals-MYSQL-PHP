<?php

@include 'session_customer.php';

if(isset($_POST['submit'])){

  
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $error=array();

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['login_admin'] = $row['name'];
         header('location:admin_page.php');
         exit;

      }elseif($row['user_type'] == 'user'){

         $_SESSION['login_customer'] = $row['name'];
         header('location:user_page.php');
         exit;

      }
     
   }if(mysqli_num_rows($result) > 0){
      $error[]="Account not found";
   header('location:register_form.php');
   }
   else{
      $error[] = 'incorrect email or password!';
      
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Ezy Rentals</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <script>
function validateForm() {
  let email = document.forms["login_form"]["email"].value;
  let password = document.forms["login_form"]["password"].value;
  let errorEmail=document.getElementById("error");
  let errorPassword=document.getElementById("pass_error")
   
  if ( email== "") {
   error.innerHTML="Email cannot be empty";
   email.focus;
   pass_error.innerHTML="";
    return false;
  }
 
  if (password == null || password == "") {
      error.innerHTML="";
      pass_error.innerHTML="Password cannot be empty";
      return false;
   
  }
 
}
   </script>

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" name="login_form" onsubmit="return (validateForm())">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="enter your email">
      <small  id="error"></small>
      <input type="password" name="password"  placeholder="enter your password">
      <small  id="pass_error"></small>
      <input type="submit" name="submit" value="login now" class="form-btn">
      
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>

<footer>
        
            
                <div style="text-align:center">
                    <p>© 2022 Ezy Rentals. All Rights Reserved.</p>
                </div>
            
        
   
</footer>
</html>