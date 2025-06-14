<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="max-w-full w-full bg-gray-200">

    <!-- Sidebar -->
    <div id="sidebar" class="fixed -left-56 w-56 min-h-screen p-5 border-r border-gray-400 bg-gray-200 flex flex-col space-y-3">

        <img id="sidebar_resize" src="images/collapse-r.svg" alt="close sidebar" class="w-5 cursor-pointer mx-1 rounded absolute -right-7 top-2 hover:bg-gray-300" title="close sidebar">

        <div class="flex items-center">
            <h3 class="text-sm font-bold text-gray-500 uppercase">sidebar navigation</h3>
        </div>

        <div class="tab flex p-2 cursor-pointer rounded transitions duration-200 hover:bg-gray-300">
            <img src="images/rental.svg" alt="accounts icon" class="w-6 mx-1">
            <p>Rentals</p>
        </div>

        <div class="tab flex p-2 cursor-pointer rounded transitions duration-200 hover:bg-gray-300">
            <img src="images/vehicle.svg" alt="vehicle icon" class="w-6 mx-1">
            <p>Cars</p>
        </div>

        <div class="tab flex p-2 cursor-pointer rounded transitions duration-200 hover:bg-gray-300">
            <img src="images/setting.svg" alt="setting icon" class="w-6 mx-1">
            <p>Options</p>
        </div>

        <div id="logout" class="flex p-2 cursor-pointer rounded transitions duration-200 hover:bg-gray-300">
            <img src="images/logout.svg" alt="logout icon" class="w-6 mx-1">
            <p>Logout</p>
        </div>
        
        
    </div>

    <!-- Header -->
    <div class="h-12 flex items-center justify-center bg-gray-500">
        <h1 class="text-lg text-gray-50 font-bold uppercase tracking-wider">LARGA PINAS</h1>
    </div>

    <!-- Pages -->
    <div class="pages w-full p-6">

        <!-- Rentals -->
        <div class="page">

            <h1 class="text-lg font-bold ml-5">Manage Rentals</h1>

            <div class="flex justify-between items-center">

                <div class="flex items-center space-x-2 p-2">
                    <p class="rent-tab p-1 cursor-pointer font-semibold text-blue-500 hover:text-blue-400">Renting Request</p>
                    <p class="rent-tab p-1 cursor-pointer hover:text-blue-400">Rentals</p>
                    <p class="rent-tab p-1 cursor-pointer hover:text-blue-400">Rental History</p>
                </div>

                <div class="flex">
                    <button id="open_add_new_rent" class="text-sm text-white font-bold p-2 rounded bg-blue-500 opacity-90 hover:opacity-100">+ ADD NEW RENT</button>
                </div>

            </div>

            <!-- Renting Request -->
            <div class="rent-page">

                <div class="w-full overflow-auto rounded-lg shadow">

                    <table id="renting_request_table" class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Customer Name</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Car Rented</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Pick-up D/T</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Return D/T</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Extras</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Total Cost</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Payment Proof</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr>
                                <td class="p-3 text-sm whitespace-nowrap">No Result</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div id="view_proof" class="w-96 h-96 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex justify-center items-center hidden">
                    
                </div>

            </div>

            <!-- Rentals -->
            <div class="rent-page hidden">

                <div class="w-full overflow-auto rounded-lg shadow">

                    <table id="rentals_table" class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Customer Name</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Car Rented</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Pick-up D/T</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Return D/T</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Extras</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Total</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Status</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr>
                                <td class="p-3 text-sm whitespace-nowrap">No Result</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

            <!-- Renting History -->
            <div class="rent-page hidden">

                <div class="w-full overflow-auto rounded-lg shadow">

                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Customer Name</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Car Rented</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Rental Period</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">P & D Location</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Driver</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Date</th>
                                <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr>
                                <td class="p-3 text-sm whitespace-nowrap">No Result</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

            <!-- Add New Rent Modal -->
            <div id="new_rent_modal" class="fixed bottom-1 right-1 w-96 h-96 px-2 bg-gray-50 rounded border border-gray-500 overflow-auto hidden">

                <h3 class="font-semibold mb-3">Onsite Renting</h3>

                <div class="flex flex-col space-y-1">

                    <h4 class="text-sm font-semibold">Customer Name:</h4>
                    <input type="text" placeholder="Customer Name" class="p-1" id="customer">

                    <h4 class="text-sm font-semibold">Car:</h4>
                    <select id="car" class="flex-1 p-1">
                        <option value="" selected disabled>Select Car</option>
                    </select>

                    <h4 class="text-sm font-semibold">Start:</h4>
                    <input type="datetime-local" class="p-1" id="start">

                    <h4 class="text-sm font-semibold">Return:</h4>
                    <input type="datetime-local" class="p-1" id="return">

                    <h4 class="text-sm font-semibold">Driver:</h4>
                    <select id="driver" class="flex-1 p-1">
                        <option value="No" >No</option>
                        <option value="Yes">Yes</option>
                    </select>


                    <h4 class="text-sm font-semibold">Extras:</h4>
                    <div class="flex text-xs font-semibold space-x-2">
                        <input type="checkbox" id="extra_gas">
                        <label for="extra_gas"> Extra Gas</label>
                        <input type="checkbox" id="roof_box">
                        <label for="roof_box"> Roof Box</label>
                        <input type="checkbox" id="child_seat">
                        <label for="child_seat"> Child Seat</label>
                    </div>

                </div>

                <div class="sticky bottom-0 right-1 p-1 bg-white w-full flex justify-end space-x-2">
                    <button id="cancel_rent_modal" class="w-16 p-1 rounded bg-red-500 text-sm font-semibold text-white opacity-90 hover:opacity-100 ">Cancel</button>
                    <button id="add_rent_btn" class="w-16 p-1 rounded bg-blue-500 text-sm font-semibold text-white opacity-90 hover:opacity-100">Confirm</button>
                </div>

            </div>
            

        </div>

        <!-- Cars -->
        <div class="page hidden">   

            <!-- Cars Header and Table Filter -->
            <div class="flex justify-between items-center">
                <h1 class="text-lg font-bold ml-5">Cars</h1>

                <div class="flex justify-end my-1 space-x-1">
                    <button id="open_add_vehicle" class="text-sm text-white font-bold p-2 rounded bg-blue-400 opacity-90 hover:opacity-100">+ ADD CAR</button>
                </div>
            </div>

            <!-- Cars Table -->
            <div class="w-full overflow-auto rounded-lg shadow">

                <table id="car_table" class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Image</th>
                            <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Type</th>
                            <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Brand</th>
                            <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Model</th>
                            <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Transmission</th>
                            <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Passenger</th>
                            <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Doors</th>
                            <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Color</th>
                            <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Fuel</th>
                            <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Price</th>
                            <th class="w-36 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td class="p-3 text-sm whitespace-nowrap"><img src="images/cars/AUVs/isuzu crosswind.png" class="object-cover"></td>
                            <td class="p-3 text-sm whitespace-nowrap">ID Number</td>
                            <td class="p-3 text-sm whitespace-nowrap">Username</td>
                            <td class="p-3 text-sm whitespace-nowrap">First name</td>
                            <td class="p-3 text-sm whitespace-nowrap">Last name</td>
                            <td class="p-3 text-sm whitespace-nowrap">Gender</td>
                            <td class="p-3 text-sm whitespace-nowrap">Email Address</td>
                            <td class="p-3 text-sm whitespace-nowrap">Phone Number</td>
                            <td class="p-3 text-sm whitespace-nowrap">Actions</td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <!-- Add Vehicles Modal -->
            <div id="add_vehicle_modal" class="fixed bottom-1 right-1 w-96 h-96 px-2 pt-2 bg-gray-50 rounded border border-gray-500 overflow-auto hidden">

                <h3 class="font-semibold mb-3">Add Car</h3>

                <div class="flex flex-col space-y-1">

                    <select id="type">
                        <option value="" selected disabled>Select Car Type</option>
                        <option value="Sedan">Sedan</option>
                        <option value="SUV">SUV</option>
                        <option value="AUV">AUV</option>
                        <option value="MPV">MPV</option>
                        <option value="Vans">Vans</option>
                    </select>
                    <input type="text" placeholder="Brand" class="p-1" id="brand">
                    <input type="text" placeholder="Model" class="p-1" id="model">
                    <input type="text" placeholder="Transmission" class="p-1" id="transmission">
                    <input type="text" placeholder="Fuel" class="p-1" id="fuel">
                    <input type="number" placeholder="Passenger" class="p-1" id="passenger">
                    <input type="number" placeholder="Doors" class="p-1" id="doors">
                    <input type="text" placeholder="Color" class="p-1" id="color">
                    <input type="number" placeholder="Price" class="p-1" id="price">
                    <input type="file" class="p-1" id="image">

                </div>

                <div class="w-full sticky bottom-0 p-2 bg-gray-50">
                    <button id="cancel_add_vehicle" class="w-16 p-1 rounded bg-red-500 text-sm font-semibold text-white opacity-90 hover:opacity-100 ">Close</button>
                    <button id="add_car_btn" class="w-16 p-1 rounded bg-blue-500 text-sm font-semibold text-white opacity-90 hover:opacity-100">Confirm</button>
                </div>

            </div>


        </div>

        <!-- Option -->
        <div class="page hidden">

            <h1 class="text-lg font-bold ml-5">Option</h1>

        </div>

    </div>

    <script src="js/admin.js"></script>
</body>
</html>