<?php

session_start();
if(isset($_SESSION['adgang'])){
    
    $user_check = $_SESSION['adgang'];

    //SQL query Yo Fetch Complete Information Of User

    //Fetch username
    $query = "SELECT user_name FROM login WHERE user_name = '$user_check'";
    $ses_sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($ses_sql);
    $login_session = $row['user_name'];

    //Fetch profil picture / avatar image
    $avatar_query = "SELECT image FROM user_oplysninger WHERE user_name = '$login_session'";
    $avatar_sql = mysqli_query($conn, $avatar_query);
    $avatar_row = mysqli_fetch_assoc($avatar_sql);
    $avatar = $avatar_row['image'];
    

    //Fetch users oplysninger
    $oplysnings_query = "SELECT * FROM user_oplysninger WHERE user_name = '$login_session'";
    $oplysnings_sql = mysqli_query($conn, $oplysnings_query);
    $oplysninger = mysqli_fetch_all($oplysnings_sql, MYSQLI_ASSOC);
    mysqli_free_result($oplysnings_sql);
}
?>