<!DOCTYPE html>

<html>
<?php 

@include 'session_admin.php';

if(!isset($_SESSION['login_admin'])){
   header('location:login_form.php');
}

 ?> 
<head>


<!-- custom css file link  -->

<link rel="stylesheet" href="./css/navbar.css">
<link rel="stylesheet" href="./css/card1.css">
<link rel="stylesheet" href="./css/style.css">

<title>Ezy Rentals</title>
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
                  
                    <li>
                        <a style="float:right" href="logout.php">Logout</a>
                    </li>
                    <li style="float:right">
                        <a href="#">Welcome &emsp;  <?php echo $_SESSION['login_admin']; ?></a>
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


      
        <form style="text-align:center" role="form" action="#" enctype="multipart/form-data" method="POST">
        <?php

if(isset($_POST['submit']))
{    
     $carName = $_POST['car_name'];
     $carColour = $_POST['car_color'];
     $carPrice = $_POST['price_per_day'];
     $carAvailibility=$_POST['car_availability'];
     $carModel=$_POST['car_model'];
     $sql = "INSERT INTO cars (car_name,car_colour,price_per_day,car_availability,car_model)
     VALUES ('$carName','$carColour','$carPrice','$carAvailibility','$carModel')";
     if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     header("Location: add_car.php");
}
?>
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> 
              Add Cars </h3>

          <div  class= "" style="text-align:center">
          <div class="input-group">
            <input type="text" class="form-control" id="car_name" name="car_name" placeholder="Car Name " required autofocus="">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="car_model" name="car_model" placeholder="Car Model" required>
          </div>  

          <div class="form-group">
            <input type="text" class="form-control" id="car_color" name="car_color" placeholder="Car Colour" required>
          </div>     


          <div class="form-group">
            <input type="text" class="form-control" id="price_per_day" name="price_per_day" placeholder="Fare per day (in AUD)" required>
          </div>
          <div class="form-group">
          <label for="carAvailability">Car Availability</label>
<select name="car_availability" id="drop-down">
  <option value="yes">Yes</option>
  <option value="no">No</option>
</select>
</div>
</div>
</div>
         <button style="color:white;font-size:20px; width:80px; height:40px; font-weight:300; text-align:center;
        padding:5px;
        background-color:green; border-radius:5px; border:1px solid green; color:white ;"  type="submit" id="submit" name="submit"> Add car</button> 
        </form>
     

        <div class style="float: none; margin: 0 auto;">
        <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> My Cars </h3>


<?php
// Storing Session
 
$sql = "SELECT * FROM cars";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  ?>
<div style="overflow-x:auto;">
  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th></th>
        <th> Car Name</th>
        <th> Car Model</th>
        <th> Car Color</th>
        <th> Fare (/day)</th>
        <th> Availability </th>
        <th>Action </th>
        
      </tr>
    </thead>

    <?php
      //OUTPUT DATA OF EACH ROW
      while($row = mysqli_fetch_assoc($result)){
  

if(isset($_POST['car_id'])) {
  $id = $_POST['car_id'];
  $query = "DELETE FROM cars WHERE car_id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  header('location: add_car.php');
}

    ?>

  <tbody>
    <tr>
      <td> <span class=""></span> </td>
      <td><?php echo $row["car_name"]; ?></td>
      <td><?php echo $row["car_model"]; ?></td>
      <td><?php echo $row["car_colour"]; ?></td>
      <td><?php echo $row["price_per_day"]; ?></td>
      <td><?php echo $row["car_availability"]; ?></td>

     <td>
      <form action="add_car.php" method="POST">
        <input type="hidden" name="car_id" value="<?php echo $row['car_id']; ?>">
        <input type="submit" style="color:white;font-size:20px; width:80px; height:40px; font-weight:300; text-align:center;
        padding:5px;
        background-color:red; border-radius:5px; border:1px solid red; color:white ;" name="delete" value="Delete">
      </form>
            </td>
      
    </tr>
  </tbody>
  <?php } ?>
  </table>
  </div>
    <br>
  <?php } else { ?>
  <h4><center>0 Cars available</center> </h4>
  <?php } ?>
        </form>
      
    </div>
</body>
<footer>
        
            
                <div style="text-align:center">
                    <p>© 2022 Ezy Rentals. All Rights Reserved.</p>
                </div>
            
        
   
</footer>

</html>