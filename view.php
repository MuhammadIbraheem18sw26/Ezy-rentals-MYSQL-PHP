<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();

if(!isset($_SESSION['login_admin'])){
    header('location:login_form.php');
 }
?>
<head>
<title>Ezy Rentals</title>
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/card1.css">
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
   
<?php $login_client = $_SESSION['login_admin']; 

    $sql1 = "SELECT cars.car_id,rentedcars.customer_username,cars.car_name,cars.car_model ,cars.car_colour , rentedcars.rent_start_date,rentedcars.rent_end_date, rentedcars.fare  FROM cars,rentedcars where cars.car_id=rentedcars.car_id;";

    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
?>

      <div >
        <h1 style="color:green; text-align:center">Booked Car Details </h1>

        <h3 style="color:red; text-align:center">Read only </h3>
      </div>
    

    <div style="padding-left: 100px; padding-right: 100px;" >
<table class="table">
  <thead class="thead-dark">
<tr>
<th >Customer Name</th>    
<th >Car Name</th>
<th >Car Model</th>
<th >Car Colour</th>
<th >From Date</th>
<th >To Date</th>
<th >Total Fare</th>
</tr>
</thead>
<?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
<tr>
<td><?php echo $row["customer_username"] ?></td>
<td><?php echo $row["car_name"]; ?></td>
<td><?php echo $row["car_model"]; ?></td>
<td><?php echo $row["car_colour"]; ?></td>
<td><?php echo $row["rent_start_date"] ?></td>
<td><?php echo $row["rent_end_date"] ?></td>
<td><?php echo $row["fare"] ?></td>

</tr>
<?php        } ?>
                </table>
                </div> 
        <?php } else {
            ?>
       
      <div class="jumbotron">
        <h1>No booked cars</h1>
        <p> Rent some cars now <?php echo $conn->error; ?> </p>
      </div>

            <?php
        } ?>   

</body>
<footer>
        
            
                <div style="text-align:center">
                    <p>© 2022 Ezy Rentals. All Rights Reserved.</p>
                </div>
            
        
   
</footer>
</html>