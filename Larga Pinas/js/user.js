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
                            <button class="rent_btn w-full py-2 rounded text-center bg-blue-500 font-semibold transition duration-300 hover:bg-blue-600" data-id="${c.car_id}" data-name="${c.brand} ${c.model}" data-price="${c.price}">RENT</button>
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

                    const id = e.currentTarget.getAttribute('data-id');
                    const price = e.currentTarget.getAttribute('data-price');
                    const name = e.currentTarget.getAttribute('data-name');
                    

                    const info = {
                        selectCar: true,
                        car: id
                    }

                    const carInfo = document.getElementById('car_info_in');
                    carInfo.innerHTML = "";

                    fetch('z_user.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
                    .then(response => response.json())
                    .then(data =>{
                        console.log( "Select Car: ",data);

                        const row = document.createElement('div');
                        row.classList.add('flex');
                        row.classList.add('flex-col');
                        row.classList.add('items-center');
                        row.innerHTML = `
                            <div class="w-40 h-40 flex items-center justify-center">
                                <img src="images/car/${data.car.image} crosswind.png" alt="" class="object-cover">
                            </div>

                            <h3 class="font-semibold uppercase">${data.car.brand} ${data.car.model}</h3>

                            <div class="w-full grid grid-cols-2">

                                <p>Type:</p>
                                <p class="font-semibold text-right" id="p_">${data.car.type}</p>
                                <p>Transmission:</p>
                                <p class="font-semibold text-right" id="p_">${data.car.transmission}</p>
                                <p>Fuel Type:</p>
                                <p class="font-semibold text-right" id="p_">${data.car.fuel}</p>
                                <p>Passengers:</p>
                                <p class="font-semibold text-right" id="p_">${data.car.passenger}</p>
                                <p>Doors:</p>
                                <p class="font-semibold text-right" id="p_">${data.car.doors}</p>
                                <p>Color:</p>
                                <p class="font-semibold text-right" id="p_">${data.car.color}</p>
                                <p>Price:</p>
                                <p class="font-semibold text-right"><span class="text-blue-500" id="p_">${data.car.price}</span>/hr</p>

                            </div>
                        `
                        carInfo.append(row);

                        document.getElementById('confirm_rent').setAttribute('data-id', id);
                        document.getElementById('confirm_rent').setAttribute('data-price', price);
                        document.getElementById('confirm_rent').setAttribute('data-name', name);
                        document.getElementById('car_info').classList.remove('hidden');
                        document.getElementById('renting_process_modal').classList.remove('hidden');


                    })
                    .catch(error => {console.error('Error Message!', error)})
        
                })
            })

        }


    })
    .catch(error => {console.error('Error Message!', error)})

}
displayCars();

function validateDates() {
    const now = new Date();

    const pDay = document.getElementById('p-day').value;
    const pMonth = document.getElementById('p-month').value;
    const pYear = document.getElementById('p-year').value;
    const pTime = document.getElementById('p-time').value;

    
    const rDay = document.getElementById('r-day').value;
    const rMonth = document.getElementById('r-month').value;
    const rYear = document.getElementById('r-year').value;
    const rTime = document.getElementById('r-time').value;

    
    const pickupDate = new Date(`${pYear}-${pMonth}-${pDay}T${pTime}:00`);
    const returnDate = new Date(`${rYear}-${rMonth}-${rDay}T${rTime}:00`);

    
    const oneDayLater = new Date(now.getTime() + 24 * 60 * 60 * 1000);
    if (pickupDate < oneDayLater) {
        alert("Pick-up must be at least 1 day ahead of the current time.");
        return false;
    }

    
    const threeHoursLater = new Date(pickupDate.getTime() + 3 * 60 * 60 * 1000);
    if (returnDate <= threeHoursLater) {
        alert("Return must be at least 3 hours after pick-up.");
        return false;
    }

    
    const sevenDaysLater = new Date(pickupDate.getTime() + 7 * 24 * 60 * 60 * 1000);
    if (returnDate > sevenDaysLater) {
        alert("Return date must not be more than 7 days after pick-up.");
        return false;
    }

    
    return true;
}


function toggleLabelBg(checkboxId, activeBg = 'bg-blue-500', inactiveBg = 'bg-gray-200') {
    const checkbox = document.getElementById(checkboxId);
    const label = document.querySelector(`label[for="${checkboxId}"]`);

    if (!checkbox || !label) return;

    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            label.classList.remove(inactiveBg);
            label.classList.add(activeBg, 'text-white');
        } else {
            label.classList.remove(activeBg, 'text-white');
            label.classList.add(inactiveBg);
        }
    });
}
toggleLabelBg('driver');
toggleLabelBg('gas');
toggleLabelBg('box');
toggleLabelBg('seat');

function insertDate() {
    const selectp = document.getElementById('p-day');
        selectp.innerHTML = "";
        const selectr = document.getElementById('r-day');
        selectr.innerHTML = "";
        for(let i = 1; i < 32; i++){
            const option = document.createElement('option');
            option.value = i.toString().padStart(2, '0');;
            option.textContent = i;
            selectp.append(option);
        }
        for(let i = 1; i < 32; i++){
            const option = document.createElement('option');
            option.value = i.toString().padStart(2, '0');;
            option.textContent = i;
            selectr.append(option);
        }
}
insertDate();

//RENTING PROCESS
function rentProcess() {

    // Get all step containers
    const carInfo = document.getElementById('car_info');
    const perInfo = document.getElementById('per_info');
    const rentInfo = document.getElementById('rent_info');
    const addInfo = document.getElementById('add_info');
    const summary = document.getElementById('summary');
    const terms = document.getElementById('terms');
    const paymentInfo = document.getElementById('payment_info');
    const final = document.getElementById('final');
    const closing = document.getElementById('closing');

    //Get all requirement
    const fullname = document.getElementById('fullname');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');

    const pDay = document.getElementById('p-day');
    const pMonth = document.getElementById('p-month');
    const pYear = document.getElementById('p-year');
    const pTime = document.getElementById('p-time');

    const rDay = document.getElementById('r-day');
    const rMonth = document.getElementById('r-month');
    const rYear = document.getElementById('r-year');
    const rTime = document.getElementById('r-time');

    const driver = document.getElementById('driver');
    const gas = document.getElementById('gas');
    const box = document.getElementById('box');
    const seat = document.getElementById('seat');

    const proof = document.getElementById('proof');
    

    // Cancel button
    document.getElementById('cancel_rent').onclick = () => {
        document.getElementById('renting_process_modal').classList.add('hidden');
    };

    // Step 1 ↔ 2
    document.getElementById('onetotwo').onclick = () => {
        carInfo.classList.add('hidden');
        perInfo.classList.remove('hidden');
    };
    document.getElementById('twotoone').onclick = () => {
        perInfo.classList.add('hidden');
        carInfo.classList.remove('hidden');
    };

    // Step 2 ↔ 3
    document.getElementById('twotothree').onclick = () => {

        if(!fullname.value){
            alert('Enter your fullname.');
            return;
        }

        if(!email.value){
            alert('Enter your email address.');
            return;
        }

        if(!phone.value){
            alert('Enter your phone number.');
            return;
        }

        perInfo.classList.add('hidden');
        rentInfo.classList.remove('hidden');

    };
    document.getElementById('threetotwo').onclick = () => {
        rentInfo.classList.add('hidden');
        perInfo.classList.remove('hidden');
    };

    // Step 3 ↔ 4
    document.getElementById('threetofour').onclick = () => {
    

        if(!document.getElementById('p-day').value || !document.getElementById('p-month').value || !document.getElementById('p-year').value){
            alert('Pick-up date is incomplete');
            return;
        }

        if(!document.getElementById('p-time').value){
            alert('Select Pick-up time.');
            return;
        }

        if(!document.getElementById('r-day').value || !document.getElementById('r-month').value || !document.getElementById('r-year').value){
            alert('Return date is incomplete');
            return;
        }

        if(!document.getElementById('r-time').value){
            alert('Select Return time.');
            return;
        }


        if(!validateDates()){
            return;
        }


        rentInfo.classList.add('hidden');
        addInfo.classList.remove('hidden');
    };
    document.getElementById('fourtothree').onclick = () => {
        addInfo.classList.add('hidden');
        rentInfo.classList.remove('hidden');
    };

    let totalTotal = 0;

    // Step 4 ↔ 5
    document.getElementById('fourtofive').onclick = () => {

        const pickupDate = new Date(`${pYear.value}-${pMonth.value}-${pDay.value}T${pTime.value}:00`);
        const returnDate = new Date(`${rYear.value}-${rMonth.value}-${rDay.value}T${rTime.value}:00`);

        const diffInMs = returnDate - pickupDate;
        const diffInHours = diffInMs / (1000 * 60 * 60);

        let carCost = Number(document.getElementById('confirm_rent').getAttribute('data-price')) * diffInHours;
        let driverCost = 100 * diffInHours;
        
        let total = carCost + driverCost + (gas.checked ? 1000 : 0) + (box.checked ? 500 : 0) + (seat.checked ? 300 : 0);

        totalTotal = total;

        document.getElementById('summary_content').innerHTML = `
            <div class="grid grid-cols-2">
                <p>Car Selected</p>
                <p class="text-right">${document.getElementById('confirm_rent').getAttribute('data-name')}</p>
                <p>Pick-up D/T</p>
                <p class="text-right">${pMonth.value}-${pDay.value}-${pYear.value} ${pTime.value}:00</p>
                <p>Return D/T</p>
                <p class="text-right">${rMonth.value}-${rDay.value}-${rYear.value} ${rTime.value}:00</p>
                <p>Total Hours</p>
                <p class="text-right">${diffInHours}</p>
            </div>

            <hr class='border border-black'>

            <div class="grid grid-cols-2">
                <p>Car</p>
                <p class="text-right">₱ ${carCost.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</p>
                ${!driver.checked ? "" : `
                    <p>Driver</p>
                    <p class="text-right">₱ ${driverCost.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</p>
                `}
                ${!gas.checked ? "" : `
                    <p>Extra Gas</p>
                    <p class="text-right">₱ 1,000.00</p>
                `}
                ${!box.checked ? "" : `
                    <p>Roof Box</p>
                    <p class="text-right">₱ 500.00</p>
                `}
                ${!seat.checked ? "" : `
                    <p>Child Seat</p>
                    <p class="text-right">₱ 300.00</p>
                `}
            </div>

            <div class="grid grid-cols-2 font-semibold text-lg">
                <p class="">Total Cost:</p>
                <p class="text-blue-500 text-right">₱ ${total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</p>
            </div>
        `

        addInfo.classList.add('hidden');
        summary.classList.remove('hidden');
    };
    document.getElementById('fivetofour').onclick = () => {
        summary.classList.add('hidden');
        addInfo.classList.remove('hidden');
    };

    // Step 5 ↔ 6
    document.getElementById('fivetosix').onclick = () => {
        summary.classList.add('hidden');
        terms.classList.remove('hidden');
    };
    document.getElementById('sixtofive').onclick = () => {
        terms.classList.add('hidden');
        summary.classList.remove('hidden');
    };

    // Step 6 ↔ 7
    document.getElementById('sixtoseven').onclick = () => {

        if(!agreeTerms.checked){
            alert('You must agree to our Terms and Conditions to use our service.');
            return;
        }

        const proofInput = document.getElementById('proof');
        const proofLabel = document.querySelector('label[for="proof"]');

        proofInput.addEventListener('change', () => {
            if (proofInput.files.length > 0) {
                proofLabel.classList.add('bg-blue-500', 'text-white');
            } else {
                proofLabel.classList.remove('bg-blue-500', 'text-white');
            }
        });

        document.getElementById('payment_text').innerHTML = `
                <p class="text-sm text-gray-500 mb-5">Send your payment using one of the online platforms below.
                You may choose to pay the full amount of ₱<span id="onehundred" class="text-blue-500">${totalTotal}</span> or a 20% deposit of ₱<span id="twenty" class="text-blue-500">${totalTotal * 0.2}</span> to secure your reservation.
                After payment, please upload 1 image as your proof of payment for verification by our administrator.</p>
        `


        terms.classList.add('hidden');
        paymentInfo.classList.remove('hidden');
    };
    document.getElementById('seventosix').onclick = () => {
        paymentInfo.classList.add('hidden');
        terms.classList.remove('hidden');
    };

    // Step 7 ↔ 8 (Final)
    document.getElementById('seventoeight').onclick = () => {

        if(!document.getElementById('proof').files.length > 0){
            alert('Please upload a proof of payment before proceeding.');
            return;
        }

        paymentInfo.classList.add('hidden');
        final.classList.remove('hidden');
    };
    document.getElementById('eighttoseven').onclick = () => {
        final.classList.add('hidden');
        paymentInfo.classList.remove('hidden');
    };

    document.getElementById('confirm_rent').onclick = e => {

        const car = e.currentTarget.getAttribute('data-id');

        const formData = new FormData();

        formData.append('addRent', 'true');
        formData.append('car', car);
        formData.append('fullname', fullname.value);
        formData.append('email', email.value);
        formData.append('phone', phone.value);

        formData.append('driver', driver.checked);
        formData.append('gas', gas.checked);
        formData.append('box', box.checked);
        formData.append('seat', seat.checked);

        formData.append('pickupdt', `${pYear.value}-${pMonth.value}-${pDay.value} ${pTime.value}:00`);
        formData.append('returndt', `${rYear.value}-${rMonth.value}-${rDay.value} ${rTime.value}:00`);

        formData.append('total', totalTotal);

        if (proof.files.length > 0) {
            formData.append('proof', proof.files[0]);
        }


        fetch('z_user.php', {method: 'POST',body: formData})
        .then(response => response.text())
        .then(data =>{
            console.log( "Rent Request: ",data);

            if(!data){
                alert('Something went wrong.');
                return;
            }

            document.getElementById('closing_text').innerHTML = `
                <h1 class="font-semibold">Your rental has been successfully submitted!</h1>
                <p>A confirmation email with your rental details and receipt will be sent to <span class="text-blue-500">${email.value}</span> email address.
                    Thank you for choosing our service — we look forward to serving you!
                </p>
            `

            final.classList.add('hidden');
            closing.classList.remove('hidden');

        })
        .catch(error => {console.error('Error Message!', error)})

    }

    document.getElementById('closing_close').onclick = () => {
        closing.classList.add('hidden');
        document.getElementById('renting_process_modal').classList.add('hidden');
    }



}
rentProcess();

//PAYMENT TABS AND PAGE
const paytabs = document.querySelectorAll('.payment_tab');
const paypages = document.querySelectorAll('.payment_page');
paytabs.forEach((tab, index) => {
    tab.addEventListener('click', ()=>{
        paytabs.forEach(tab=>{
            tab.classList.remove('bg-blue-500');
            tab.classList.remove('text-white');
        });
        tab.classList.add('bg-blue-500');
        tab.classList.add('text-white');

        paypages.forEach(page=>{
            page.classList.add('hidden');
        })
        paypages[index].classList.remove('hidden');
    })
}) 

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
                    img.classList.remove("ring-4", "ring-blue-400");
                });

                
                img.classList.add("ring-4", "ring-blue-400");

                
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

