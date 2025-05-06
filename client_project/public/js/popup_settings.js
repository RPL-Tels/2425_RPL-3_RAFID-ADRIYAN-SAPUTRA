document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('myForm');
    const formPopup = document.getElementById('formPopup');
    const popupOverlay = document.getElementById('popupOverlay');
    const mobile = document.getElementById('mobileForm');

    const formConfirmButton = document.getElementById('formConfirmButton');
    const formCancelButton = document.getElementById('formCancelButton');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        popupOverlay.style.display = 'block';
        formPopup.style.display = 'block';
    });
    mobile.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form dikirim langsung
        popupOverlay.style.display = 'block';
        formPopup.style.display = 'block';
    });
    formConfirmButton.addEventListener('click', function() {
        popupOverlay.style.display = 'none';
        formPopup.style.display = 'none';
        form.submit(); // Kirim form jika pengguna mengonfirmasi
    });

    formCancelButton.addEventListener('click', function() {
        popupOverlay.style.display = 'none';
        formPopup.style.display = 'none';
    });
});