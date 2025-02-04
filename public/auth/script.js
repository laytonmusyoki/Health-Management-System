const ShowPasswordCheck=document.getElementById('showPassword');
const passwordInput = document.getElementById('password');
const passwordsInput = document.getElementById('passwords');

ShowPasswordCheck.addEventListener('change', function(){
    if(ShowPasswordCheck.checked){
        passwordInput.type='text';
        passwordsInput.type='text';
    }else{
        passwordInput.type='password';
        passwordsInput.type='password';
    }
});
