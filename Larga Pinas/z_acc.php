<?php
include 'z_connect.php';

$data = json_decode(file_get_contents('php://input'), true);

if(isset($data['signIn'])){

    $username = $data['username'];
    $password = $data['password'];

    $accCheck = $pdo->prepare("SELECT * FROM account WHERE username=:u AND password=:p");
    $accCheck->execute([':u' => $username, ':p' => $password]);
    if($accCheck->rowCount() > 0){
        $account = $accCheck->fetch(PDO::FETCH_ASSOC);
        echo json_encode(['result' => true]);
    }else{
        echo json_encode(['result' => false, 'message' => 'User not found.']);
    }

}

if(isset($data['logout'])){

    session_start();
    session_unset();
    session_destroy();

    echo json_encode(true);

}




?>