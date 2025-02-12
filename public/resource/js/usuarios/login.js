document.getElementById("togglePassword").addEventListener("click", function() {
    let passwordField = document.getElementById("password");
    passwordField.type = passwordField.type === "password" ? "text" : "password";
});