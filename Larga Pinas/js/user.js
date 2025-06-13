//TAB AND PAGES
const tabs = document.querySelectorAll('.tab');
const pages = document.querySelectorAll('.page');
tabs.forEach((tab, index) => {
    tab.addEventListener('click', ()=>{
        tabs.forEach(tab=>{
            tab.classList.remove('text-blue-700');
        });
        tab.classList.add('text-blue-700');

        pages.forEach(page=>{
            page.classList.add('hidden');
        })
        pages[index].classList.remove('hidden');
    })
}) 

//CAR TYPE TAB AND CAR TYPE PAGES
const cartabs = document.querySelectorAll('.car-tab');
const carpages = document.querySelectorAll('.car-page');
cartabs.forEach((tab, index) => {
    tab.addEventListener('click', ()=>{
        cartabs.forEach(tab=>{
            tab.classList.remove('bg-gray-300');
        });
        tab.classList.add('bg-gray-300');

        carpages.forEach(page=>{
            page.classList.add('hidden');
        })
        carpages[index].classList.remove('hidden');
    })
}) 

//Change the header if user is signin
function headerProfile() {

    const headerProfile = document.getElementById('header_profile');
    headerProfile.innerHTML = "";

    const userId = document.getElementById('user_id');

    if(userId.value){

        const username = document.getElementById('user_username');
        const name = document.getElementById('user_name');

        headerProfile.innerHTML = `
            <div>
                <p class='text-sm font-semibold '>${username.value}</p>
                <p class='text-xs text-gray-300 capitalize'>${name.value}</p>
            </div>
            <p id='menu_bar' class='p-1 cursor-pointer rounded transition duration-200 hover:bg-gray-500'>&#9776;</p>
        `;

        if(document.getElementById('menu_bar')){
            document.getElementById('menu_bar').onclick = () => {
                const menu = document.getElementById('menu');

                if(menu.classList.contains('hidden')){
                    menu.classList.remove('hidden');
                }else{
                    menu.classList.add('hidden');
                }
            }
        }

        return true;
    }else{
        headerProfile.innerHTML = `
            <a href="signin.html" class="p-1 bg-white rounded hover:underline">Sign In</a>
            <a href="signup.html" class="p-1 bg-gray-200 rounded hover:underline">Sign Up</a>
        `;

        return false;
    }

}
headerProfile();

//Logout user
document.getElementById('logout').onclick = () => {

    const info = {
        logout: true
    }

    fetch('z_acc.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
    .then(response => response.json())
    .then(data =>{
        console.log( "Logout : ",data);
        location.reload();
    })
    .catch(error => {console.error('Error Message!', error)})

}

//DISPLAY CARS
function displayCars() {

    const info = {
        displayCars: true
    }
    
    const sedan = document.getElementById('sedan_car_list');
    sedan.innerHTML = "";
    const suv = document.getElementById('suv_car_list');
    suv.innerHTML = "";
    const auv = document.getElementById('auv_car_list');
    auv.innerHTML = "";
    const mpv = document.getElementById('mpv_car_list');
    mpv.innerHTML = "";
    const vans = document.getElementById('vans_car_list');
    vans.innerHTML = "";

    fetch('z_user.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
    .then(response => response.json())
    .then(data =>{
        console.log( "Display Cars: ",data);

        if(!data.result){
            all.innerHTML = "<h1 class='font-semibold'>No Result</h1>"
        }else{

            data.cars.forEach(c=>{

                const box = document.createElement('div');
                box.innerHTML = `
                    <div class="w-52 border border-gray-300 hover:border-blue-300 m-5">

                        <p class="uppercase font-semibold text-center">${c.brand} ${c.model}</p>
                        
                        <div class="h-36 overflow-hidden">
                            <img src="images/car/${c.image}" class="p-2 object-cover rounded">
                        </div>

                        <p class="px-1 text-sm">Type: <span class="font-semibold">${c.type}</span></p>
                        <p class="px-1 text-sm">Transmission: <span class="font-semibold">${c.transmission}</span></p>
                        <p class="px-1 text-sm">Fuel Type: <span class="font-semibold">${c.fuel}</span></p>
                        <p class="px-1 text-sm">Passengers: <span class="font-semibold">${c.passenger}</span></p>
                        <p class="px-1 text-sm">Doors: <span class="font-semibold">${c.doors}</span></p>
                        <p class="px-1 text-sm">Color: <span class="font-semibold">${c.color}</span></p>
                        <p class="p-1">Price: <span class="font-semibold text-blue-500">₱${c.price}</span>/hour</p>

                        <div class="m-1">
                            <button class="rent_btn w-full py-2 rounded text-center bg-blue-500 font-semibold transition duration-300 hover:bg-blue-600" data-id="${c.car_id}" data-price="${c.price}">RENT</button>
                        </div>

                    </div>
                `;
                
                if(c.type == "Sedan"){
                    sedan.append(box);
                }

                if(c.type == "SUV"){
                    suv.append(box);
                }

                if(c.type == "AUV"){
                    auv.append(box);
                }

                if(c.type == "MPV"){
                    mpv.append(box);
                }

                if(c.type == "Vans"){
                    vans.append(box);
                }

            });


            document.querySelectorAll('.rent_btn').forEach(btn=>{
                btn.addEventListener('click', e=>{
                    
                    if(!headerProfile()){
                        location.href = "signin.html";
                        return;
                    }

                    const id = e.currentTarget.getAttribute('data-id');
                    const price = e.currentTarget.getAttribute('data-price');

                    const info = {
                        selectCar: true,
                        car: id
                    }

                    const carInfo = document.getElementById('selected_car_info');
                    carInfo.innerHTML = "";

                    fetch('z_user.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
                    .then(response => response.json())
                    .then(data =>{
                        console.log( "Select Car: ",data);

                        const row = document.createElement('div');
                        row.classList.add('flex');
                        row.classList.add('justify-around');
                        row.classList.add('space-x-10');
                        row.innerHTML = `
                            <div class="w-56 h-56 flex items-center">
                                <img src="images/car/${data.car.image}" class="object-cover">
                            </div>
                            <div class="flex flex-col space-y-1">
                                <h1 class="uppercase font-semibold text-lg">${data.car.brand} ${data.car.model}</h1>
                                <p>Type: <span class="font-semibold">${data.car.type}</span></p>
                                <p>Transmission: <span class="font-semibold">${data.car.transmission}</span></p>
                                <p>Fuel Type: <span class="font-semibold">${data.car.fuel}</span></p>
                                <p>Passengers: <span class="font-semibold">${data.car.passenger}</span></p>
                                <p>Doors: <span class="font-semibold">${data.car.doors}</span></p>
                                <p>Color: <span class="font-semibold">${data.car.color}</span></p>
                                <p class="text-lg py-2">Price: <span class="text-blue-500 font-semibold">${data.car.price}</span>/hour</p>
                            </div>
                        `
                        carInfo.append(row);

                        document.getElementById('confirm_rent').setAttribute('data-id', id);
                        document.getElementById('confirm_rent').setAttribute('data-price', price);
                        rentingModal.classList.remove('hidden');


                    })
                    .catch(error => {console.error('Error Message!', error)})
        
                })
            })

        }


    })
    .catch(error => {console.error('Error Message!', error)})

}
displayCars();

//RENTING MODAL
const rentingModal = document.getElementById('online_renting_modal');
document.getElementById('confirm_rent').onclick = ()=>{
    rentingModal.classList.remove('hidden');
}
document.getElementById('cancel_rent').onclick = ()=>{
    rentingModal.classList.add('hidden');
}

//Set Start and Return
function setMinDateTimeToTomorrow(inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;

    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1); 
    tomorrow.setHours(0, 0, 0, 0);                 
    tomorrow.setMinutes(tomorrow.getMinutes() - tomorrow.getTimezoneOffset());

    input.min = tomorrow.toISOString().slice(0, 16);
}
setMinDateTimeToTomorrow('start');
setMinDateTimeToTomorrow('returndt');
function setInitialDatetime(inputId, offsetDays = 1) {
    const input = document.getElementById(inputId);
    const now = new Date();
    now.setDate(now.getDate() + offsetDays);
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    input.value = now.toISOString().slice(0, 16);
}
setInitialDatetime('start');
setInitialDatetime('returndt');

//PAYMENT TABS AND PAGE
const paytabs = document.querySelectorAll('.payment_tab');
const paypages = document.querySelectorAll('.payment_page');
paytabs.forEach((tab, index) => {
    tab.addEventListener('click', ()=>{
        paytabs.forEach(tab=>{
            tab.classList.remove('border-blue-500');
        });
        tab.classList.add('border-blue-500');

        paypages.forEach(page=>{
            page.classList.add('hidden');
        })
        paypages[index].classList.remove('hidden');
    })
}) 

// When CASH is toggled
document.getElementById('cash').onchange = () => {
  const cash = document.getElementById('cash');
  const cashLabel = document.getElementById('cash_label');
  const proof = document.getElementById('proof');
  const proofLabel = document.getElementById('proof_label');

  if (cash.checked) {
    cashLabel.classList.remove('bg-gray-300');
    cashLabel.classList.add('bg-blue-500');

    proof.value = "";
    proofLabel.classList.remove('bg-blue-500');
    proofLabel.classList.add('bg-gray-300');
  } else {
    cashLabel.classList.remove('bg-blue-500');
    cashLabel.classList.add('bg-gray-300');
  }
};
// When FILE is selected
document.getElementById('proof').onchange = () => {
  const cash = document.getElementById('cash');
  const cashLabel = document.getElementById('cash_label');
  const proof = document.getElementById('proof');
  const proofLabel = document.getElementById('proof_label');

  if (proof.files && proof.files.length > 0) {
    proofLabel.classList.remove('bg-gray-300');
    proofLabel.classList.add('bg-blue-500');

    cash.checked = false;
    cashLabel.classList.remove('bg-blue-500');
    cashLabel.classList.add('bg-gray-300');
  } else {
    proofLabel.classList.remove('bg-blue-500');
    proofLabel.classList.add('bg-gray-300');
  }
};

function setTotal() {
  const gas = document.getElementById('extra_gas');
  const box = document.getElementById('roof_box');
  const seat = document.getElementById('child_seat');
  const driver = document.getElementById('driver');

  const start = document.getElementById('start');
  const returndt = document.getElementById('returndt');

  const price = parseFloat(document.getElementById('confirm_rent').getAttribute('data-price')) || 0;

  const startDate = new Date(start.value);
  const returnDate = new Date(returndt.value);
  const diffInMilliseconds = returnDate - startDate;
  const diffInHours = diffInMilliseconds / (1000 * 60 * 60);

  
  if (isNaN(diffInHours) || diffInHours <= 0) {
    document.getElementById('estimated_total').textContent = 'Invalid date range';
    return;
  }

  const baseCost = diffInHours * price;
  const driverCost = driver.checked ? diffInHours * 100 : 0;
  const gasCost = gas.checked ? 1000 : 0;
  const boxCost = box.checked ? 500 : 0;
  const seatCost = seat.checked ? 300 : 0;

  const total = baseCost + driverCost + gasCost + boxCost + seatCost;

  document.getElementById('estimated_total').textContent = total.toFixed(2);
  
  return total;
}
['start', 'returndt', 'driver', 'extra_gas', 'roof_box', 'child_seat'].forEach(id => {
  document.getElementById(id).addEventListener('change', setTotal);
});
setTotal();

//CONFIRM RENT
document.getElementById('confirm_rent').onclick = e=>{

    const price = e.currentTarget.getAttribute('data-price');
    console.log(price)

    const customer = document.getElementById('user_name');
    const car = e.currentTarget.getAttribute('data-id');
    const location = document.getElementById('location');
    const start = document.getElementById('start');
    const returndt = document.getElementById('returndt');
    const driver = document.getElementById('driver');
    const gas = document.getElementById('extra_gas');
    const box = document.getElementById('roof_box');
    const seat = document.getElementById('child_seat');

    const cash = document.getElementById('cash');
    const proof = document.getElementById('proof');

    if(!location.value){
        alert('Pick-up and Drop-off Location is required.');
        return;
    }

    if(true){
        const startDate = new Date(start.value);
        const returnDate = new Date(returndt.value);
        const diffInMilliseconds = returnDate - startDate;
        const diffInHours = diffInMilliseconds / (1000 * 60 * 60);

        if (diffInHours <= 0) {
            alert('Return datetime must be after start datetime.');
            return;
        }
    }

    if(!cash.checked && !proof.files[0]){
        alert('Please select "Pay on Cash" or "Upload Payment Proof"');
        return;
    }

    if(!window.confirm('Click OK to confirm!')){
        return;
    }

    const formData = new FormData();

    formData.append('addRent', 'true');
    formData.append('customer', customer.value);
    formData.append('car', car);
    formData.append('location', location.value);
    formData.append('start', start.value);
    formData.append('returndt', returndt.value);
    formData.append('driver', driver.checked.toString());
    formData.append('gas', gas.checked.toString());
    formData.append('box', box.checked.toString());
    formData.append('seat', seat.checked.toString());
    formData.append('cash', cash.checked.toString());
    formData.append('total', setTotal());

    if (proof.files[0]) {
        formData.append('proof', proof.files[0]);
    }

    fetch('z_user.php', { method: 'POST', body: formData,})
    .then(response => response.json())
    .then(data => {

        console.log(data);

        if(data){
            alert('Successfully Done.');

            document.getElementById('online_renting_modal').classList.add('hidden');
            document.getElementById('proof').value = "";
        }else{
            alert('Something went wrong');
        }

    })
    .catch(error => console.error('Error:', error));
}


//BLOG
function showBlogDetail(id) {
    document.getElementById('blogGrid')?.classList.add('hidden');
    document.getElementById(id)?.classList.remove('hidden');

    const detailSections = document.querySelectorAll("#blogDriving, #blogMaintenance, #blogRenting, #blogCuisine, #blogEssentials, #blogTravel");
    detailSections.forEach(section => section.classList.add('hidden'));

    document.getElementById(id)?.classList.remove('hidden');

    if (id === 'blogTravel') {
        const blogDescriptions = [
            `Escape to <strong class="text-blue-600">Tagaytay</strong>, known for its cool climate and stunning views of Taal Lake and Volcano.
            Enjoy top attractions like People's Park in the Sky and Picnic Grove, or indulge in local delights like bulalo.
            With scenic landscapes and fun activities, Tagaytay is perfect for relaxation and adventure.`,

            `<strong class="text-blue-600">La Union</strong> is the surfing capital of Northern Luzon, perfect for beach lovers and thrill seekers.
            Explore the waves at San Juan beach, visit grape farms, or relax with great seaside food and sunsets.`,

            `Known as the <strong class="text-blue-600">Summer Capital of the Philippines</strong>, Baguio offers cool weather, pine trees, and culture.
            Don't miss Burnham Park, Session Road, and the Strawberry Farm in nearby La Trinidad.`
        ];

        const blogTravel = document.getElementById('blogTravel');
        const description = blogTravel.querySelector("p");
        const imageContainers = blogTravel.querySelectorAll(".grid > div");

        imageContainers.forEach((container, index) => {
            const img = container.querySelector("img");
            img.style.cursor = "pointer";

            
            const newImg = img.cloneNode(true);
            container.replaceChild(newImg, img);
        });

       
        blogTravel.querySelectorAll(".grid > div").forEach((container, index) => {
            const img = container.querySelector("img");

            img.addEventListener("click", () => {
                
                blogTravel.querySelectorAll("img").forEach(img => {
                    img.classList.remove("ring-4", "ring-blue-400", "scale-110");
                });

                
                img.classList.add("ring-4", "ring-blue-400", "scale-110");

                
                description.innerHTML = blogDescriptions[index];
            });
        });
    }
}

const essentials = [
    {
        title: "CAR EMERGENCY KIT",
        description: "Always be prepared for unexpected situations. Pack an emergency kit that includes a spare tire, jack, jumper cables, flashlight, basic first-aid supplies, and a multi-tool. These items can be lifesavers in case of a breakdown or minor accidents."
    },
    {
        title: "SNACKS & WATER",
        description: "Stay hydrated and energized. Pack water bottles and non-perishable snacks like granola bars or trail mix for long drives."
    },
    {
        title: "POWER BANK & CHARGERS",
        description: "Keep your devices charged for navigation, communication, and emergencies. Always bring your phone cable and a power bank."
    },
    {
        title: "CLOTHES & BLANKET",
        description: "Extra clothes for unexpected weather and a blanket for warmth or naps during rest stops."
    },
    {
        title: "ID & TRAVEL DOCUMENTS",
        description: "Bring valid IDs, licenses, and travel documents in a waterproof pouch, especially when crossing provincial borders."
    }
];

function selectEssential(index) {
    document.getElementById("essentialTitle").textContent = essentials[index].title;
    document.getElementById("essentialDescription").textContent = essentials[index].description;

    for (let i = 0; i < essentials.length; i++) {
        const box = document.getElementById(`essential${i}`);
        box.classList.remove("border-blue-500", "border-4");
        box.classList.add("border");
    }
 
    const selected = document.getElementById(`essential${index}`);
    selected.classList.remove("border");
    selected.classList.add("border-blue-500", "border-4");
}



function goBack() {
    document.getElementById('blogGrid')?.classList.remove('hidden');

    const detailSections = document.querySelectorAll("#blogDriving, #blogMaintenance, #blogRenting, #blogCuisine, #blogEssentials, #blogTravel");
    detailSections.forEach(section => section.classList.add('hidden'));

    window.scrollTo({ top: 0, behavior: 'smooth' });
}





