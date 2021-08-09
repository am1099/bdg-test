<?php

// handle form submission 

// consider error handling, validation + security 

// db insert

include 'db_connection.php';
$conn = OpenCon();

$errors = array();      // array to hold validation errors
$data = array();      // array to pass back data

// Get all data from  form
$username = $_POST['username'];
$title = $_POST['title'];
$firstname = $_POST['firstname'];
$surname = $_POST['surname'];
$line1 = $_POST['line1'];
$line2 = $_POST['line2'];
$line3 = $_POST['line3'];
$town = $_POST['town'];
$postcode = $_POST['postcode'];
$date = date("Y-m-d H:i:s");


// username validation
$stmt = mysqli_prepare($conn, "SELECT username FROM users WHERE username =  ?");
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$numOfUsers = mysqli_stmt_num_rows($stmt);

// username validation
if (empty($username)) {
    $errors['username'] = 'Username is required.';
}

// Title validation
if (empty($title)) {
    $errors['title'] = 'Title is Required.';
}

// First name validation
if (empty($firstname)) {
    $errors['firstname'] = 'First name is required.';
}

// Surname validation
if (empty($surname)) {
    $errors['surname'] = 'Surname is required.';
}

// line1 validation
if (empty($line1)) {
    $errors['line1'] = 'line1 is required.';
}


// town validation
if (empty($town)) {
    $errors['town'] = 'Please enter what town you are from.';
}


// postcode validation
if (empty($postcode)) {
    $errors['postcode'] = 'Postcode required';
}

// function to get user id and address include

// if there are any errors in our errors array, return a success boolean of false
if (!empty($errors)) {
    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
} else {
    // if there are no errors process our form, then return a 

    // Select user id - check if user already exists
    $sqlUser = "SELECT id FROM users where username = '" . $username . "'";
    $sqlResultUser = mysqli_query($conn, $sqlUser);
    $userId = mysqli_fetch_row($sqlResultUser);

    // check if address already exists
    $sqlAddress = "SELECT id FROM addresses where line1 = '" . $line1 . "' AND line2 = '" . $line2 . "' AND line3 = '" . $line3 . "' AND town = '" . $town . "' AND postcode = '" . $postcode . "' ";
    $sqlResultAddress = mysqli_query($conn, $sqlAddress);
    $addressId = mysqli_fetch_row($sqlResultAddress);

    //  if user id and address id exist, check if user is linked ot address
    if ($userId != null && $addressId != null) {
        // Checking if user with same address exists
        $sqlCheck = "SELECT user_id, address_id FROM user_addresses where user_id = '" . $userId[0] . "' and address_id = '" .  $addressId[0] . "'";
        $sqlResultCheck = mysqli_query($conn, $sqlCheck);
        $existingAddress = mysqli_num_rows($sqlResultCheck);
    } else {
        $existingAddress = 0;
    }

    // if user already exists with the address entered. Display error
    if ($existingAddress != 0) {
        $data['success'] = false;
        $errors['existingAddressUser'] = 'You Have already registered this address with this user, try again!';
        $data['errors']  = $errors;
    } else {
        // if user does not exist, create new user
        if ($userId == null) {
            // Submitting New user record to Users table
        // Using prepared statements to prevent from sql injections
            $stmtNewUser = mysqli_prepare($conn, "INSERT INTO users(username, title, firstname, surname)
        VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmtNewUser, 'ssss', $username, $title, $firstname, $surname);
            $stmtNewUser->execute();
            $stmtNewUser->close();

            // Select new user id 
            $newSqlUser = "SELECT id FROM users where username = '" . $username . "'";
            $newSqlResultUser = mysqli_query($conn, $newSqlUser);
            $newUserId = mysqli_fetch_row($newSqlResultUser)[0];
        } else {
            $newUserId = $userId[0];
        }

        // if address does not exist, create new address
        if ($addressId == null) {
            // Submitting new users addresses to addresses table
            // Using prepared statements to prevent from sql injections
            $stmtUserAddress = mysqli_prepare($conn, "INSERT INTO addresses(line1, line2, line3, town, postcode, created_at)
        VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmtUserAddress, 'sssssd', $line1, $line2, $line3, $town, $postcode, $date);
            $stmtUserAddress->execute();
            $stmtUserAddress->close();

            // Select new address id 
            $newSqlAddress = "SELECT id FROM addresses where line1 = '" . $line1 . "' and line2 = '" . $line2 . "' and line3 = '" . $line3 . "' 
        and town = '" . $town . "' and postcode = '" . $postcode . "'";
            $newSqlResultAddress = mysqli_query($conn, $newSqlAddress);
            $newAddressId = mysqli_fetch_row($newSqlResultAddress)[0];
        } else {
            $newAddressId = $addressId[0];
        }

        // Submitting new users addresses and details id's to user_addresses table
        // Using prepared statements to prevent from sql injections
        $stmtUserAddressesLink = mysqli_prepare($conn, "INSERT INTO user_addresses(user_id, address_id)
         VALUES (?, ?)");
        mysqli_stmt_bind_param($stmtUserAddressesLink, 'ii', $newUserId, $newAddressId);
        $stmtUserAddressesLink->execute();
        $stmtUserAddressesLink->close();
        mysqli_close($conn);

        $data['success'] = true;
        $data['message'] = 'You Have Successfully Submitted A New User Record';
    }
}


echo json_encode($data);
