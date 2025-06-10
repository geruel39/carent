<?php
include 'z_connect.php';

$data = json_decode(file_get_contents('php://input'), true);
$current_date = date("Y-m-d");
$current_time = date("H:i");
$current_time = date("H:i", strtotime($current_time . " +6 hours"));

if (isset($_POST['addCar'])) {
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $transmission = $_POST['transmission'];
    $fuel = $_POST['fuel'];
    $passenger = $_POST['passenger'];
    $doors = $_POST['doors'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $targetDir = "images/car/";
    $targetPath = $targetDir . basename($imageName);

    
    if (move_uploaded_file($imageTmp, $targetPath)) {
        
        $addCar = $pdo->prepare("INSERT INTO cars (type, brand, model, transmission, fuel, passenger, doors, color, price, quantity, image) 
                                VALUES (:t, :b, :m, :tr, :f, :p, :d, :c, :pr, :q, :i)");

        if ($addCar->execute([
            ':t' => $type,
            ':b' => $brand,
            ':m' => $model,
            ':tr' => $transmission,
            ':f' => $fuel,
            ':p' => $passenger,
            ':d' => $doors,
            ':c' => $color,
            ':pr' => $price,
            ':q' => $quantity,
            ':i' => $imageName,
        ])) {
            echo "Car added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

    } else {
        echo "Failed to upload image.";
    }
}

if(isset($data['insertCars'])){

    $insertCars = $pdo->prepare("SELECT CONCAT(brand, ' ' , model, ' (', type, ')') AS car_name, car_id FROM cars WHERE quantity>0");
    $insertCars->execute();
    $carsResult = $insertCars->fetchAll(PDO::FETCH_ASSOC);

    if($insertCars->rowCount() > 0){
        echo json_encode(['result' => true, 'cars' => $carsResult]);
    }else{
        echo json_encode(['result' => false]);
    }

}

if(isset($data['insertDriver'])){

    $insertDriver = $pdo->prepare("SELECT CONCAT(firstname, ' ', lastname) AS name, driver_id FROM driver WHERE status='Available'");
    $insertDriver->execute();
    $driverResult = $insertDriver->fetchAll(PDO::FETCH_ASSOC);

    if($insertDriver->rowCount() > 0){
        echo json_encode(['result' => true, 'drivers' => $driverResult]);
    }else{
        echo json_encode(['result' => false]);
    }
}

if(isset($data['addRent'])){

    $customer = $data['customer'];
    $car = $data['car'];
    $start = $data['start'];
    $return = $data['returndt'];
    $driver = $data['driver'] === 'Yes' ? 100 : 0;

    $gas = $data['gas'] ? 1000 : 0;
    $box = $data['box'] ? 500 : 0;
    $seat = $data['seat'] ? 300 : 0; 

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

    $startDateTime = new DateTime($start);
    $returnDateTime = new DateTime($return);
    $interval = $startDateTime->diff($returnDateTime);
    $totalHours = ($interval->days * 24) + $interval->h + ($interval->i / 60);
    $totalHours = number_format($totalHours, 2);

    $getCarCost = $pdo->prepare("SELECT price FROM cars WHERE car_id=:c");
    $getCarCost->execute([':c' => $car]);
    $carCost = $getCarCost->fetch(PDO::FETCH_ASSOC);

    $totalCarCost = $carCost['price'] * $totalHours;

    $totalDriverCost = $driver * $totalHours;

    $total = $gas + $box + $seat + $totalCarCost + $totalDriverCost;

    $addRent = $pdo->prepare("INSERT INTO rentals (customer, car, pdlocation, start, `return`, driver, extras, total, status)
                            VALUES (:cu, :c, 'On Site', :s, :r, :d, :e, :t, 'Confirmed')");
    if($addRent->execute([
        ':cu' => $customer,
        ':c' => $car,
        ':s' => $start,
        ':r' => $return,
        ':d' => $driver,
        ':e' => $extra,
        ':t' => $total,
    ])){
        echo json_encode(true);
    }else{
        echo json_encode(false);
    }





}

if(isset($data['displayRentRequest'])){

    $getRequest = $pdo->prepare("SELECT rentals.*, CONCAT(cars.brand, ' ', cars.model) AS carname FROM rentals LEFT JOIN cars ON cars.car_id=rentals.car 
                                WHERE status='Request'");
    $getRequest->execute();
    $request = $getRequest->fetchAll(PDO::FETCH_ASSOC);

    if($getRequest->rowCount() > 0){
        echo json_encode(['result' => true, 'request' => $request]);
    }else{
        echo json_encode(['result' => false]);
    }

}

if(isset($data['updateRequest'])){

    $request = $data['request'];
    $update = $data['update'];

    $doUpdate = $pdo->prepare("UPDATE rentals SET status=:u WHERE rent_id=:r");
    if($doUpdate->execute([':u' => $update, ':r' => $request])){
        echo json_encode(true);
    }else{
        echo json_encode(false);
    }

}

if(isset($data['displayRentals'])){

    $getRentals = $pdo->prepare("SELECT rentals.*, CONCAT(cars.brand, ' ', cars.model) AS carname FROM rentals LEFT JOIN cars ON cars.car_id=rentals.car
                                WHERE `return`>NOW() AND status='Confirmed'");
    $getRentals->execute();
    $rentals = $getRentals->fetchAll(PDO::FETCH_ASSOC);

    if($getRentals->rowCount() > 0){
        echo json_encode(['result' => true, 'rentals' => $rentals]);
    }else{
        echo json_encode(['result' => false]);
    }

}

if(isset($data['displayAccounts'])){

    $getAccounts = $pdo->prepare("SELECT * FROM accounts WHERE role='user'");
    $getAccounts->execute();
    $accounts = $getAccounts->fetchAll(PDO::FETCH_ASSOC);

    if($getAccounts->rowCount() > 0){
        echo json_encode(['result' => true, 'accounts' => $accounts]);
    }else{
        echo json_encode(['result' => false]);
    }

}

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


?>