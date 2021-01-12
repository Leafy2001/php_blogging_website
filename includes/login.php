<?php ob_start();
session_start();
include "./db.php"; 

if(isset($_POST['Login'])){
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    
    $query = "SELECT * FROM users WHERE (username = '$username') LIMIT 1";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("BAD DATA ".mysqli_error($connection));
    }
    if(mysqli_num_rows($result) == 0){
        die('Incorrect Username');
    }
    $row = mysqli_fetch_assoc($result);

    $firstname = $row['user_firstname'];
    $lastname = $row['user_lastname'];
    $db_username = $row['username'];
    $db_password = $row['user_password'];
    $user_id = $row['user_id'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    if($db_username !== $username || $db_password !== $password){
        header("Location: ../index.php");
        die;
    }

    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $db_username;
    $_SESSION['user_firstname'] = $firstname;
    $_SESSION['user_lastname'] = $lastname;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_image'] = $user_image;
    $_SESSION['user_role'] = $user_role;
    $_SESSION['user_password'] = $db_password;  

    header("Location: ../admin/index.php");
}else{
    header("Location: index.php");
}

?>