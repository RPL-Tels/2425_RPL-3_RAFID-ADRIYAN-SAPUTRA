document.addEventListener('DOMContentLoaded', function() {
    const logButton = document.getElementById('logButton');
    const logPopup = document.getElementById('logPopup');
    const popupOverlay = document.getElementById('popupOverlay');
    const formConfirmButton2 = document.getElementById('formConfirmButton2');
    const formCancelButton2 = document.getElementById('formCancelButton2');
    logButton.addEventListener('click', function(event) {
        event.preventDefault();
        popupOverlay.style.display = 'block';
        logPopup.style.display = 'block';
    });
    formConfirmButton2.addEventListener('click', function() {
        popupOverlay.style.display = 'none';
        logPopup.style.display = 'none';
        document.getElementById('logForm').submit();
    });
    formCancelButton2.addEventListener('click', function() {
        popupOverlay.style.display = 'none';
        logPopup.style.display = 'none';
    });
});