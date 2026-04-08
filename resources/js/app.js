import Swal from 'sweetalert2';
window.Swal = Swal; // Hacemos que esté disponible globalmente

import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
