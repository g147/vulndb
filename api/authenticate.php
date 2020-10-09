<?php
include_once 'database.php';
include_once 'user.php';
session_start();
$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if(isset($_POST['signin'])){ 
    $user->username = $_POST['username'];
    $user->password = md5($_POST['password']);
    $stmt = $user->signin();
    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_arr=array(
            "status" => true,
            "message" => "signin successful",
            "id" => $row['id'],
            "username" => $row['username']
        );
        $_SESSION['username'] = $row['username'];
    }
    else{
        $user_arr=array(
            "status" => false,
            "message" => "invalid credentials",
        );
    }
}
if(isset($_POST['signup'])){
    $user->username = $_POST['username'];
    $user->password = md5($_POST['password']);
    $user->created = date('Y-m-d H:i:s');
    if($user->signup()){
        $user_arr=array(
            "status" => true,
            "message" => "signup successful",
            "id" => $user->id,
            "username" => $user->username
        );
    }
    else{
        $user_arr=array(
            "status" => false,
            "message" => "username exists"
        );
    }
} 
if(isset($_POST['signout'])){
    unset($_SESSION);
    session_destroy();
    session_write_close();
    $user_arr['message']="signed out";
}
header("Location: ../index.php?response=".$user_arr['message']); 
?>