<?php
session_start();

$user_check = $_SESSION['adgang'];

//SQL query Yo Fetch Complete Information Of User

$query = "SELECT user_name FROM login WHERE user_name = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['user_name'];

?>