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
                location.href = 'admin.php';
            }else{
                alert('Something went wrong..');
            }

        })
        .catch(error => {console.error('Error Message!', error)})


    }
}
