<?php
include 'z_connect.php';

$data = json_decode(file_get_contents('php://input'), true);

if(isset($data['signUp'])){

    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $gender = $data['gender'];
    $email = $data['email'];
    $phone = $data['phone'];
    $username = $data['username'];
    $password = $data['password'];

    //Check if username exist
    if(true){
        $accCheck = $pdo->prepare("SELECT * FROM accounts WHERE username=:u");
        $accCheck->execute([':u' => $username]);
        if($accCheck->rowCount() > 0){
            echo json_encode(['result' => false, 'message' => 'Username already exist.']);
            exit;
        }
    }


    $newAccSql = "INSERT INTO accounts (username, password, firstname, lastname, gender, email, phone) 
                VALUES (:u, :p, :f, :l, :g, :e, :ph)";
    $newAccStmt = $pdo->prepare($newAccSql);
    if($newAccStmt->execute([
        ':u' => $username,
        ':p' => $password,
        ':f' => $firstname,
        ':l' => $lastname,
        ':g' => $gender,
        ':e' => $email,
        ':ph' => $phone
    ])){
        echo json_encode(['result' => true]);
    }else{
        echo json_encode(['result' => false, 'message' => 'Something went wrong.']);
    }
}

if(isset($data['signIn'])){

    $username = $data['username'];
    $password = $data['password'];

    $accCheck = $pdo->prepare("SELECT * FROM accounts WHERE username=:u AND password=:p");
    $accCheck->execute([':u' => $username, ':p' => $password]);
    if($accCheck->rowCount() > 0){
        $account = $accCheck->fetch(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION['id'] = $account['account_id'];
        $_SESSION['name'] = $account['firstname'] . " " . $account['lastname'];
        $_SESSION['user'] = $account['username'];

        echo json_encode(['result' => true, 'role' => $account['role']]);
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