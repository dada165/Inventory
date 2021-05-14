<?php
include '../controller/connection.php';
$conn = connect();
// closeConnect($conn);
// m is the message
$m = '';
// _POST is a built-in global variable of php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    // if there is no email it takes an empty string as input
    $email = $_POST['email'] ? $_POST['email'] : '';
    $pass = $_POST['password'];
    $rPass = $_POST['rpassword'];
    // === checks both value & type of both sides matches or not
    if ($pass === $rPass) {
        // // PASSWORD_DEFAULT is one kind of hashing method, there are several methods like this in hashing
        // $pass= password_hash($pass, PASSWORD_DEFAULT);

        // md5 is one kind of encryption method
        $pass = md5($pass);
        // difference btwn encrytion & hashing: different hashed value can be generated from a password but we can regain it
        // where one password always encrypted into same but regain it is very difficult
        $sq = "INSERT INTO users_info(name, u_name, email, password) VALUES('$name', '$uname', '$email','$pass')";
        if ($conn->query($sq) === true) {
            header('Location: login.php');
        } else {
            $m = 'Connection not established!';
        }
    } else {
        $m = "Passwords don't match!";
    }
}
?>
<html>

<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../css/registration.css">
</head>


<body style="background-image: url('../img/bg2.jpg');background-size:100vmax;">
    <!-- The GET method is used to submit the HTML form data. This data is collected by the predefined $_GET variable for processing. -->
    <!-- The information sent from an HTML form using the GET method is visible to everyone in the browser's address bar, which means that all the variable names and their values will be displayed in the URL. Therefore, the get method is not secured to send sensitive information. -->
    <!-- Similar to the GET method, the POST method is also used to submit the HTML form data. But the data submitted by this method is collected by the predefined superglobal variable $_POST instead of $_GET. -->
    <!-- Unlike the GET method, it does not have a limit on the amount of information to be sent. The information sent from an HTML form using the POST method is not visible to anyone. -->
    <form method="POST" action="registration.php" enctype="multipart/form-data" class="bg-transparent">
        <div class="container reg bg-transparent border border-white mt-5">
            <!-- message -->
            <span>
                <?php
                if ($m != '')
                    echo $m;
                ?>
            </span>
            <h1 style="font-weight: bold;">Registration Form</h1>
            <hr>
            <div>
                <label for="name" style="font-weight:bold;font-size:medium" class="ml-4">Your Name</label>
                <input style="font-size:small;background-color: rgba(65, 65, 65, 0.5);" class="border border-white rounded-pill text-white" name="name" id="name" type="text" placeholder="Enter Your Name" required>
            </div>
            <div>
                <label for="uname" style="font-weight:bold;font-size:medium" class="ml-4">Your Username</label>
                <input style="font-size:small;background-color: rgba(65, 65, 65, 0.5);" class=" border border-white rounded-pill text-white" name="uname" id="uname" type="text" placeholder="Enter Your Username" onchange="checkUsername(this.value); checkUser(this.value);" required>
                <h5 id="checktext" class="ml-4"></h5>
                <h5 id="checkuser" class="ml-4"></h5>
            </div>
            <div>
                <label for="email" style="font-weight:bold;font-size:medium" class="ml-4">Your Email</label>
                <input style="font-size:small;background-color: rgba(65, 65, 65, 0.5);" class="border border-white rounded-pill text-white" name="email" id="email" type="text" placeholder="Enter Your Email" onchange="checkUsermail(this.value);">
                <h5 id="checkmail" class="ml-4"></h5>
            </div>
            <div>
                <label for="password" style="font-weight:bold;font-size:medium" class="ml-4">Password</label>
                <input style="font-size:small;background-color: rgba(65, 65, 65, 0.5);" class="border border-white rounded-pill text-white" name="password" id="password" type="password" placeholder="Enter A Password" onchange="checkUserpass(this.value);" required>
                <h5 id="checkpass" class="ml-4"></h5>
            </div>
            <div>
                <label for="rpassword" style="font-weight:bold;font-size:medium" class="ml-4">Password Confirmation</label>
                <input style="font-size:small;background-color: rgba(65, 65, 65, 0.5);" class="border border-white rounded-pill text-white" name="rpassword" id="rpassword" type="password" placeholder="Repeat the Password" required>
            </div>
            <div style="text-align: center">
                
                <h5 class="mb-2"><span><input type="checkbox"></span> By creating an account you agree to our Terms & Conditions.</h5>
            </div>
            <div style="text-align: center; padding: 20px;">
                <input style="font-size:small;font-weight:bold" type="submit" class="btn btn-success" value="Submit" name="submit">
            </div>
            <div style="text-align: center;">
                <h5>Already have an account?
                    <a href="login.php" class="ml-2">
                        <input style="font-size:small;font-weight:bold" type="button" class="btn btn-primary" value="signin">
                    </a>
                </h5>
            </div>
        </div>
    </form>
</body>
<script type="text/javascript" src="../js/script.js"></script>

</html>

<script>
    window.onload = function() {
        document.getElementsByClassName('reg')[0].style.color = 'whitesmoke';
    };
</script>
<script>
    // using jquery
    $(document).ready(function() {
        $('.reg').css('color', 'whitesmoke');
        // document.getElementsByClassName('reg')[0].style.color='whitesmoke';
    });
    /*window.onload= function(){
          document.getElementsByClassName('reg')[0].style.color='whitesmoke';
    };*/
</script>