require('./bootstrap');

import axios from 'axios';
import Swal from 'sweetalert2';

window.Swal = Swal;

// Get the CSRF token from the <meta> tag
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

// Set the CSRF token as a default header for Axios
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;