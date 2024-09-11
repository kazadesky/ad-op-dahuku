const passwordShow = (event) => {
    event.preventDefault();
    const inputPassword = document.getElementById("password");
    const iconInput = document.getElementById("icon");

    if (inputPassword.type === "password") {
        inputPassword.type = "text";
        iconInput.innerText = "visibility_off";
        event.classList = "text-sky-600";
    } else {
        inputPassword.type = "password";
        iconInput.innerText = "visibility";
    }
};
