<?php

@include 'session_customer.php';

if(!isset($_SESSION['login_customer'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Ezy Rentals</title>
   <link rel="stylesheet" href="css/navbar.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/card1.css">
</head>
<body>
<?php
    
                 if (isset($_SESSION['login_customer'])){
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

<div class="container" style="margin-top:-150px">
   <div class="content">
      <h3>hi, <span>user</span></h3>
      <h1>welcome <span><?php echo $_SESSION['login_customer'] ?></span></h1>
    
   </div>

</div>
        <h3 style="text-align:center; margin-top: -300px; font-size:30px ">Currently Available Cars</h3>

        
        <div class="container">
<br>
        <div>
            <form method="POST" action="" style="text-align:center">
                <br>
                <input placeholder="search car name" type="text" name="name" style="width:40%;height:50px;" required>
                <button style="height:50px; width:80px; font-size:20px; border-radius:5px;background-color:blue;color:white"
                 type="submit" value="name">Search</button>
                <br>
                </from>  
            <?php   
        if(isset($_POST['name'])){
            $name=$_POST['name'];
            $sql1 = "SELECT * FROM cars WHERE car_availability='yes' AND car_name='$name'";
        }
else{
            $sql1 = "SELECT * FROM cars WHERE car_availability='yes'";
    }
            $result1 = mysqli_query($conn,$sql1);

            if(mysqli_num_rows($result1) > 0) {
                while($row1 = mysqli_fetch_assoc($result1)){
                    $car_id = $row1["car_id"];
                    $car_name = $row1["car_name"];
                    $car_model = $row1["car_model"];
                    $car_colour = $row1["car_colour"];
                    $price_per_day = $row1["price_per_day"];
         
                    ?>
               <div class="card-box">     
            <a class="link-a" href="booking.php?id=<?php echo($car_id) ?>">
            
            <div class="card-a">
                <img src="./assets/car1.png" alt="" height="200px">
            <h3 style="font-size:40px;"> <?php echo $car_name; ?> </h3>
            <h3 style="font-size:30px;">Model : <?php echo $car_model; ?> </h5>
            <h3 style="font-size:25px;">Colour : <?php echo $car_colour; ?> </h5>
            <h3 style="font-size:20px; color: green;"> Price per day : <?php echo ("AUD " . $price_per_day . " /day" ); ?></h6>
             
            </div> 
            </a>
            </div>
            <?php }
            }
            else {
                ?>
         <h1 style="text-align: center;"> No cars available :( </h1>
                <?php
            }
            ?>                                   
    </form>    
    </div>             
    </div>

</body>
<footer>
        
            
                <div style="text-align:center">
                    <p>© 2022 Ezy Rentals. All Rights Reserved.</p>
                </div>
            
        
   
</footer>
</html>