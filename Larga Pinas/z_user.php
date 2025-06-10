<?php
include 'z_connect.php';

$data = json_decode(file_get_contents('php://input'), true);
$current_date = date("Y-m-d");
$current_time = date("H:i");
$current_time = date("H:i", strtotime($current_time . " +6 hours"));


if(isset($data['displayCars'])){

    $getCars = $pdo->prepare("SELECT * FROM cars WHERE quantity>0");
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

    $customer = $_POST['customer'];
    $car = $_POST['car'];
    $location = $_POST['location'];
    $start = $_POST['start'];
    $returndt = $_POST['returndt'];

    $driver = $_POST['driver'] === 'true' ? "Yes" : "No" ;
    $gas = $_POST['gas'] === 'true' ? true : false ;
    $box = $_POST['box'] === 'true' ? true : false ;
    $seat = $_POST['seat'] === 'true' ? true : false ;

    $total = $_POST['total'];

    $extra = "";
    if($gas && $box && $seat){
        $extra = "extra gas - roof box - child seat";
    }
    else if ($gas && $box){
        $extra = "extra gas - roof box";
    }
    else if ($gas && $seat){
        $extra = "extra gas - child seat";
    }
    else if ($box && $seat){
        $extra = "roof box - child seat";
    }
    else if ($gas){
        $extra = "extra gas";
    }
    else if ($box){
        $extra = "roof box";
    }
    else if ($seat){
        $extra = "child seat";
    }else{
        $extra = "No extra";
    }


    if ($_POST['cash'] === 'true') {
        $payment = "Cash";
    }else{
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
    }

    $addRent = $pdo->prepare("INSERT INTO rentals (customer, car, pdlocation, start, `return`, driver, extras, total, payment, status) 
                            VALUES (:cu, :c, :pd, :s, :r, :d, :e, :t, :p, 'Request')");
    if($addRent->execute([
        ':cu' => $customer,
        ':c' => $car,
        ':pd' => $location,
        ':s' => $start,
        ':r' => $returndt,
        ':d' => $driver,
        ':e' => $extra,
        ':t' => $total,
        ':p' => $payment,
    ])){
        echo json_encode(true);
    }else{
        echo json_encode(false);
    }



}

?>