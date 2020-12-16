<?php


/*
$query = "SELECT * FROM `Daily_Tips1`   ";
$result=mysqli_query($query) or die('error connecting55'); 
$num_rows = mysqli_num_rows($result);

$row = mysqli_fetch_array($result);
*/

$pass = '$2y$10$TtcoajMu6EGf7glBFWVYmudlSy.g85MHZz7uPbHiNOHGZWCAHHrRi';
//print $pass;



if (password_verify('rafibedika', $pass)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}


$hashToStoreInDb = password_hash("rafibedika", PASSWORD_BCRYPT);

//print $hashToStoreInDb;



?>