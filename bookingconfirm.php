<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    header("location: user_page.php");
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

    $customer_username = $_SESSION["login_customer"];
    $car_id = $conn->real_escape_string($_POST['hidden_carid']);
    $rent_start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
    $rent_end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
    $return_status = "NR"; // not returned
    $fare = "NA";


    function dateDiff($start, $end) {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }
    
    $err_date = dateDiff("$rent_start_date", "$rent_end_date");

    $sql0 = "SELECT * FROM cars WHERE car_id = '$car_id'";
    $result0 = $conn->query($sql0);

    if (mysqli_num_rows($result0) > 0) {
        while($row0 = mysqli_fetch_assoc($result0)) {

                $fare = $row0["price_per_day"];
            } 
    }
    if($err_date >= 0) { 
    $sql1 = "INSERT into rentedcars(customer_username,car_id,booking_date,rent_start_date,rent_end_date,fare,return_status) 
    VALUES('" . $customer_username . "','" . $car_id . "','" . date("Y-m-d") ."','" . $rent_start_date ."','" . $rent_end_date . "','" .$err_date*$fare . "','" . $return_status . "')";
    $result1 = $conn->query($sql1);

    $sql2 = "UPDATE cars SET car_availability = 'no' WHERE car_id = '$car_id'";
    $result2 = $conn->query($sql2);

    $sql4 = "SELECT * FROM  cars c, user_form ul, rentedcars rc WHERE c.car_id = '$car_id'  AND rc.customer_username = '$customer_username'";
    $result4 = $conn->query($sql4);


    if (mysqli_num_rows($result4) > 0) {
        while($row = mysqli_fetch_assoc($result4)) {
            $id = $row["id"];
            $car_name = $row["car_name"];
            $car_colour = $row["car_colour"];
            $car_model = $row["car_model"];
            
           
        }
    }

    if (!$result1 | !$result2){
        die("Couldnt enter data: ".$conn->error);
    }

?>



<?php
            
                }
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


    <div>
        <div>
            <h1 style="margin-top:50px;color: green; text-align:center;">Booking Confirmed.</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> Thank you for visiting Ezy Rentals</h2>

 

    <h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


    <div class="card-book">
        <div class="box">
            <div style="float: none; margin: 0 auto; text-align: center;">
                <h2>Booking Details</h2>
                <br>
                <h3 style="color: orange;">Invoice</h3>
                <br>
            </div>
            <div  style="float: none; margin: 0 auto; ">
                <h4> <strong>Vehicle Name: </strong> <?php echo $car_name; ?></h4>
                <br>
                <h4> <strong>Vehicle Model: </strong> <?php echo $car_model; ?></h4>
                <br>
                <h4> <strong>Vehicle Colour:</strong> <?php echo $car_colour; ?></h4>
                <br>
                
                
                     <h4> <strong>Total Fare:</strong> AUD <?php echo $err_date*$fare; ?> (<?php echo $fare; ?>/ day)</h4>
            

                <br> 
                <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Return Date: </strong> <?php echo $rent_end_date; ?></h4>
                <br>
    
                <h4> <strong>Client Name:</strong>  <?php echo $customer_username; ?></h4>
                
            </div>
        </div>
    </div>
</body>

<footer>
        
            
                <div style="text-align:center">
                    <p>© 2022 Ezy Rentals. All Rights Reserved.</p>
                </div>
            
        
   
</footer>

</html>