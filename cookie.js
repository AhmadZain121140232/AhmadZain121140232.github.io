function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (minutes * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}


function saveToLocalStorage(data) {
    localStorage.setItem('userData', JSON.stringify(data));
}

function getFromLocalStorage() {
    var storedData = localStorage.getItem('userData');
    return storedData ? JSON.parse(storedData) : null;
}

function removeFromLocalStorage() {
    localStorage.removeItem('userData');
}

var userDataFromCookie = getCookie('userData');
var userDataFromLocalStorage = getFromLocalStorage();

var userData = userDataFromCookie ? JSON.parse(userDataFromCookie) : userDataFromLocalStorage;

if (userData) {
    document.getElementById('nama').value = userData.nama;
    document.getElementById('nim').value = userData.nim;
    document.getElementById('no_telepon').value = userData.no_telepon;

    var kelaminElement = document.getElementById(userData.kelamin);
    if (kelaminElement) {
        kelaminElement.checked = true;
    } else {
        console.error('Elemen dengan ID ' + userData.kelamin + ' tidak ditemukan.');
    }
}

document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault();

    setCookie('userData', JSON.stringify({
        nama: document.getElementById('nama').value,
        nim: document.getElementById('nim').value,
        no_telepon: document.getElementById('no_telepon').value,
        kelamin: document.querySelector('input[name="kelamin"]:checked').value
    }), 5);  

    saveToLocalStorage({
        name: document.getElementById('nama').value,
        nim: document.getElementById('nim').value,
        no_telepon: document.getElementById('no_telepon').value,
        kelamin: document.querySelector('input[name="kelamin"]:checked').value
    });

});

