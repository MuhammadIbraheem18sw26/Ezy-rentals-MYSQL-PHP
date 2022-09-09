<!DOCTYPE html>
<html>
<?php 
@include 'session_customer.php';
if(!isset($_SESSION['login_customer'])){
   header('location:login_form.php');
}
?> 

<head>
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/card1.css">
  <title>Ezy Rentals</title>

</head>
<body > 

<?php
                if(isset($_SESSION['login_admin'])){
            ?> 
            <nav>
            
                <ul >
                    
                <li>
                        <a href="#"><span style="font-size: 30px;">Ezy Rentals</span> </a>
                    </li>
                  
                    <li>
                        <a style="float:right">Logout</a>
                    </li>
                    <li style="float:right">
                        <a href="#">Welcome &emsp;  <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <li>
                        <a style="float:right" href="add_car.php">Add Car</a>
                    </li>
                    <li>
                        <a style="float:right" href="view.php">View Details</a>
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


    
<div  style="margin-top:100px" >
    <div style="float: none; margin: 0 auto;">
      <div class="card-book">
        <form style="text-align: center" role="form" action="bookingconfirm.php" method="POST">
        <br style="clear: both">
          <h2 style="margin-bottom: 15px; text-align: center; font-size: 35px;"> Book Your Car </h2><br>

        <?php

        $car_id = $_GET["id"];
        $sql1 = "SELECT * FROM cars WHERE car_id = '$car_id'";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $car_id = $row1["car_id"];
                $car_model= $row1["car_model"];
                $car_name = $row1["car_name"];
                $car_colour = $row1["car_colour"];
                $price_per_day = $row1["price_per_day"];
                
            }
        }

        ?>

        <div class="form-group">
              <h5>Car :&nbsp;  <?php echo($car_name);?></h5>
         </div> 
         
          <div class="form-group">
            <h5>Vehicle Color :&nbsp; <?php echo($car_colour);?></h5>
          </div>
          <div class="form-group">
            <h5>Vehicle Model :&nbsp; <?php echo($car_model);?></h5>
          </div>
        <div class="form-group">
        <?php $today = date("Y-m-d") ?>
          <label><h5>Start Date:</h5></label>
            <input type="date" name="rent_start_date" min="<?php echo($today);?>" required="">
            &nbsp;
          <label><h5>End Date:</h5></label>
          <input type="date" name="rent_end_date" min="<?php echo($today);?>" required="">
         </div>  
         <br>
        <div class="form-group">
                <h5>Fare : <?php echo("AUD ". $price_per_day . " /day");?><h5>    
                </div>
                     
                    

            <br><br>
               

                <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>">
                
         
           <input type="submit"name="submit" value="Book Now" style="width:130px ; height: 40px; color:white; font-size:20px;  background-color: green;
    font-weight: 400;" >     
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