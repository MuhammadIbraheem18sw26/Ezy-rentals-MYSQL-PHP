


<?php

@include 'session_admin.php';

if(!isset($_SESSION['login_admin'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   
   <title>Ezy Rentals</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/navbar.css">

</head>
<body>
<?php
                if(isset($_SESSION['login_admin'])){
            ?> 
            <nav>
            
                <ul >
                    
                <li>
                        <a href="#"><span style="font-size: 30px;">Ezy Rentals</span> </a>
                    </li>
                  
                    
                    <li style="">
                        <a href="#">Welcome &emsp;  <?php echo $_SESSION['login_admin']; ?>&emsp;</a>
                    </li>
                    <li>
                        <a style="" href="add_car.php">Add Car</a>
                    </li>
                    <li>
                        <a style="" href="view.php">View Details</a>
                    </li>
                    <li>
                        <a style="float:right" href="logout.php">Logout</a>
                    </li>

                </ul>
                </nav>
            
            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <nav>
            
                <ul>
                    
                    <li>
                        <a href="#"><span style="font-size: 30px;">Ezy Rentals</span> </a>
                    </li>

                    <li style="float:right">
                        <a href="#">Welcome &emsp;  <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    
                    <li style="float:right">
                        <a href="logout.php">Logout</a>
                    </li>
           
               
            </ul>
            
         
            
            </nav>

            <?php
            }
                else {
            ?>

            <nav>
                <ul>
                    <li>
                        <a href="login_form.php">Login</a>
                    </li>
                     <li>
                           <a href="register_form.php">Register</a>
                </li>
                </ul>
                </nav>
                <?php   }
                ?>  

<div class="container">

   <div class="content">
      <h3>hi, <span>admin</span></h3>
      <h1>welcome <span><?php echo $_SESSION['login_admin'] ?></span></h1>
      <a href="view.php" class="btn">View</a>
      <a href="add_car.php" class="btn">Add Car</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
<footer>
        
            
                <div style="text-align:center">
                    <p>© 2022 Ezy Rentals. All Rights Reserved.</p>
                </div>
            
        
   
</footer>
</html>