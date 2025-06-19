<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 position-static" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand text-dark" href="index.php">EduAssist Solutions</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link text-dark" href="index.php">Home</a></li>
                        <!-- <li class="nav-item"><a class="nav-link text-dark" href="aboutus.html">About Us</a></li>
                        <li class="nav-item"><a class="nav-link text-dark" href="services.html">What We Offer</a></li> -->
                        <li class="nav-item"><a class="nav-link text-dark" href="login.php">Log-In</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- register-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Register</h2>
                        <hr class="divider" />
                    </div>
                </div>

                <?php
                $message = " ";
                $call = 0;
                $minAge = 18;
                $fname = $lname = $mname = $gender = $bday = $pnum = $email =
                $street = $city = $province = $zip = $country =
                $username ="";
                $password = 0;
                if (isset($_POST['resetForm'])) {
                    $fname = $lname = $mname = $gender = $bday = $pnum = $email =
                    $street = $city = $province = $zip = $country =
                    $username = "";
                }
                else if ($_SERVER["REQUEST_METHOD"]=="POST"){
                    //personal Information
                    $fname = trim($_POST["fname"]);
                    $lname = trim($_POST['lname']);
                    $mname = trim($_POST['mname']);
                    $fullName = ucwords($fname." ".$mname." ".$lname);
                    $gender = $_POST['gender'];
                    $bday = $_POST['bday'];
                    $pnum = $_POST['pnum'];
                    $email = $_POST['email'];

                    //Address Details
                    $street = $_POST['street'];
                    $city = $_POST['city'];
                    $province = $_POST['province'];
                    $zip = $_POST['zip'];
                    $country = $_POST['country'];

                    //Account Details
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $cpassword = $_POST['cpassword'];



                    if (!preg_match("/^[A-Za-z\s]{1,50}$/", $fullName)) {
                        $message = "
                        <div class='row mb-3'>
                            <div class='col-md'>
                                <div class='alert alert-danger'>
                                    Invalid name. Only letters and spaces (maximum of 50 characters) allowed.
                                </div>
                            </div>
                        </div>";
                        $call = 1;
                    }
                    else if (empty($fname) || empty($lname)){
                        $message = "
                        <div class='row mb-3'>
                            <div class='col-md'>
                                <div class='alert alert-danger'>
                                    Do not leave First name or Last name empty!
                                </div>
                            </div>
                        </div>";
                        $call = 2;
                    }
                    else if ($gender == "select"){
                        $message = "
                        <div class='row mb-3'>
                            <div class='col-md'>
                                <div class='alert alert-danger'>
                                    Select a gender!
                                </div>
                            </div>
                        </div>";
                        $call = 3;
                    }
                    else if (!empty($bday)) {
                        $dobDate = new DateTime($bday);
                        $today = new DateTime();
                        $age = $dobDate->diff($today)->y;

                        if ($age < $minAge) {
                            $message = "
                            <div class='row mb-3'>
                                <div class='col-md'>
                                    <div class='alert alert-danger'>
                                        You must be at least 18 years old to register
                                    </div>
                                </div>
                            </div>";
                            $call = 4;
                        }
                    } 
                    else if (empty($bday)) {
                        $message = "
                            <div class='row mb-3'>
                                <div class='col-md'>
                                    <div class='alert alert-danger'>
                                        Date of birth is required
                                    </div>
                                </div>
                            </div>";
                            $call = 5;
                            echo "5";
                    }
                    else if (!preg_match("/^09\d{2}[- ]?\d{3}[- ]?\d{4}$/", $pnum)) {
                        $message = "
                        <div class='row mb-3'>
                            <div class='col-md'>
                                <div class='alert alert-danger'>
                                    Invalid phone number!
                                </div>
                            </div>
                        </div>";
                        $call = 6;
                    }
                    else if (empty($pnum)){
                        $message = "
                        <div class='row mb-3'>
                            <div class='col-md'>
                                <div class='alert alert-danger'>
                                    Please put a phone number!
                                </div>
                            </div>
                        </div>";
                        $call = 7;
                        echo "DEBUG: call = 7<br>";
                    }
                    else if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.(com|net|org/", $email)) {
                        $message = "
                        <div class='row mb-3'>
                            <div class='col-md'>
                                <div class='alert alert-danger'>
                                    Invalid email address!
                                </div>
                            </div>
                        </div>";
                        $call = 8;
                    }
                    
                    else if ($password !== $cpassword) {
                        echo "<script>alert('Password do not match. Please try again.');
                        window.history.back();</script>";
                    }  else {
                        $line = implode("|",[$fname, $lname, $mname, $gender, $bday, $pnum, $email, 
                        $street, $city, $province, $zip, $country,
                        $username, $password, $cpassword]). "\n";
                        file_put_contents("user.txt", $line, FILE_APPEND);

                        echo "<script>
                                alert('Registration Successful! Proceeding to login...');
                                window.location.href = 'login.php';
                            </script>";
                    }

                }   
                ?>


                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <form id="loginForm" method="POST" action="register.php">

                            <div class="row">
                                <div class="col-md">
                                    <h3>Personal Information</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="fname">Name: <label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" name="fname" id="fname" type="text" placeholder="First Name" value="<?php echo htmlspecialchars($fname); ?>">
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" name="lname" id="lname" type="text" placeholder="Last Name" value="<?php echo htmlspecialchars($lname); ?>">
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control" name="mname" id="mname" type="text" placeholder="M.I" value="<?php echo htmlspecialchars($mname); ?>">
                                </div>
                            </div>
                            <?php 
                                if ($call == 1){
                                    echo $message;
                                }
                                else if ($call == 2){
                                    echo $message;
                                }
                            ?>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="gender">Gender: <label>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="select" <?php if ($gender == "select") echo "selected"; ?>>--Select--</option>
                                        <option value="male" <?php if ($gender == "male") echo "selected"; ?>>Male</option>
                                        <option value="female" <?php if ($gender == "female") echo "selected"; ?>>Female</option>
                                        <option value="notToSay" <?php if ($gender == "notToSay") echo "selected"; ?>>Prefer Not To Say</option>
                                    </select>
                                </div>
                            </div>
                            <?php 
                                if ($call == 3){
                                    echo $message;
                                }
                             ?>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="bday">Birthday: <label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="date" id="bday" name="bday" value="<?php echo htmlspecialchars($bday); ?>">
                                </div>
                            </div>
                            <?php 
                                if ($call == 4){
                                    echo $message;
                                }
                                if ($call == 5){
                                    echo $message;
                                }
                             ?>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="pnum">Phone Number: <label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="tel" id="pnum" name="pnum" placeholder="(0992)-123-1234" value="<?php echo htmlspecialchars($pnum); ?>">
                                </div>
                            </div>
                            <?php 
                                if ($call == 6){
                                    echo $message;
                                }
                                else if ($call == 7){
                                    echo $message;
                                }
                             ?>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="email">Email: <label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="email" id="email" name="email" placeholder="example@mail.com" value="<?php echo htmlspecialchars($email); ?>">
                                </div>
                            </div>
                            <?php 
                                if ($call == 8){
                                    echo $message;
                                }else if ($call == 9){
                                    echo $message;
                                }
                             ?>
                            <div class="row">
                                <div class="col-md">
                                    <h3>Address Details</h3>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="street">Street: <label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" name="street" id="street" type="text" placeholder="Street Name" value="<?php echo htmlspecialchars($street); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="city">City: <label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" name="city" id="city" type="text" placeholder="City Name" value="<?php echo htmlspecialchars($city); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="province">Province/ State: <label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" name="province" id="province" type="text" placeholder="province Name" value="<?php echo htmlspecialchars($province); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="zip">Zip Code: <label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" name="zip" id="zip" type="number" placeholder="Zip Code" value="<?php echo htmlspecialchars($zip); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="country">Country: <label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" name="country" id="country" type="text" placeholder="Country Name" value="<?php echo htmlspecialchars($country); ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md">
                                    <h3>Account Details</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="username">Username: <label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" name="username" id="username" type="text" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="password">Password: <label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" name="password" id="password" type="password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="cpassword">Confirm Password: <label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" name="cpassword" id="cpassword" type="password">
                                </div>
                            </div>

                            



                           
                            
                            <button class="btn btn-primary btn-x" id="submitButton" type="submit">Register</button>
                            <button class="btn btn-outline-secondary btn-x" id="resetButton" type="reset" value="Reset" name="resetForm" onclick="window.location='register.php'">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2025 - Precious Lansigan</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
