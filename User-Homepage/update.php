<?php
	require 'connection.php';
	session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> UPDATE </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/addcss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hedvig+Letters+Serif:opsz@12..24&family=Open+Sans:ital@1&display=swap" rel="stylesheet">
</head>
<body>
    <div class="my-background"> 

    </div>
    </div>
       
            <div class="container">
                <form action="./code.php" method="POST">
                    <div class="row mt-2">
                        <center> <h3 class="mt-"> UPDATE </h3></center>
                        <br>
                        <hr class="s-2 text-black mt-4">
                        <input type="hidden" name="student_id" value="<?=$result['id']?>"/>
                        <label for="">Name</label>
                        <div class="col-12 mt-2">
                            <input type="text" class="form-control"  name="name" required>
                        </div>
                        <br>
                        <label for="">Vehicle Type</label>
                        <div class="col-12 mt-2">
                            <input type="text" class="form-control"  name="vehicle_type" required>
                        </div>
                        <br>
                        <label for="">Contact Number</label>
                        <div class="col-12 mt-2">
                            <input type="text" class="form-control"  name="contact_number" required>
                        </div>
                        <br>
                        <label for="">Email</label>
                        <div class="col-12 mt-2">
                            <input type="email" class="form-control"  name="email" required>
                        </div>
                        <br>
                        <label for="">Address</label>
                        <div class="col-12 mt-2">
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <br>
                        <label for="">Availability</label>
                        <div class="col-12 mt-2">
                            <input type="text" class="form-control" name="availability" required>
                        </div>
                        <br>
                        <label for="">Application Status</label>
                        <div class="col-12 mt-2">
                            <input type="text" class="form-control" name="application_status" required>
                        </div>
                        <br>
                        <label for="">Password</label>
                        <div class="col-12 mt-2">
                            <input type="text" class="form-control" name="password" required>
                        </div>
                        <center>
                            <div class="button">
                                    <button type="submit" name="updateperson"  class="btn submit mt-3">Submit</button>
                                  <!-- <a href="admindashboard.php"> class="btn a cancel mt-5 ">Cancel</button> </a>  -->
                                  <a href="./admindashboard/courier.php" class="btn cancel mt-3 ">Cancel</a>
                            </div>
                        </center>
                    </div>
                </form>    
            </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   

    </body>
</html>