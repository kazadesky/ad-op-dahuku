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

const showMenu = (event) => {
    event.preventDefault();
    const sidebar = document.getElementById('sidebar');
    const dropdown = document.getElementById('dropdown-nav');
    if(sidebar){
        sidebar.classList.add('active');
        dropdown.classList.add('hidden');
    }
}

const hideMenu = () => {
    document.getElementById('sidebar').classList.remove('active');
}

const toggleDropdown = (event) => {
    event.preventDefault();
    const dropdown = document.getElementById('dropdown-nav');
    const sidebar = document.getElementById('sidebar');
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        dropdown.classList.add('flex');
        sidebar.classList.remove('active');
    } else {
        dropdown.classList.remove('flex');
        dropdown.classList.add('hidden');
    }
};
