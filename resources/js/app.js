import './bootstrap';
import axios from 'axios';
import Alpine from 'alpinejs';
import MyanmarCities from '@bilions/myanmar-cities';
import Swal from 'sweetalert2';

window.Alpine = Alpine;

Alpine.start();

window.Swal = Swal;

window.MyanmarCities = MyanmarCities;

// Get the CSRF token from the <meta> tag
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

// Set the CSRF token as a default header for Axios
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
