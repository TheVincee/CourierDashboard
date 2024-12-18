<?php
	require 'connection.php';
	session_start();






// $query = "DELETE FROM reservation WHERE id = :id";
// $stmt = $pdo->prepare($query);
// $id = 123;
// $stmt->bindParam(':id', $id);
// $stmt->execute();
// $rowCount = $stmt->rowCount();

// <h4 class="text-muted"> <?php echo "Welcome Back: " . $username;



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--FONTAWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="admindash.css">
</head>
    <body>
    <div class="sidebar">
                <div class="logo"></div>
                <ul class="menu">
                <li>
                        <a href="courierpackages.php">
                            <i class="fas fa-user"></i>
                            <span>Courier Packages</span>
                        </a>
                    </li>
                    <li>
                        <a href="courier.php">
                            <i class="fas fa-user"></i>
                            <span>Courier</span>
                        </a>
                    </li>
                    <li>
                        <a href="ridebookings.php">
                            <i class="fas fa-briefcase"></i>
                            <span>Ride Bookings</span>
                        </a>
                    </li>
                    <li class="logout">
                        <a href="../logout.php">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>   
                </ul>
            </div>



            <div class="main--content">
                <div class="header--wrapper">
                    
                </div>
                <div class="card--container">
                <!-- <h3 class="main--title" >Today's Data</h3> -->
                

            <!--RESERVATION-->
            <div class="tabular--wrapper">
                <h3 class="main--title" id="reservation"> Ride Bookings </h3>
                <div class="table-container">
                    <table>
                            <thead>
                                <tr class="table-active">
                                    <th>ID</th>
                                    <th>COURIER ID</th>
                                    <th>PICKUP LOCATION</th>
                                    <th>DESTINATION</th>
                                    <th>PICKUP TIME</th>
                                    <th>PICKUP DATE</th>
                                    <th>TIMESPAN</th>
                                    <th>CREATED AT</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                            <?php 

                                  $query="SELECT * FROM ride_bookings";
                                //   $query="SELECT reservation.id,reservation.fullname,reservation.package,reservation.blocknumber,
                                //   reservation.email,reservation.contact,reservation.plotnumber,
                                //   reservationupdate.statusaccount 
                                //   FROM reservation
                                //   INNER JOIN reservationupdate ON reservation.id = reservationupdate.id";

                                  $statement=$conn->prepare($query);
                                  $statement->execute();
                                  $statement->setFetchMode(PDO::FETCH_ASSOC);
                                  $result = $statement->fetchAll();(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC or FETCH_OBJ  EXAMPLE CODE   <td><?=$row->'id';
                                  if($result)
                                  {
                                        foreach($result as $row )
                                        {
                                            // DISPLAY THE DATA FROM THE DATABASE
                                            ?>
                                            
                                                 <tr>
                                                    <td><?=$row['id'];?> </td>
                                                    <td><?=$row['courier_id'];?> </td>
                                                    <td><?=$row['pickup_location'];?> </td>
                                                    <td><?=$row['destination'];?> </td>
                                                    <td><?=$row['pickup_time'];?></td?>
                                                    <td><?=$row['pickup_date'];?> </td>
                                                    <td><?=$row['timespan'];?> </td>
                                                    <td><?=$row['created_at'];?></td?>
                                                   
                                                  
                                                    
                                                </tr>
                                            <?php
                                        }

                                  }
                                  else{
                                  ?> 
                                    <tr>
                                        <td colspan="7"> No Records Found</td>
                                    </tr>
                                    <?php 
                                  }

                                 ?>
                               
                            </tbody>
                    </table>
                </div>
            </div>

          
        </div>
       
    </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
</html>


