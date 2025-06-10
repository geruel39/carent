//Logout user
document.getElementById('logout').onclick = () => {

    const info = {
        logout: true
    }

    fetch('z_acc.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
    .then(response => response.json())
    .then(data =>{
        console.log( "Logout : ",data);
        location.href = 'signin.html';
    })
    .catch(error => {console.error('Error Message!', error)})

}

//SIDEBAR
const sidebar = document.getElementById('sidebar');
document.getElementById('sidebar_resize').onclick = () => {

    if (sidebar.classList.contains('-left-56')) {
        sidebar.classList.remove('-left-56');
    } else {
        sidebar.classList.add('-left-56');
    }
}

//TAB AND PAGES
const tabs = document.querySelectorAll('.tab');
const pages = document.querySelectorAll('.page');
tabs.forEach((tab, index) => {
    tab.addEventListener('click', ()=>{
        tabs.forEach(tab=>{
            tab.classList.remove('bg-gray-300');
        });
        tab.classList.add('bg-gray-300');

        pages.forEach(page=>{
            page.classList.add('hidden');
        })
        pages[index].classList.remove('hidden');

        sidebar.classList.add('-left-56');
    })
}) 

//TAB AND PAGES for RENTALS
const rentTabs = document.querySelectorAll('.rent-tab');
const rentPages = document.querySelectorAll('.rent-page');
rentTabs.forEach((tab, index) => {
    tab.addEventListener('click', ()=>{
        rentTabs.forEach(tab=>{
            tab.classList.remove('text-blue-500');
            tab.classList.remove('font-semibold');
        });
        tab.classList.add('text-blue-500');
        tab.classList.add('font-semibold');

        rentPages.forEach(page=>{
            page.classList.add('hidden');
        })
        rentPages[index].classList.remove('hidden');
    })
}) 

//MANUAL NEW RENT MODAL
const newRentModal = document.getElementById('new_rent_modal');
document.getElementById('open_add_new_rent').onclick = ()=>{
    newRentModal.classList.remove('hidden');
}
document.getElementById('cancel_rent_modal').onclick = ()=>{
    newRentModal.classList.add('hidden');
}
document.getElementById('add_rent_btn').onclick = ()=>{

    const customer = document.getElementById('customer');
    const car = document.getElementById('car');
    const start = document.getElementById('start');
    const returndt = document.getElementById('return');
    const driver = document.getElementById('driver');
    const gas = document.getElementById('extra_gas');
    const box = document.getElementById('roof_box');
    const seat = document.getElementById('child_seat');

    if(!customer.value && !car.value && !start.value && !returndt.value){
        alert('Some information is missing.');
        return;
    }

    const info = {
        addRent: true,
        customer: customer.value,
        car: car.value,
        start: start.value,
        returndt: returndt.value,
        driver: driver.value,
        gas: gas.checked,
        box: box.checked,
        seat: seat.checked
    }

    fetch('z_admin.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
    .then(response => response.json())
    .then(data =>{
        console.log( "Add Rent: ",data);

        if(data){
            alert('Rental successfully added.');

            newRentModal.classList.add('hidden');

            customer.value = "";
            car.value = "";
            start.value = "";
            returndt.value = "";
            driver.value = "";
            gas.checked = false;
            box.checked = false;
            seat.checked = false;
        }else{
            alert('Something went wrong.');
        }


    })
    .catch(error => {console.error('Error Message!', error)})

}

//ADD CAR MODAL
const addVehicleModal = document.getElementById('add_vehicle_modal');
document.getElementById('open_add_vehicle').onclick = ()=>{
    addVehicleModal.classList.remove('hidden');
}
document.getElementById('cancel_add_vehicle').onclick = ()=>{
    addVehicleModal.classList.add('hidden');
}
document.getElementById('add_car_btn').onclick = ()=>{

    const info = {
        addCar: true,
        type: document.getElementById('type').value,
        brand: document.getElementById('brand').value,
        model: document.getElementById('model').value,
        transmission: document.getElementById('transmission').value,
        fuel: document.getElementById('fuel').value,
        passenger: document.getElementById('passenger').value,
        doors: document.getElementById('doors').value,
        color: document.getElementById('color').value,
        price: document.getElementById('price').value,
        quantity: document.getElementById('quantity').value,
        image: document.getElementById('image').value
    }
    for(let i in info){

        if(!info[i]){
            alert('Some information is missing.');
            return;
        }

    }

    const formData = new FormData();

    formData.append('addCar', true);
    formData.append('type', document.getElementById('type').value);
    formData.append('brand', document.getElementById('brand').value);
    formData.append('model', document.getElementById('model').value);
    formData.append('transmission', document.getElementById('transmission').value);
    formData.append('fuel', document.getElementById('fuel').value);
    formData.append('passenger', document.getElementById('passenger').value);
    formData.append('doors', document.getElementById('doors').value);
    formData.append('color', document.getElementById('color').value);
    formData.append('price', document.getElementById('price').value);
    formData.append('quantity', document.getElementById('quantity').value);

    const imageInput = document.getElementById('image');
    if (imageInput.files.length > 0) {
        formData.append('image', imageInput.files[0]);
    } else {
        alert('Please select an image.');
        return;
    }

    fetch('z_admin.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        alert(result);

        addVehicleModal.classList.add('hidden');
        document.getElementById('type').value = "";
        document.getElementById('brand').value = "";
        document.getElementById('model').value = "";
        document.getElementById('transmission').value = "";
        document.getElementById('fuel').value = "";
        document.getElementById('passenger').value = "";
        document.getElementById('doors').value = "";
        document.getElementById('color').value = "";
        document.getElementById('price').value = "";
        document.getElementById('quantity').value = "";
        document.getElementById('image').value = "";



    })
    .catch(error => {
        console.error('Error:', error);
    })



}

//INSERT CARS IN SELECT 
function insertCars() {

    const selectElement = document.getElementById('car');

    const info = {
        insertCars: true
    }

    fetch('z_admin.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
    .then(response => response.json())
    .then(data =>{
        console.log( "Insert Cars: ",data);

        if(!data.result){
            selectElement.innerHTML = `
                <option value=''>No Car Available</option>
            `
        }else{

            selectElement.append("<option value='' selected disabled>Select Car</option>");

            data.cars.forEach(c=>{

                const option = document.createElement('option');
                option.value = c.car_id;
                option.textContent = c.car_name;

                selectElement.append(option);

            })

        }


    })
    .catch(error => {console.error('Error Message!', error)})

}
insertCars();

//DISPLAY RENTALS
function displayRentRequest() {

    const info = {
        displayRentRequest: true
    }

    const table = document.getElementById('renting_request_table').getElementsByTagName('tbody')[0];
    table.innerHTML = "";


    fetch('z_admin.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
    .then(response => response.json())
    .then(data =>{
        console.log( "Request: ",data);

        if(!data.result){
            const newRow = table.insertRow();
            newRow.insertCell().textContent = "No Result";
        }else{

            data.request.forEach(r=>{

                const newRow = table.insertRow();
                newRow.insertCell().textContent = r.customer;
                newRow.insertCell().textContent = r.carname;
                newRow.insertCell().textContent = r.pdlocation;
                newRow.insertCell().textContent = r.start;
                newRow.insertCell().textContent = r.return;
                newRow.insertCell().textContent = r.driver;
                newRow.insertCell().textContent = r.total;
                const payment = newRow.insertCell();
                payment.textContent = r.payment === "Cash" ? r.payment : "Proof";
                payment.classList.add('cursor-pointer');
                if(r.payment != "Cash"){
                    payment.classList.add('view_proof');
                    payment.classList.add('text-blue-500');
                    payment.classList.add('cursor-pointer');
                    payment.classList.add('hover:underline');
                    payment.setAttribute('data-img', r.payment);
                }

                const action = newRow.insertCell();
                action.innerHTML = `
                    <div class='flex items-center space-x-1 p-2'>
                        <button class='w-20 p-1 text-sm font-semibold bg-blue-500 rounded hover:bg-blue-700 confirm_request' data-id='${r.rent_id}'>Confirm</button>
                        <button class='w-20 p-1 text-sm font-semibold bg-red-500 rounded hover:bg-red-700 reject_request' data-id='${r.rent_id}'>Reject</button>
                    </div>
                `

            });

            document.querySelectorAll('.view_proof').forEach(p=>
                p.addEventListener('click', e=>{
                    const image = e.currentTarget.getAttribute('data-img');

                    const view = document.getElementById('view_proof');
                    view.innerHTML = `
                        <img src='images/proofs/${image}' class='object-cover'>
                    `;

                    view.classList.remove('hidden');

                    view.onclick = ()=>{
                        view.classList.add('hidden');
                    }

                    console.log('he')
                })
            )

            document.querySelectorAll('.confirm_request').forEach(r=>{
                r.addEventListener('click', e=>{
                    const id = e.currentTarget.getAttribute('data-id');

                    if(!window.confirm('Confirm this request?')){
                        return;
                    }

                    const info = {
                        updateRequest: true,
                        request: id,
                        update: "Confirmed"
                    }

                    fetch('z_admin.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
                    .then(response => response.json())
                    .then(data =>{
                        console.log( "Update Request: ",data);

                        if(data){
                            alert('Successfully Done.');
                        }else{
                            alert('Something went wrong.');
                        }

                        displayRentRequest();
                    })
                    .catch(error => {console.error('Error Message!', error)})
                })
            })

            document.querySelectorAll('.reject_request').forEach(r=>{
                r.addEventListener('click', e=>{
                    const id = e.currentTarget.getAttribute('data-id');

                    if(!window.confirm('Reject this request?')){
                        return;
                    }

                    const info = {
                        updateRequest: true,
                        request: id,
                        update: "Rejected"
                    }

                    fetch('z_admin.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
                    .then(response => response.json())
                    .then(data =>{
                        console.log( "Update Request: ",data);

                        if(data){
                            alert('Successfully Done.');
                        }else{
                            alert('Something went wrong.');
                        }

                        displayRentRequest();
                    })
                    .catch(error => {console.error('Error Message!', error)})
                })
            })

        }
    })
    .catch(error => {console.error('Error Message!', error)});



}
displayRentRequest();

function displayRentals() {

    const info = {
        displayRentals: true
    }

    const table = document.getElementById('rentals_table').getElementsByTagName('tbody')[0];
    table.innerHTML = "";

    fetch('z_admin.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
    .then(response => response.json())
    .then(data =>{
        console.log( "Rentals: ",data);

        if(!data.result){
            const newRow = table.insertRow();
            newRow.insertCell().textContent = "No Result";
        }else{
            data.rentals.forEach(r=>{
                const newRow = table.insertRow();
                newRow.classList.add('py-1');

                newRow.insertCell().textContent = r.customer;
                newRow.insertCell().textContent = r.carname;
                newRow.insertCell().textContent = r.pdlocation;
                newRow.insertCell().textContent = r.start;
                newRow.insertCell().textContent = r.return;
                
                const status = newRow.insertCell();
                status.classList.add('text-xs');
                status.classList.add('p-1');
                status.classList.add('text-center');
                status.classList.add('font-semibold');

                const now = new Date();
                const startDate = new Date(r.start); // Convert string to Date

                if (startDate < now) {
                    status.textContent = "Pending";
                    status.classList.add('bg-blue-500');
                } else {
                    status.textContent = "Ongoing";
                    status.classList.add('bg-green-500');
                }


            })
        }
    })
    .catch(error => {console.error('Error Message!', error)})

}
displayRentals();

//DISPLAT ACCOUNTS
function displayAccounts() {

    const info = {
        displayAccounts: true
    }

    const table = document.getElementById('accounts_table').getElementsByTagName('tbody')[0];
    table.innerHTML = "";

    fetch('z_admin.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
    .then(response => response.json())
    .then(data =>{
        console.log( "Accounts: ",data);

        if(!data.result){
            const newRow = table.insertRow();
            newRow.insertCell().textContent = "No Result";
        }else{
            data.accounts.forEach(a=>{

                const newRow = table.insertRow();

                const image = newRow.insertCell();
                image.innerHTML = `
                    <div class='w-16 h-16'>
                        <image src='images/accounts.svg' class='object-cover'>
                    </div>
                `;
                newRow.insertCell().textContent = a.username;
                newRow.insertCell().textContent = a.firstname;
                newRow.insertCell().textContent = a.lastname;
                newRow.insertCell().textContent = a.gender;
                newRow.insertCell().textContent = a.email;
                newRow.insertCell().textContent = a.phone;
                const action = newRow.insertCell();
                action.innerHTML = `
                    <div class='flex items-center space-x-1 p-2'>
                        <button class='w-16 p-1 text-sm font-semibold bg-blue-500 rounded hover:bg-blue-700' data-id='${a.account_id}'>Edit</button>
                        <button class='w-16 p-1 text-sm font-semibold bg-red-500 rounded hover:bg-red-700' data-id='${a.account_id}'>Delete</button>
                    </div>
                `;

            })
        }

    })
    .catch(error => {console.error('Error Message!', error)})

}
displayAccounts();

function displayCars() {

    const info = {
        displayCars: true
    }

    const table = document.getElementById('car_table').getElementsByTagName('tbody')[0];
    table.innerHTML = "";

    fetch('z_admin.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
    .then(response => response.json())
    .then(data =>{
        console.log( "Cars: ",data);

        if(!data.result){
            const newRow = table.insertRow();
            newRow.insertCell().textContent = "No Result";
        }else{

            data.cars.forEach(c=>{

                const newRow = table.insertRow();
                
                const image = newRow.insertCell();
                image.innerHTML = `<img src='images/car/${c.image}' > `;
                newRow.insertCell().textContent = c.type;
                newRow.insertCell().textContent = c.brand;
                newRow.insertCell().textContent = c.model;
                newRow.insertCell().textContent = c.transmission;
                newRow.insertCell().textContent = c.passenger;
                newRow.insertCell().textContent = c.doors;
                newRow.insertCell().textContent = c.color;
                newRow.insertCell().textContent = c.fuel;
                newRow.insertCell().textContent = c.quantity;
                newRow.insertCell().textContent = c.price;
                const action = newRow.insertCell();
                action.innerHTML = `
                    <div class='flex items-center space-x-1 p-2'>
                        <button class='w-16 p-1 text-sm font-semibold bg-blue-500 rounded hover:bg-blue-700' data-id='${c.car_id}'>Edit</button>
                        <button class='w-16 p-1 text-sm font-semibold bg-red-500 rounded hover:bg-red-700' data-id='${c.car_id}'>Delete</button>
                    </div>
                `;

            })

        }

    })
    .catch(error => {console.error('Error Message!', error)})
}

displayCars();