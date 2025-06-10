//Sign up
if(document.getElementById('signup_btn')){
    document.getElementById('signup_btn').onclick = () => {

        const info = {
            signUp: true,
            firstname: document.getElementById('new_fname').value,
            lastname: document.getElementById('new_lname').value,
            gender: document.getElementById('new_gender').value,
            email: document.getElementById('new_email').value,
            phone: document.getElementById('new_phone').value,
            username: document.getElementById('new_user').value,
            password: document.getElementById('new_pass').value
        }

        for(let i in info){

            if(!info[i]){
                alert('Please fill out all the required fields.');
                return;
            }

        }

        if(document.getElementById('new_pass').value != document.getElementById('new_repass').value){
            alert('Passwords do not match.');
            return;
        }

        fetch('z_acc.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
        .then(response => response.json())
        .then(data =>{
            console.log( "New Account: ",data);

            if(data.result){

                document.getElementById('new_fname').value = "";
                document.getElementById('new_lname').value = "";
                document.getElementById('new_gender').value = "";
                document.getElementById('new_email').value = "";
                document.getElementById('new_phone').value = "";
                document.getElementById('new_user').value = "";
                document.getElementById('new_pass').value = "";
                document.getElementById('new_repass').value = "";


                if(window.confirm('Sign up successful! Would you like to sign in now?')){
                    location.href = 'signin.html';
                }
            }else{
                alert(data.message);
            }

            
        })
        .catch(error => {console.error('Error Message!', error)});



    }
}

//Sign In
if(document.getElementById('signin_btn')){
    document.getElementById('signin_btn').onclick = () => {
    
        const username = document.getElementById('username');
        const password = document.getElementById('password');

        if(!username.value || !password.value){
            alert('Please fill out all the required fields.');
            return;
        }

        const info = {
            signIn: true,
            username: username.value,
            password: password.value
        }

        fetch('z_acc.php', {method: 'POST',headers: {'Content-Type': 'application/json'},body: JSON.stringify(info)})
        .then(response => response.json())
        .then(data =>{
            console.log( "Sign In: ",data);

            if(data.result){
                
                if(data.role == "admin"){
                    location.href = 'admin.php';
                }else{
                    location.href = 'user.php';
                }

            }else{
                alert(data.message);
            }

        })
        .catch(error => {console.error('Error Message!', error)})


    }
}
