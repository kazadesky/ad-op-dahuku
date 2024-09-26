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
    const modalFilter = document.getElementById("modal-filter");

    if (sidebar) {
        sidebar.classList.add('active');
        dropdown.classList.add('hidden');
        modalFilter.classList.add('hidden');
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
        modalFilter.classList.add('hidden');
    } else {
        dropdown.classList.remove('flex');
        dropdown.classList.add('hidden');
    }
};

const bannerAlert = document.getElementById('banner-alert');
setTimeout(() => {
    bannerAlert.classList.add("hidden");
}, 5000);

const modalGetPayment = (event) => {
    event.preventDefault();

    const modalFilter = document.getElementById("modal-filter");
    const dropdown = document.getElementById('dropdown-nav');
    const sidebar = document.getElementById('sidebar');
    if (modalFilter.classList.contains("hidden")) {
        modalFilter.classList.remove("hidden");
        modalFilter.classList.add("flex");
        dropdown.classList.add("hidden");
        sidebar.classList.remove("active");
    } else {
        modalFilter.classList.remove("flex");
        modalFilter.classList.add("hidden");
    }
}

const formattedPriceInput = document.getElementById('formattedPrice');
const rawPriceInput = document.getElementById('price');

// Fungsi untuk memformat angka ke dalam format Rupiah dengan titik sebagai pemisah ribuan
function formatRupiah(value) {
    let numberString = value.replace(/[^,\d]/g, '').toString(),
        split = numberString.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
}

// Event listener untuk mengubah input menjadi format Rupiah
formattedPriceInput.addEventListener('input', function (e) {
    let value = e.target.value;

    // Format angka menjadi Rupiah dengan titik
    formattedPriceInput.value = formatRupiah(value);

    // Ambil nilai asli tanpa titik dan simpan di input hidden
    rawPriceInput.value = value.replace(/[^0-9]/g, '');
});
