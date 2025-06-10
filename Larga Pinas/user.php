<?php
    session_start();

    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $name = $_SESSION['name'];
        $user = $_SESSION['user'];
        echo "<input type='hidden' value='$id' id='user_id'>";
        echo "<input type='hidden' value='$name' id='user_name'>";
        echo "<input type='hidden' value='$user' id='user_username'>";
    }else{
        echo "<input type='hidden' value='' id='user_id'>";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Larga Pinas</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

    <!-- Header -->
    <div class="h-12 flex items-center justify-between bg-gray-400 px-2">
        <!-- Logo -->
        <h1 class="md:text-lg text-gray-50 font-bold uppercase tracking-wider">LARGA <span class="text-blue-700">PINAS</span></h1>
        <!-- Pages -->
        <div class="flex md:text-lg font-semibold uppercase cursor-pointer  space-x-2 md:space-x-10 ml-5">
            <p class="w-16 md:w-24 text-center p-1 text-blue-700 hover:text-blue-700 tab">Cars</p>
            <p class="w-16 md:w-24 text-center p-1 hover:text-blue-700 tab">Extras</p>
            <p class="w-16 md:w-24 text-center p-1 hover:text-blue-700 tab">Blog</p>
        </div>
        <!-- Header Profile -->
        <div id="header_profile" class="flex items-center space-x-2 text-xs md:text-sm"></div>
        <!-- Menu  -->
         <div id="menu" class="w-32 flex flex-col justify-center space-y-2 absolute top-12 right-1 bg-gray-300 p-5 rounded shadow cursor-pointer hidden">
            <a href="#" class="hover:underline">Profile</a>
            <a href="#" class="hover:underline">Rents</a>
            <p id="logout" class="hover:underline">Logout</p>
         </div>

    </div>

    <!-- Cars -->
    <div class="page min-h-screen p-3">

        <h1 class="text-lg font-semibold text-center">Browse Available Cars</h1>
        
        <!-- Car Tabs -->
        <div class="flex cursor-pointer border-b border-gray-500 space-x-1 p-1 text-sm sm:text-base">
            <p class="max-w-full w-20 p-1 rounded bg-gray-300 hover:bg-gray-300 text-center car-tab">SEDAN</p>
            <p class="max-w-full w-20 p-1 rounded hover:bg-gray-300 text-center car-tab">SUV</p>
            <p class="max-w-full w-20 p-1 rounded hover:bg-gray-300 text-center car-tab">AUV</p>
            <p class="max-w-full w-20 p-1 rounded hover:bg-gray-300 text-center car-tab">MPV</p>
            <p class="max-w-full w-20 p-1 rounded hover:bg-gray-300 text-center car-tab">VANS</p>
        </div>

        <!-- Sedan -->
        <div class="car-page">
            <div id="sedan_car_list" class="w-full flex flex-wrap justify-around p-5">

            </div>
        </div>

        <!-- SUV -->
        <div class="car-page hidden">
            <div id="suv_car_list" class="w-full flex flex-wrap justify-around p-5">

            </div>
        </div>

        <!-- AUV -->
        <div class="car-page hidden">
            <div id="auv_car_list" class="w-full flex flex-wrap justify-around p-5">

            </div>
        </div>

        <!-- MPV -->
        <div class="car-page hidden">
            <div id="mpv_car_list" class="w-full flex flex-wrap justify-around p-5">

            </div>
        </div>

        <!-- VANS -->
        <div class="car-page hidden">
            <div id="vans_car_list" class="w-full flex flex-wrap justify-around p-5">

            </div>
        </div>

        <!-- Renting Process -->
        <div id="online_renting_modal" class="h-screen overflow-auto absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-5 bg-gray-100 border-2 border-black rounded hidden">

            <h1 class="text-xl font-semibold">Renting Process</h1>

            <div id="selected_car_info" class="my-5 p-5">
                
            </div>

            <hr>

            <h1 class="text-xl font-semibold">Rent Information:</h1>

            <div class="m-5 p-5 flex flex-col space-y-5">

                <div>
                    <h1 class="font-semibold">Pick-up & Drop-off Location</h1>
                    <input id="location" type="text" placeholder="Pick-up & Drop-off Location" class="w-full p-2 rounded">
                </div>
                
                <div>
                    <h1 class="font-semibold">Start Date & Time</h1>
                    <input id="start" type="datetime-local" class="w-full p-2 rounded">
                </div>

                <div>
                    <h1 class="font-semibold">Return Date & Time</h1>
                    <input id="returndt" type="datetime-local" class="w-full p-2 rounded">
                </div>

                <h1 class="font-semibold text-blue-500">Need a Driver?</h1>

                <div class="flex space-x-2 items-center">
                    <input type="checkbox" id="driver" class="w-8 h-8 cursor-pointer">
                    <label for="driver" class="flex items-center font-semibold cursor-pointer"><img src="images/driver.svg" class="w-8">Driver</label>
                    <p class="text-gray-400 text-sm">Make sure to have a driver's license if you choose not to have a driver.</p>
                </div>

            </div>

            <hr>

            <h1 class="text-xl font-semibold">Extras:</h1>

            <div class="flex justify-between m-5 p-5">

                <div class="flex justify-center items-center w-24">
                    <input type="checkbox" id="extra_gas" >
                    <label for="extra_gas" class="cursor-pointer relative px-1 h-28 relative">
                        <img src="images/extras/gas.png" class="object-fit">
                        <p class="font-semibold absolute bottom-5">Extra Gas</p>
                    </label>
                </div>

                <div class="flex justify-center items-center w-24">
                    <input type="checkbox" id="roof_box" >
                    <label for="roof_box" class="cursor-pointer relative px-1 h-28 relative">
                        <img src="images/extras/roof box.png" class="object-fit">
                        <p class="font-semibold absolute bottom-5">Roof Box</p>
                    </label>
                </div>

                <div class="flex justify-center items-center w-24">
                    <input type="checkbox" id="child_seat" >
                    <label for="child_seat" class="cursor-pointer relative px-1 h-28 relative">
                        <img src="images/extras/child sit.png" class="object-fit">
                        <p class="font-semibold absolute bottom-5">Child Seat</p>
                    </label>
                </div>

            </div>

            <hr>

            <h1 class="w-full p-5 text-xl font-semibold">Total Estimated Cost: <span id="estimated_total" class="text-blue-500"></span></h1>

            <hr>

            <h1 class="text-xl font-semibold">Upload Payment Proof:</h1>

            <h1 class="font-semibold p-2 m-2">Online Payments:</h1>

            <div class="flex p-2 m-2 space-x-2">
                <p class="w-20 p-1 text-center cursor-pointer border border-blue-500 rounded hover:border-blue-500 payment_tab">GCash</p>
                <p class="w-20 p-1 text-center cursor-pointer border border-white rounded hover:border-blue-500 payment_tab">Paymaya</p>
            </div>

            <div class="flex justify-center">
                <div class="w-56 h-56 payment_page">
                    <img src="images/gcash.svg">
                </div>  

                <div class="w-56 h-56 payment_page hidden">
                    <img src="images/paymaya.svg">
                </div>
            </div>

            <hr>

            <h1 class="font-semibold p-2 m-2">Choose to proceed:</h1>

            <div class="flex justify-around p-5 m-5">
                <div>
                    <input type="checkbox" id="cash" class="hidden">
                    <label id="cash_label" for="cash" class="p-2 font-semibold cursor-pointer bg-gray-300 rounded border border-gray-100 hover:border-black">Pay on Cash</label>
                </div>
                <div>
                    <input type="file" id="proof" class="hidden">
                    <label id="proof_label" for="proof" class="p-2 font-semibold cursor-pointer bg-gray-300 rounded border border-gray-100 hover:border-black">Upload Payment Proof</label>
                </div>
            </div>

            <!-- Confirm and Cancel Button -->
            <div class="flex justify-end space-x-5">
                <button id="cancel_rent" class="w-24 p-2 text-white font-semibold rounded border border-gray-100 bg-red-500 hover:border-black">Cancel</button>
                <button id="confirm_rent"  class="w-24 p-2 text-white font-semibold rounded border border-gray-100 bg-blue-500 hover:border-black">Confirm</button>
            </div>



        </div>

    </div>

    <!-- Extras -->
    <div class="page min-h-screen p-3 hidden flex flex-col items-center">
        
        <h1 class="text-2xl font-semibold">Available Extras</h1>

        <div class="flex flex-col md:flex-row mt-20 space-x-20 items-center">

            <div class="w-56 h-56 flex flex-col justify-between relative">
                <img src="images/extras/gas.png" class="object-cover">
                <p class="absolute -bottom-10 w-full text-center font-semibold">Extra Gas</p>
            </div>
            <div class="w-56 h-56 flex flex-col justify-between relative">
                <img src="images/extras/roof box.png" class="object-cover">
                <p class="absolute -bottom-10 w-full text-center font-semibold">Roof Box</p>
            </div>
            <div class="w-56 h-56 flex flex-col justify-between relative">
                <img src="images/extras/child sit.png" class="object-cover">
                <p class="absolute -bottom-10 w-full text-center font-semibold">Child Seat</p>
            </div>

        </div>

    </div>

    <!-- Blog -->
    <div class="page min-h-screen p-3 hidden">
        3
    </div>

    

    <!-- Footer -->
     <div class="flex items-center justify-between bg-gray-400 p-1">
        <h3 class="font-semibold">LARGA <span class="text-blue-700">PINAS</span></h3>

        <div class="flex font-semibold space-x-3 cursor-pointer">
            <p class="text-gray-700 hover:underline">FAQ</p>
            <p class="text-gray-700 hover:underline">ABOUT</p>
            <p class="text-gray-700 hover:underline">CONTACTS</p>
        </div>
     </div>

     <script src="js/user.js"></script>
</body>
</html>