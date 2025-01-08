
//Cambia il form da login a signup e viceversa.
function goToSignUpForm() {
    document.querySelector("main.login-form section.login").classList.add("hidden");
    document.querySelector("main.login-form section.signup").classList.remove("hidden");
}