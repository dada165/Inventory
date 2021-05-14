<?php
session_start();
$_SESSION['user'] = '';
$_SESSION['userid'] = '';
include "../controller/connection.php";
$conn = connect();
$m = '';
if (isset($_POST['submit'])) {
    // $uname= $_POST['uname'];
    // $pass= $_POST['password'];

    // to prevent SQL injection by checking the input
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    // $sql= "SELECT * FROM users_info WHERE u_name='$uname' and password='$pass'";
    // $res= $conn->query($sql);

    // if(mysqli_num_rows($res)==1){
    //     $user= mysqli_fetch_assoc($res);

    // $sql= "SELECT * FROM users_info WHERE u_name='$uname'";
    // $res= mysqli_fetch_assoc($conn->query($sql));

    // // password_verify is used to check the hashed password
    // if($res && password_verify($pass, $res['password'])){
    //     $user= $res;

    // encryption to match with the db password
    $pass = md5($pass);

    $sql = "SELECT * FROM users_info WHERE u_name='$uname' and password='$pass'";

    // SQL imjection
    // if someone insert this into the user name space: '; DROP TABLE users_info;--
    // it will become like this: 
    // $sql= "SELECT * FROM users_info WHERE u_name=''; DROP TABLE users_info;--' and password='$pass'";
    // for that the users_info table will be deleted!!!
    $res = $conn->query($sql);

    if (mysqli_num_rows($res) == 1) {
        $user = mysqli_fetch_assoc($res);
        $id = $user['id'];
        $sq = "UPDATE users_info SET last_login_time=current_timestamp() WHERE id='$id'";
        $conn->query($sq);
        $_SESSION['user'] = $user['name'];
        $_SESSION['userid'] = $user['id'];
        header('Location: ../model/dashboard.php');
    } else {
        $m = 'User name or password is not matched!';
    }
}
?>
<html>

<head>
    <link type="text/css" rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body style="background-image: url('../img/bg2.jpg');background-size:100vmax;">
    <div class="logo">

    </div>
    <form method="POST" enctype="multipart/form-data">
        <div class="box bg-transparent border border-white">
            <div class="content">
                <h2>Log<span> In</span></h2>
                <hr>
                <div class="forms">
                    <p style="color:red; padding:4px;">
                        <?php
                        if ($m != '')
                            echo $m;
                        ?>
                    </p>
                    <div class="user-input">
                        <i class="fas fa-user mt-4" style="color:white"></i>
                        <label for="username" class="text-white">Username</label>
                        <input name="uname" type="text" class="login-input" placeholder="Username" id="name" required />
                    </div>
                    <div class="pass-input">
                    <label for="password" class="text-white">Password</label>
                        <input name="password" type="password" class="login-input" placeholder="Password" id="my-password" required/>
                        <span class="eye" onclick="myFunction()">
                            <i id="hide-1" class="fas fa-eye-slash mt-4" style="color:white"></i>
                            <i id="hide-2" class="fas fa-eye mt-4" style="color:white"></i>
                        </span>
                    </div>
                </div>

                <button class="login-btn" type="submit" name="submit">Sign In</button>
                <p class="new-account text-secondary">Not a user? <a class="text-white" href="registration.php">Sign Up now!</a></p>
                <br>

            </div>
        </div>
    </form>
    <script src="https://kit.fontawesome.com/c0078485ae.js" crossorigin="anonymous"></script>
</body>

</html>

<script>
    function myFunction() {
        var x = document.getElementById("my-password");
        var y = document.getElementById("hide-1");
        var z = document.getElementById("hide-2");

        if (x.type === "password") {
            x.type = "text";
            y.style.display = "block";
            z.style.display = "none";
        } else {
            x.type = "password";
            y.style.display = "none";
            z.style.display = "block";
        }
    }
</script>