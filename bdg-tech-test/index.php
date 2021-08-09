<?php
include 'db_connection.php';
$conn = OpenCon();


//Get all Users
$sqlAllUsers = "SELECT DISTINCT * FROM users ";
$sqlAllUsersResults = mysqli_query($conn, $sqlAllUsers);

// Get user id
$sqlSteveId = "SELECT id FROM users where username = 'Steve'";
$sqlSteveIdResults = mysqli_query($conn, $sqlSteveId);
$userId = mysqli_fetch_row($sqlSteveIdResults)[0];

// Get user id

//get users addresses order by desc limit 5
$sqluserAddresses = "SELECT address_id FROM user_addresses where user_id = '" . $userId . "' ";
$sqluserAddressesResults = mysqli_query($conn, $sqluserAddresses);
$u = mysqli_fetch_assoc($sqluserAddressesResults);

// array to store all users addresses
$addresses = array();
//loop through each address and add it to the list with a limit of 5
while ($row = mysqli_fetch_assoc($sqluserAddressesResults)) {
    $sql = "SELECT * FROM addresses where id = '" . $row["address_id"] . "' ORDER BY created_at DESC limit 5";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_row($result);
    if (count($addresses) < 5) {
        array_push($addresses, $rows);
    } else {
        break;
    }
}

?>

<!DOCTYPE html>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" href="index.css">




<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>



<head>
    <title>User Hub</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="newUserFormHandling.js"></script>

</head>

<link rel="stylesheet" href="index.css">

<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar" style="background-color: #2B7A78">

    <div class="container justify-content-center">
        <h1 id="titleHeader">User Address Entry Hub</h1>

    </div>
</header>

<body>
    <div class="container position-absolute top-5 start-50 translate-middle-x  mt-5" style="width: 75%; ">

        <ul class="nav justify-content-center nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="newUser-tab" data-bs-toggle="tab" data-bs-target="#newUser" type="button" role="pill" aria-controls="newUser" aria-selected="true">Add New User</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="viewUser-tab" data-bs-toggle="tab" data-bs-target="#viewUser" type="button" role="pill" aria-controls="viewUser" aria-selected="false">View All Users</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="steves-tab" data-bs-toggle="tab" data-bs-target="#steves" type="button" role="pill" aria-controls="steves" aria-selected="false">Steve's Addresses</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- form to insert a user  -->
            <div class="tab-pane container fade show active" id="newUser" role="tabpanel" aria-labelledby="newUser-tab">

                <div class="d-flex  justify-content-center pt-5">
                    <div class="card border-secondary">

                        <h5 class="card-header text-center text-white bg-dark"><b>User details:</b></h5>
                        <div class="card-body pb-5" id="success">

                            <form id="newUserform" method="POST">
                                <!-- LINE 1 -->
                                <div class="row">
                                    <div class="col-sm-2 pt-1">
                                        <label style="text-align: center;" for="username"> Username <b style="color: red;">*</b>: </label>
                                    </div>
                                    <div class="col-sm-4 form-group" id="username-group">
                                        <input id="username" type="text" class="form-control" placeholder="Enter your username..." name="username">
                                    </div>

                                    <div class="col-sm-2 pt-3">
                                        <label for="title">Title <b style="color: red;">*</b>:</label>
                                    </div>
                                    <div class="col-sm-4 pt-2 form-group" id="title-group">
                                        <select class="form-control " id="title" name="title">
                                            <option value="">Select your title</option>
                                            <option value="Mr">Mr</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Mrs">Mrs</option>
                                        </select>

                                    </div>
                                </div>
                                <!-- LINE 2 -->

                                <div class="row pt-2">

                                    <div class="col-sm-2 pt-2">
                                        <label style="text-align: center;" for="firstname">First Name <b style="color: red;">*</b>:</label>
                                    </div>
                                    <div class="col-sm-4 form-group" id="firstname-group">
                                        <input id="firstname" name="firstname" class="form-control" placeholder="Enter your first name...">
                                    </div>

                                    <div class="col-sm-2 pt-2">
                                        <label style="text-align: center;" for="surname">Surname <b style="color: red;">*</b>:</label>
                                    </div>
                                    <div class="col-sm-4 form-group" id="surname-group">
                                        <input id="surname" name="surname" class="form-control" placeholder="Enter your surname...">
                                    </div>

                                </div>
                                <!-- LINE 3 -->

                                <div class="row">
                                    <div class="col-sm-2 pt-3">
                                        <label style="text-align: center;" for="line1">Line 1 <b style="color: red;">*</b>:</label>
                                    </div>

                                    <div class="col-sm-4 pt-2 text-left form-group" id="line1-group">
                                        <input id="line1" class="form-control" name="line1">
                                    </div>

                                    <div class="col-sm-2 pt-3">
                                        <label style="text-align: center;" for="line2">Line 2 :</label>
                                    </div>

                                    <div class="col-sm-4 pt-2 text-left form-group" id="line2-group">
                                        <input id="line2" class="form-control" name="line2">
                                    </div>


                                </div>

                                <!-- LINE 4 -->

                                <div class="row">
                                    <div class="col-sm-2 pt-3 pb-1">
                                        <label style="text-align: center;" for="line3">Line 3 :</label>
                                    </div>

                                    <div class="col-sm-4 pt-2 form-group" id="line3-group">
                                        <input id="line3" class="form-control" name="line3">
                                    </div>

                                    <div class="col-sm-2 pt-3 pb-1">
                                        <label style="text-align: center;" for="town">Town <b style="color: red;">*</b>:</label>
                                    </div>

                                    <div class="col-sm-4 pt-2 form-group" id="town-group">
                                        <input id="town" class="form-control" name="town" placeholder="Enter your town name">

                                    </div>
                                </div>

                                <!-- LINE 5 -->

                                <div class="row">
                                    <div class="col-sm-2 pt-3 pb-1">
                                        <label style="text-align: center;" for="pcode">Post code <b style="color: red;">*</b>:</label>
                                    </div>

                                    <div class="col-sm-4 pt-2 form-group" id="postcode-group">
                                        <input id="postcode" class="form-control" name="postcode" placeholder="Enter your post code">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="container text-left pt-4 pl-4 pb-2 pr-4">
                                        <button class="btn btn-dark" type="reset">Reset</button>
                                        <button type="submit" name="submit" class="btn btn-success form-group" style="float: right">Submit</button>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
            <!-- list of users -->
            <div class="tab-pane container fade" id="viewUser" role="tabpanel" aria-labelledby="viewUser-tab">
                <div class="d-flex justify-content-center pb-5">
                    <div class="row">
                        <h4 class="text-center mt-5"><b>List of Users:</b></h4>
                        <table class="styled-table mb-5">
                            <thead>
                                <tr style="text-align: center">
                                    <th rowspan="1">User</th>
                                    <th rowspan="2">User name</th>
                                    <th rowspan="2">Tile</th>
                                    <th rowspan="2">First Name</th>
                                    <th rowspan="2">Surname</th>
                                    <th rowspan="2">Date created</th>
                                    <th rowspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_row($sqlAllUsersResults)) {
                                    echo '<tr>
                                    <th class="text-center">' . $i++ . '</th>
                                    <td>' . $row[1] . '</td>
                                    <td>' . $row[2] . '</td>
                                    <td>' . $row[3] . '</td>
                                    <td>' . $row[4] . '</td>
                                    <td>' . $row[5] . '</td>
                                    <td>
                                        <div style="overflow: auto; text-align: center">
                                            <a class="btn btn-success p-1" href="#">
                                                <img src="https://img.icons8.com/material-rounded/24/ffffff/visible.png" />
                                            </a>

                                            <a class="btn btn-danger p-1" href="#">
                                                <img src="https://img.icons8.com/material-outlined/24/ffffff/trash--v2.png" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- list the last 5 addresses of the user 'Steve' -->
            <div class="tab-pane container fade" id="steves" role="tabpanel" aria-labelledby="steves-tab">
                <h3 class="text-left m-5"><b>Steve's Last 5 addresses:</b></h3>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Line 1</th>
                            <th scope="col">Line 2</th>
                            <th scope="col">Line 3</th>
                            <th scope="col">Town</th>
                            <th scope="col">Postcode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($addresses); $i++) {

                            echo '<tr>
                                <th class="text-center">' . $i + 1 . '</th>
                                <td>' . $addresses[$i][1] . '</td>
                                <td>' . $addresses[$i][2] . '</td>
                                <td>' . $addresses[$i][3] . '</td>
                                <td>' . $addresses[$i][4] . '</td>
                                <td>' . $addresses[$i][5] . '</td>
                                
                            </tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<footer style="background-color: #2B7A78" class="fixed-bottom">

    <div class="row">
        <div class="col-md-12 copy">
            <p class="text-center" style="color: white">&copy; Copyright 2021. All rights reserved.</p>
        </div>
    </div>
</footer>