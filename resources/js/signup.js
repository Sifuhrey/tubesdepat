const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword');
const mismatchIcon = document.getElementById('exclamation')
const showConfirm = document.getElementById('triggerconfirm')
const showPass = document.getElementById('triggerpass')


confirmPasswordInput.addEventListener('input', function(){
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if(password !== confirmPassword){
        mismatchIcon.style.display = 'inline';
    }else{
        mismatchIcon.style.display = 'none';
    }
})

showPass.addEventListener('change', function(){
    const imagePass = document.getElementById('passicon')

    if(passwordInput.type === "password"){
        passwordInput.type = "text"
        imagePass.src = "storage/assets/show.png"
    }else{
        passwordInput.type = "password"
        imagePass.src = "storage/assets/invisible.png"
    }

})
showConfirm.addEventListener('change', function(){
    const imagePass = document.getElementById('confirmicon')

    if(confirmPasswordInput.type === "password"){
        confirmPasswordInput.type = "text"
        imagePass.src = "storage/assets/show.png"
    }else{
        confirmPasswordInput.type = "password"
        imagePass.src = "storage/assets/invisible.png"
    }

})
document.getElementById('signupform').addEventListener("submit", function(event) {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;


    if (password !== confirmPassword) {
        alert("Error: Passwords do not match.");
        event.preventDefault(); // Prevent form submission
    }
});