const passwordShow = (event) => {
    event.preventDefault();
    const inputPassword = document.getElementById("password");
    const iconInput = document.getElementById("icon_pass");

    if (inputPassword.type === "password") {
        inputPassword.type = "text";
        iconInput.innerText = "visibility_off";
        event.classList = "text-sky-600";
    } else {
        inputPassword.type = "password";
        iconInput.innerText = "visibility";
    }
};

const passwordConfirmShow = (event) => {
    event.preventDefault();
    const inputPassword = document.getElementById("password_confirmation");
    const iconInput = document.getElementById("icon_confirm");

    if (inputPassword.type === "password") {
        inputPassword.type = "text";
        iconInput.innerText = "visibility_off";
        event.classList = "text-sky-600";
    } else {
        inputPassword.type = "password";
        iconInput.innerText = "visibility";
    }
};

const profilePreview = (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function (event) {
        document.getElementById('preview').src = event.target.result;
        const previewFigure = document.getElementById('preview-figure')
        previewFigure.classList.remove("hidden");
        previewFigure.classList.add("flex");
    };
    reader.readAsDataURL(file);
}

const showMenu = (event) => {
    event.preventDefault();
    const sidebar = document.getElementById('sidebar');
    const dropdown = document.getElementById('dropdown-nav');
    const modalFilter = document.getElementById("modal-filter");

    if (sidebar) {
        sidebar.classList.add('active');
        dropdown.classList.add('hidden');
        // modalFilter.classList.add('hidden');
    }
}

const hideMenu = () => {
    document.getElementById('sidebar').classList.remove('active');
}

const toggleDropdown = (event) => {
    event.preventDefault();
    const dropdown = document.getElementById('dropdown-nav');
    const sidebar = document.getElementById('sidebar');
    const modalFilter = document.getElementById("modal-filter");
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        dropdown.classList.add('flex');
        sidebar.classList.remove('active');
        // modalFilter.classList.add('hidden');
    } else {
        dropdown.classList.remove('flex');
        dropdown.classList.add('hidden');
    }
};

const bannerAlert = document.getElementById('banner-alert');
if (bannerAlert && !bannerAlert.classList.contains('hidden')) {
    setTimeout(() => {
        bannerAlert.classList.add("hidden");
    }, 5000);
}

const alertDanger = document.querySelector('#alert-danger');
if (alertDanger && !alertDanger.classList.contains('hidden')) {
    setTimeout(() => {
        alertDanger.classList.add('hidden');
    }, 5000);
}

const modalGetPayment = (event) => {
    event.preventDefault();

    const modalFilter = document.getElementById("modal-filter");
    const modalExport = document.getElementById("modal-export");
    const dropdown = document.getElementById('dropdown-nav');
    const sidebar = document.getElementById('sidebar');
    if (modalFilter.classList.contains("hidden")) {
        modalFilter.classList.remove("hidden");
        modalFilter.classList.add("flex");
        modalExport.classList.add("hidden");
        dropdown.classList.add("hidden");
        sidebar.classList.remove("active");
    } else {
        modalFilter.classList.remove("flex");
        modalFilter.classList.add("hidden");
    }
}

const showModalSearch = (event) => {
    event.preventDefault();

    const modalSearch = document.getElementById("modal-search");
    const modalFilter = document.getElementById("modal-filter");
    const dropdown = document.getElementById('dropdown-nav');
    const sidebar = document.getElementById('sidebar');
    if (modalSearch.classList.contains("hidden")) {
        modalSearch.classList.remove("hidden");
        modalSearch.classList.add("flex");
        modalFilter.classList.add("hidden");
        dropdown.classList.add("hidden");
        sidebar.classList.remove("active");
    } else {
        modalSearch.classList.remove("flex");
        modalSearch.classList.add("hidden");
    }
}
const modalGetExport = (event) => {
    event.preventDefault();

    const modalExport = document.getElementById("modal-export");
    const modalFilter = document.getElementById("modal-filter");
    const dropdown = document.getElementById('dropdown-nav');
    const sidebar = document.getElementById('sidebar');
    if (modalExport.classList.contains("hidden")) {
        modalExport.classList.remove("hidden");
        modalExport.classList.add("flex");
        modalFilter.classList.add("hidden");
        dropdown.classList.add("hidden");
        sidebar.classList.remove("active");
    } else {
        modalExport.classList.remove("flex");
        modalExport.classList.add("hidden");
    }
}

const showModalArchive = (event) => {
    event.preventDefault();

    const modalArchive = document.getElementById("modal-archive");
    const dropdown = document.getElementById('dropdown-nav');
    const sidebar = document.getElementById('sidebar');
    if (modalArchive.classList.contains("hidden")) {
        modalArchive.classList.remove("hidden");
        modalArchive.classList.add("flex");
        dropdown.classList.add("hidden");
        sidebar.classList.remove("active");
    } else {
        modalArchive.classList.remove("flex");
        modalArchive.classList.add("hidden");
    }
}

const showChangePhoto = (event) => {
    event.preventDefault();

    const modalChange = document.getElementById("modal-change-photo");
    const modalAccount = document.getElementById("modal-change-profile");
    const dropdown = document.getElementById('dropdown-nav');
    const sidebar = document.getElementById('sidebar');
    if (modalChange.classList.contains("hidden")) {
        modalChange.classList.remove("hidden");
        modalChange.classList.add("flex");
        modalAccount.classList.add("hidden");
        dropdown.classList.add("hidden");
        sidebar.classList.remove("active");
    } else {
        modalChange.classList.remove("flex");
        modalChange.classList.add("hidden");
    }
}

const showChangeProfile = (event) => {
    event.preventDefault();

    const modalAccount = document.getElementById("modal-change-profile");
    const modalChange = document.getElementById("modal-change-photo");
    const dropdown = document.getElementById('dropdown-nav');
    const sidebar = document.getElementById('sidebar');
    if (modalAccount.classList.contains("hidden")) {
        modalAccount.classList.remove("hidden");
        modalAccount.classList.add("flex");
        modalChange.classList.add("hidden");
        dropdown.classList.add("hidden");
        sidebar.classList.remove("active");
    } else {
        modalAccount.classList.remove("flex");
        modalAccount.classList.add("hidden");
    }
}
