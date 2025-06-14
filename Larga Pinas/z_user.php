<?php
include 'z_connect.php';

$data = json_decode(file_get_contents('php://input'), true);
$current_date = date("Y-m-d");
$current_time = date("H:i");
$current_time = date("H:i", strtotime($current_time . " +6 hours"));


if(isset($data['displayCars'])){

    $getCars = $pdo->prepare("SELECT * FROM cars");
    $getCars->execute();
    $cars = $getCars->fetchAll(PDO::FETCH_ASSOC);

    if($getCars->rowCount() > 0){
        echo json_encode(['result' => true, 'cars' => $cars]);
    }else{
        echo json_encode(['result' => false]);
    }

}

if(isset($data['selectCar'])){

    $car = $data['car'];

    $getCar = $pdo->prepare("SELECT * FROM cars WHERE car_id=:c");
    $getCar->execute([':c' => $car]);
    $car = $getCar->fetch(PDO::FETCH_ASSOC);

    if($getCar->rowCount() > 0){
        echo json_encode(['result' => true, 'car' => $car]);
    }else{
        echo json_encode(['result' => false]);
    }
    
}

if(isset($_POST['addRent'])){

    $car = $_POST['car'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pickupdt = $_POST['pickupdt'];
    $returndt = $_POST['returndt'];

    $driver = $_POST['driver'] === 'true';
    $gas    = $_POST['gas'] === 'true';
    $box    = $_POST['box'] === 'true';
    $seat   = $_POST['seat'] === 'true';

    $total  = $_POST['total'];

    $extras = [];

    if ($gas)  $extras[] = "extra gas";
    if ($box)  $extras[] = "roof box";
    if ($seat) $extras[] = "child seat";

    $extra = count($extras) > 0 ? implode(" - ", $extras) : "No extra";


    $fileTmpPath = $_FILES['proof']['tmp_name'];
    $originalName = $_FILES['proof']['name'];
    $fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);

    $uniqueId = uniqid('', true);
    $newFileName = 'proof_' . date('Ymd_His') . '_' . $uniqueId . '.' . $fileExtension;
    $uploadFolder = 'images/proofs/';

    if (!is_dir($uploadFolder)) {
         mkdir($uploadFolder, 0777, true);
    }

    $destination = $uploadFolder . $newFileName;
    move_uploaded_file($fileTmpPath, $destination);

    $payment = $newFileName;

    $addRent = $pdo->prepare("INSERT INTO rentals (fullname, email, phone, car, pickup, `return`, extras, total, proof, status) 
                            VALUES (:f, :e, :p, :c, :pi, :r, :ex, :t, :pr, 'Request')");
    if($addRent->execute([
        ':f' => $fullname,
        ':e' => $email,
        ':p' => $phone,
        ':c' => $car,
        ':pi' => $pickupdt,
        ':r' => $returndt,
        ':ex' => $extra,
        ':t' => $total,
        ':pr' => $newFileName,
    ])){
        echo json_encode(true);
    }else{
        echo json_encode(false);
    }



}

?>