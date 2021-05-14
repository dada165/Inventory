<?php
session_start();

$currentPage = 'customer.php';

include "navigation.php";
$conn = connect();

$sql = "SELECT * from customers_info";
$res = $conn->query($sql);
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=10">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/product.css">
    <link rel="stylesheet" type="text/css" href="../css/navigation.css">
    <title> Customers </title>
</head>

<body style="background-image: url('../img/bg8.jpg');background-size:100vmax;">
    <div class="row" style="padding: 40px;">
        <div class="leftcolumn">

            <div class="card">
                <div class="table_container">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateInfo">
                        Add Customer
                    </button>
                    <h1 style="text-align: center; color:white;">Customers Table</h1>
                    <div class="table-responsive">
                        <table class="table table-dark" id="table" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                            <thead class="thead-light">
                                <tr>
                                    <th data-field="date" data-filter-control="select" data-sortable="true">Customer</th>
                                    <th data-field="note" data-filter-control="select" data-sortable="true">Type</th>
                                    <th data-field="examen" data-filter-control="select" data-sortable="true">Email</th>
                                    <th data-field="note" data-sortable="true">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        echo '<tr>';
                                        echo '<td style="color:white">' . $row['name'] . '</td>';
                                        echo '<td style="color:white">' . $row['type'] . '</td>';
                                        echo '<td style="color:white">' . $row['email'] . '</td>';
                                        echo "<td><a href='viewCustomer.php?id=" . $row['id'] . "' class='btn btn-success btn-sm'>" .
                                            "<span class='glyphicon glyphicon-eye-open'></span> </a>";
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="updateInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button style="background-color: white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h2 class="modal-title" id="exampleModalScrollableTitle" style="color: white;"><?php echo $thisUser['name']; ?></h2>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="user.php" enctype="multipart/form-data">
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="uname" class="pr-10"> User Name</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input name="uname" type="text" class="login-input" placeholder="User Name" id="uname" value="<?php echo $thisUser['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="email" class="pr-10"> Email </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input name="email" type="email" class="login-input" placeholder="Email Address" value="<?php echo $thisUser['email']; ?>" id="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="uavtr" class="pr-10"> User Avatar</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="pl-20 pull-left">
                                                <input style="color: black;border-radius: 2px;width: 230px;height: 44px;border: none;padding: 15px 20px;margin-bottom: 24px;" name="uavtr" type="file" id="uavtr">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="pass" class="pr-10"> Password</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input name="pass" class="login-input" type="password" id="pass" required>
                                        </div>
                                    </div>
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="npass" class="pr-10">New Password</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input name="npass" class="login-input" type="text" id="npass">
                                        </div>
                                    </div>
                                    <div class="form-group pt-20">
                                        <div class="col-sm-4">
                                            <label for="cpass" class="pr-10">Confirm New Password</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input name="cpass" class="login-input" type="text" id="cpass">
                                        </div>
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <button type="submit" value="submit" name="submit" class="btn btn-success">Change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('side_info.php') ?>
    </div>
</body>

</html>