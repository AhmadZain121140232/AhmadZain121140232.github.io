document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('input[type="submit"]');

    let no_teleponInput = document.getElementById("no_telepon");
    const nama = document.getElementById("nama");
    const nim = document.getElementById("nim");
    let kelamin

    const kelaminRadioButtons = document.querySelectorAll('input[name="kelamin"]');
    kelaminRadioButtons.forEach(function (radio) {
        radio.addEventListener("change", function () {
            kelamin = radio.value
            handleRadioButtonChange();
        });
    });

    form.addEventListener("click", function (event) {
        event.preventDefault(); 

        handleFormSubmission();

        nama.value = "";
        nim.value = "";
        no_teleponInput.value = "";
        kelaminRadioButtons.forEach(function (radio) {
            radio.checked = false;
        });
    });

    function handleFormSubmission() {
        const nama = document.getElementById("nama").value;
        const nim = document.getElementById("nim").value;


        if (nama === "" || nim === "") {
            alert("Nama dan nim diperlukan!");
            return;
        }

        console.log("nama: ", nama);
        console.log("nim: ", nim);
        console.log("kelamin: ", kelamin);

        fetch('post.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `nama=${encodeURIComponent(nama)}&nim=${encodeURIComponent(nim)}&no_telepon=${encodeURIComponent(no_teleponInput.value)}&kelamin=${encodeURIComponent(kelamin)}`,
        })
            .then(response => response.json())
            .then(data => {
                alert('Data berhasil ditambahkan')
                console.log('Server Response:', data);
            })
            .catch(error => console.error('Error sending data to PHP:', error));
    }

    function handleRadioButtonChange() {
        alert("Radio button changed");
    }

    
});
