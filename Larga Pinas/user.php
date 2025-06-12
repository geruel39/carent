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
    <div class="page min-h-screen p-6 bg-white hidden">
        <div class="flex flex-col justify-center w-full max-w-7xl mx-auto py-6 px-4 h-10 bg-gradient-to-r from-gray-700 to-gray-300 rounded-md">
            <h1 class="text-3xl font-bold text-white">Blog</h1>
        </div>

        <div id="blogGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto mt-10">

            <!-- 1: Driving Tips -->
            <div class="relative rounded-lg overflow-hidden shadow-md cursor-pointer" onclick="showBlogDetail('blogDriving')">
                <img src="images/blog/driving tips.jpg" class="w-full h-48 object-cover" />
                <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 w-full p-3 text-white text-lg font-semibold">
                    Driving Tips in the Philippines
                </div>
            </div>


            <!-- 2 Car Maintenance -->
            <div class="relative rounded-lg overflow-hidden shadow-md cursor-pointer" onclick="showBlogDetail('blogMaintenance')">
                <img src="images/blog/maintenance tips.jpeg" class="w-full h-48 object-cover" />
                <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 w-full p-3 text-white text-lg font-semibold">
                    Car Maintenance Tips
                </div>
            </div>

            <!-- 3 Best time to rent -->
            <div class="relative rounded-lg overflow-hidden shadow-md cursor-pointer" onclick="showBlogDetail('blogRenting')">
                <img src="images/blog/best time to rent a car.jpg" class="w-full h-48 object-cover" />
                <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 w-full p-3 text-white text-lg font-semibold">
                    Best Time to rent a car
                </div>
            </div>

            <!-- 4 Local cuisines -->
            <div class="relative rounded-lg overflow-hidden shadow-md cursor-pointer" onclick="showBlogDetail('blogCuisine')">
                <img src="images/blog/local cuisine.jpg" class="w-full h-48 object-cover" />
                <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 w-full p-3 text-white text-lg font-semibold">
                    Local cuisines to try on your roadtrip
                </div>
            </div>

            <!-- 5 Roadtrip Essentials -->
            <div class="relative rounded-lg overflow-hidden shadow-md cursor-pointer" onclick="showBlogDetail('blogEssentials')">
                <img src="images/blog/car essentials.png" class="w-full h-48 object-cover" />
                <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 w-full p-3 text-white text-lg font-semibold">
                    Roadtrip Essentials
                </div>
            </div>

            <!-- 6: Travel Guide -->
            <div class="relative rounded-lg overflow-hidden shadow-md cursor-pointer" onclick="showBlogDetail('blogTravel')">
                <img src="images/blog/01 tagaytay.jpg" class="w-full h-48 object-cover" />
                <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 w-full p-3 text-white text-lg font-semibold">
                    Travel Guides for popular Destinations
                </div>
            </div>

        </div>

        <!-- Blog Detail View -->

        <!--- Driving Tips --->
        <div id="blogDriving" class="hidden max-w-7xl mx-auto mt-3 p-5 bg-gray-100 rounded-lg">

            <div class="flex items-center bg-gray-200 border border-b-0 border-blue-500 rounded-t-xl px-4 py-2">
                <h2 class="text-4xl font-bold uppercase tracking-wider text-gray-800">Driving Tips in the Philippines</h2>
            </div>

            <div class="bg-white p-6 border-2 border-blue-500 rounded-b-xl shadow-md">
                <ol class="list-decimal list-inside text-gray-800 space-y-4">
                    <li>
                        <strong class="text-blue-600">Stay Alert for Traffic and Road Conditions:</strong>
                        Traffic can be unpredictable, especially in urban areas like Metro Manila. Keep an eye out for motorcycles weaving through lanes, pedestrians crossing unexpectedly, and sudden stops by public transport vehicles.
                    </li>
                    <li>
                        <strong class="text-blue-600">Be Prepared for Jeepneys and Tricycles:</strong>
                        Jeepneys and tricycles are common modes of public transport and can stop without warning. Drive cautiously and maintain a safe distance.
                    </li>
                    <li>
                        <strong class="text-blue-600">Know the Road Rules and Signs:</strong>
                        Understand U-turn rules, speed limits, and pedestrian crossing laws to avoid violations.
                    </li>
                    <li>
                        <strong class="text-blue-600">Use Defensive Driving Techniques:</strong>
                        Keep a safe distance, anticipate other drivers’ actions, and avoid aggressive maneuvers.
                    </li>
                    <li>
                        <strong class="text-blue-600">Prepare for Weather Conditions:</strong>
                        During rainy season, ensure wipers/lights work and drive slower to avoid hydroplaning.
                    </li>
                    <li>
                        <strong class="text-blue-600">Respect Pedestrians and Cyclists:</strong>
                        Be aware of pedestrians and cyclists sharing the road, and yield to them when necessary.
                    </li>
                    <li>
                        <strong class="text-blue-600">Avoid Driving During Peak Hours:</strong>
                        Try to avoid driving during peak hours (7-9 am and 4-7 pm) to minimize traffic congestion and reduce stress.
                    </li>
                    <li>
                        <strong class="text-blue-600">Keep Your Vehicle in Good Condition:</strong>
                        Regularly check your vehicle's tire pressure, oil, and brakes to ensure it's in good working condition.
                    </li>
                    <li>
                        <strong class="text-blue-600">Be Aware of Road Construction:</strong>
                        Check for road construction and plan your route accordingly to avoid delays and detours.
                    </li>
                    <li>
                        <strong class="text-blue-600">Use Your Signals:</strong>
                        Always use your turn signals when changing lanes or turning to indicate your intentions to other drivers.
                    </li>
                </ol>
            </div>

            <div class="text-center">
                <button onclick="goBack()" class="mt-6 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded">
                    BACK
                </button>
            </div>
        </div>

        <!--- Car Maintenance Tips --->
        <div id="blogMaintenance" class="hidden max-w-7xl mx-auto mt-3 p-5 bg-gray-100 rounded-lg">

            <div class="flex items-center bg-gray-200 border border-b-0 border-blue-500 rounded-t-xl px-4 py-2">
                <h2 class="text-4xl font-bold uppercase tracking-wider text-gray-800">5 Car Maintenance Tips</h2>
            </div>

            
            <div class="bg-white p-6 border-2 border-blue-500 rounded-b-xl shadow-md">
                <ol class="list-decimal list-inside text-gray-800 space-y-4">
                    <li>
                        <strong class="text-blue-600">Check and Change Engine Oil Regularly:</strong>
                        Regular oil checks and timely changes keep your engine running smoothly by reducing friction and preventing overheating.
                    </li>
                    <li>
                        <strong class="text-blue-600">Maintain Proper Tire Health:</strong>
                        Check tire pressure monthly and inspect tire treads for wear, especially on wet roads.
                    </li>
                    <li>
                        <strong class="text-blue-600">Inspect Your Brakes:</strong>
                        Ensure brake pads, rotors, and fluid levels are in good condition. Replace parts if needed.
                    </li>
                    <li>
                        <strong class="text-blue-600">Keep Fluids Topped Up:</strong>
                        Regularly check brake, transmission, and windshield washer fluids to prevent system failures.
                    </li>
                    <li>
                        <strong class="text-blue-600">Test Battery Health:</strong>
                        Check for corrosion, clean terminals, and replace batteries that are weakening or 3–5 years old.
                    </li>
                    <li>
                        <strong class="text-blue-600">Check Vehicle Condition Before Renting:</strong>
                        Inspect the vehicle for any damages or issues before renting it out to customers.
                    </li>
                    <li>
                        <strong class="text-blue-600">Regularly Clean and Sanitize Vehicles:</strong>
                        Clean and sanitize vehicles after each rental to ensure a safe and healthy environment for customers.
                    </li>
                    <li>
                        <strong class="text-blue-600">Check Tire Pressure and Oil Levels:</strong>
                        Regularly check tire pressure and oil levels to ensure vehicles are running smoothly and efficiently.
                    </li>
                    <li>
                        <strong class="text-blue-600">Perform Routine Maintenance:</strong>
                        Perform routine maintenance tasks such as oil changes, brake pad replacements, and tire rotations to keep vehicles in good condition.
                    </li>
                    <li>
                        <strong class="text-blue-600">Keep Vehicles Up-to-Date with Safety Features:</strong>
                        Ensure vehicles are equipped with the latest safety features such as airbags, anti-lock brakes, and electronic stability control.
                    </li>
                </ol>
            </div>

            <div class="text-center">
                <button onclick="goBack()" class="mt-6 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded">
                    BACK
                </button>
            </div>
        </div>

        <!--- Best time to rent --->
        <div id="blogRenting" class="hidden max-w-7xl mx-auto mt-3 p-5 bg-gray-100 rounded-lg">

            <div class="flex items-center bg-gray-200 border border-b-0 border-blue-500 rounded-t-xl px-4 py-2">
                <h2 class="text-4xl font-bold uppercase tracking-wider text-gray-800">Best time to rent a Car</h2>
            </div>

                
            <div class="bg-white p-6 border-2 border-blue-500 rounded-b-xl shadow-md">
                <ol class="list-decimal list-inside text-gray-800 space-y-4">
                    <li>
                        <strong class="text-blue-600">Avoid Peak Season:</strong>
                        If possible, avoid renting a car during peak season (usually summer and holidays) when prices tend to be higher.
                    </li>
                    <li>
                        <strong class="text-blue-600">Book in Advance:</strong>
                        Book your car rental well in advance to ensure availability and get the best rates.
                    </li>
                    <li>
                        <strong class="text-blue-600">Consider Off-Peak Hours:</strong>
                        Renting a car during off-peak hours (usually weekdays) can result in lower rates.
                    </li>
                    <li>
                        <strong class="text-blue-600">Look for Discounts and Promotions:</strong>
                        Keep an eye out for discounts and promotions offered by car rental companies, especially during off-peak seasons.
                    </li>
                    <li>
                        <strong class="text-blue-600">Be Flexible with Your Dates:</strong>
                        Being flexible with your rental dates can help you find better deals. Consider renting a car for a longer period or during the off-season.
                    </li>
                </ol>
            </div>

            <div class="text-center">
                <button onclick="goBack()" class="mt-6 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded">
                    BACK
                </button>
            </div>
        </div>

        <!--- Local Cuisine to try on your Roadtrip --->
        <div id="blogCuisine" class="hidden max-w-7xl mx-auto mt-3 p-5 bg-gray-100 rounded-lg">
            <h2 class="text-4xl font-bold mb-6 text-center">Popular Restaurants in the Philippines</h2>

        
            <div class="flex flex-col md:flex-row items-start bg-white border-4 border-blue-300 rounded-2xl mb-6 p-4 shadow-md">
                <img src="images/blog/balay dako.jpg" alt="Balay Dako" class="w-full md:w-40 h-28 object-cover rounded-xl mb-4 md:mb-0 md:mr-4 border-2 border-white shadow-sm">
                <div>
                    <a href="#" class="text-blue-600 font-semibold text-lg hover:underline">Balay Dako (Tagaytay)</a>
                    <p class="text-gray-800 mt-1">
                        Known for its stunning view of Taal Volcano and delicious Filipino dishes, Balay Dako serves a variety of traditional and contemporary Filipino comfort food. Try their sinigang na baboy or crispy pata for a satisfying meal while enjoying the scenic surroundings.
                    </p>
                </div>
            </div>

            
            <div class="flex flex-col md:flex-row items-start bg-white border-4 border-blue-300 rounded-2xl mb-6 p-4 shadow-md">
                <img src="images/blog/tarboosh.jpeg" alt="Al Tarboosh" class="w-full md:w-40 h-28 object-cover rounded-xl mb-4 md:mb-0 md:mr-4 border-2 border-white shadow-sm">
                <div>
                    <a href="#" class="text-blue-600 font-semibold text-lg hover:underline">Al Tarboosh Arabic Resto (Makati)</a>
                    <p class="text-gray-800 mt-1">
                        Al Tarboosh is a well-loved Arabic restaurant offering authentic Middle Eastern and halal dishes. Known for lamb kebabs, shawarma, and hummus, it’s great for group dining with hearty portions and a warm atmosphere.
                    </p>
                </div>
            </div>

        
            <div class="flex flex-col md:flex-row items-start bg-white border-4 border-blue-300 rounded-2xl mb-6 p-4 shadow-md">
                <img src="images/blog/manam.jpg" alt="Manam" class="w-full md:w-40 h-28 object-cover rounded-xl mb-4 md:mb-0 md:mr-4 border-2 border-white shadow-sm">
                <div>
                    <a href="#" class="text-blue-600 font-semibold text-lg hover:underline">Manam (Metro Manila)</a>
                    <p class="text-gray-800 mt-1">
                        Manam serves both traditional comfort food and creative twists. Their sinigang na beef short ribs and crispy sisig are crowd favorites. Perfect for classic or contemporary tastes.
                    </p>
                </div>
            </div>

            
            <div class="flex flex-col md:flex-row items-start bg-white border-4 border-blue-300 rounded-2xl mb-6 p-4 shadow-md">
                <img src="images/blog/vikings.jpg" alt="Vikings Luxury Buffet" class="w-full md:w-40 h-28 object-cover rounded-xl mb-4 md:mb-0 md:mr-4 border-2 border-white shadow-sm">
                <div>
                    <a href="#" class="text-blue-600 font-semibold text-lg hover:underline">Vikings Luxury Buffet (Multiple Locations)</a>
                    <p class="text-gray-800 mt-1">
                        Vikings Luxury Buffet offers an extensive selection of international cuisine, including Filipino, Chinese, Japanese, and Italian dishes. With multiple locations in Metro Manila, it's a great option for a satisfying buffet experience.
                    </p>
                </div>
            </div>

            
            <div class="flex flex-col md:flex-row items-start bg-white border-4 border-blue-300 rounded-2xl mb-6 p-4 shadow-md">
                <img src="images/blog/barrio.jpg" alt="Barrio Fiesta" class="w-full md:w-40 h-28 object-cover rounded-xl mb-4 md:mb-0 md:mr-4 border-2 border-white shadow-sm">
                <div>
                    <a href="#" class="text-blue-600 font-semibold text-lg hover:underline">Barrio Fiesta (Multiple Locations)</a>
                    <p class="text-gray-800 mt-1">
                        Barrio Fiesta is a popular Filipino restaurant chain offering a wide range of traditional dishes, including crispy pata, sinigang, and lechon kawali. With multiple locations in Metro Manila, it's a great option for a classic Filipino dining.
                    </p>
                </div>
            </div>
            
            <div class="text-center">
                <button onclick="goBack()" class="mt-6 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded">
                    BACK
                </button>
            </div>
        </div>

        <!--- Road Trip Essentials --->
        <div id="blogEssentials" class="hidden max-w-5xl mx-auto mt-8 p-4 bg-white rounded-lg shadow">

            <h2 class="text-4xl font-bold mb-6 text-center">ROADTRIP ESSENTIALS</h2>

   
            <div class="grid grid-cols-5 gap-4 mb-6">
                <div onclick="selectEssential(0)" id="essential0" class="cursor-pointer border-4 rounded-lg p-1 transition" >
                    <img src="images/blog/01.png" class="rounded object-cover w-full h-30" />
                </div>
                <div onclick="selectEssential(1)" id="essential1" class="cursor-pointer border rounded-lg p-1 transition">
                    <img src="images/blog/02.png" class="rounded object-cover w-full h-30" />
                </div>
                <div onclick="selectEssential(2)" id="essential2" class="cursor-pointer border rounded-lg p-1 transition">
                    <img src="images/blog/03.png" class="rounded object-cover w-full h-30" />
                </div>
                <div onclick="selectEssential(3)" id="essential3" class="cursor-pointer border rounded-lg p-1 transition">
                    <img src="images/blog/04.png" class="rounded object-cover w-full h-30" />
                </div>
                <div onclick="selectEssential(4)" id="essential4" class="cursor-pointer border rounded-lg p-1 transition">
                    <img src="images/blog/05.png" class="rounded object-cover w-full h-30" />
                </div>
            </div>


            <div class="border-[3px] border-blue-300 bg-gray-500 p-4 rounded-lg shadow-inner">
                <h3 id="essentialTitle" class="font-bold text-gray-800 mb-1 uppercase tracking-wide text-xl">CAR EMERGENCY KIT</h3>
                    <p id="essentialDescription" class="text-gray-800 text-xl leading-relaxed">
                        Always be prepared for unexpected situations. Pack an emergency kit that includes a spare tire, jack, jumper cables, flashlight, basic first-aid supplies, and a multi-tool.
                    </p>
            </div>


            <div class="text-center">
                <button onclick="goBack()" class="mt-6 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded">
                    BACK
                </button>
            </div>
        </div>

        <!--- Travel Guides --->
        <div id="blogTravel" class="hidden max-w-7xl mx-auto mt-3 p-5 bg-gray-100 rounded-lg">
            <h2 class="text-4xl font-bold mb-4">3 POPULAR DESTINATIONS IN THE PHILIPPINES</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <img src="images/blog/01 tagaytay.jpg" class="w-full h-40 object-cover rounded" />
                    <h3 class="text-lg font-semibold mt-2">Tagaytay City</h3>
                </div>
                <div>
                    <img src="images/blog/02 la uinon.jpg" class="w-full h-40 object-cover rounded" />
                    <h3 class="text-lg font-semibold mt-2">La Union</h3>
                </div>
                <div>
                    <img src="images/blog/03 baguio.jpg" class="w-full h-40 object-cover rounded" />
                    <h3 class="text-lg font-semibold mt-2">Baguio City</h3>
                </div>
            </div>

            <p class="mt-4 text-gray-700">
                Escape to <strong class="text-blue-600">Tagaytay</strong>, known for its cool climate and stunning views of Taal Lake and Volcano.
                Enjoy top attractions like People's Park in the Sky and Picnic Grove, or indulge in local delights like bulalo.
                With scenic landscapes and fun activities, Tagaytay is perfect for relaxation and adventure.
            </p>

            <div class="text-center">
                <button onclick="goBack()" class="mt-6 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded">
                    BACK
                </button>
            </div>
        </div>
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