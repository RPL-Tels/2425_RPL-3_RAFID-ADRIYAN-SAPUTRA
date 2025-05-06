  import './bootstrap';
  import {init3DViewer} from './3dview';
  import Alpine from 'alpinejs';

  // import Dropzone from "dropzone";
  // window.Dropzone = Dropzone;

  window.Alpine = Alpine;

  Alpine.start();

  // resources/js/app.js

  document.addEventListener('DOMContentLoaded', () => {
    const viewerContainerId = 'kotak'; // ID dari elemen HTML container
    const modelUrl = window.modelUrl; // URL model 3D dari server (dikirim oleh Blade)

    if (document.getElementById(viewerContainerId) && modelUrl) {
        init3DViewer(viewerContainerId, modelUrl);
    }
  });

  document.addEventListener('DOMContentLoaded', () => {
      const viewerContainers = document.querySelectorAll('[id^="kotak"]');

      viewerContainers.forEach(container => {
          const modelUrl = container.getAttribute('data-model-url');

          if (container && modelUrl) {
              init3DViewer(container.id, modelUrl);
          }
      });
  });

  // Kode dark mode
  const toggleDarkMode = document.getElementById('toggleDarkMode');
  const moonIcon = document.getElementById('moonIcon');
  const sunIcon = document.getElementById('sunIcon');
  const moonIcon2 = document.getElementById('moonIcon2');
  const sunIcon2 = document.getElementById('sunIcon2');
  const logo1 = document.getElementById('logo1');
  const logo2 = document.getElementById('logo2');
  const html = document.querySelector('html');
  const default1 = document.getElementById('default1');
  const default2 = document.getElementById('default2');
  const default3 = document.getElementById('default3');
  const default4 = document.getElementById('default4');
  const default5 = document.getElementById('default5');
  const default6 = document.getElementById('default6');
  const default7 = document.getElementById('default7');
  const default8 = document.getElementById('default8');  

  // Fungsi untuk mengaktifkan dark mode
  function enableDarkMode() {
    document.body.classList.add('dark');
    sunIcon.classList.remove('hidden');
    moonIcon.classList.add('hidden');
    sunIcon2.classList.remove('hidden');
    moonIcon2.classList.add('hidden');
    logo2.classList.remove('hidden');
    logo1.classList.add('hidden');
    localStorage.setItem('theme', 'dark'); // Simpan preferensi pengguna
    html.classList.add('dark');
    default1.classList.add('hidden');
    default2.classList.remove('hidden');
    default3.classList.add('hidden');
    default4.classList.remove('hidden');
    default5.classList.add('hidden');
    default6.classList.remove('hidden');
    default7.classList.add('hidden');
    default8.classList.remove('hidden');    
  }

  // Fungsi untuk menonaktifkan dark mode
  function disableDarkMode() {
    document.body.classList.remove('dark');
    sunIcon.classList.add('hidden');
    moonIcon.classList.remove('hidden');
    sunIcon2.classList.add('hidden');
    moonIcon2.classList.remove('hidden');
    logo1.classList.remove('hidden');
    logo2.classList.add('hidden');
    localStorage.setItem('theme', 'light'); // Simpan preferensi pengguna
    html.classList.remove('dark');
    default1.classList.remove('hidden');
    default2.classList.add('hidden');
    default3.classList.remove('hidden');
    default4.classList.add('hidden');
    default5.classList.remove('hidden');
    default6.classList.add('hidden');
    default7.classList.remove('hidden');
    default8.classList.add('hidden');
  }

  // Toggle antara light dan dark mode
  if (toggleDarkMode) {
    toggleDarkMode.addEventListener('click', () => {
      if (document.body.classList.contains('dark')) {
        disableDarkMode();
      } else {
        enableDarkMode();
      }
    });
  }

  const toggleDarkMode2 = document.getElementById('toggleDarkMode2')
  if (toggleDarkMode2) {
    toggleDarkMode2.addEventListener('click', () => {
      if (document.body.classList.contains('dark')) {
        disableDarkMode();
      } else {
        enableDarkMode();
      }
    });
  }

  // Memeriksa preferensi pengguna saat halaman dimuat
  if (localStorage.getItem('theme') === 'dark') {
    enableDarkMode(); // Jika sebelumnya mode gelap, aktifkan
  } else {
    disableDarkMode(); // Jika tidak, mode terang
  }

