import 'babel-polyfill'
import axios from 'axios'

window.axios = axios;

axios.defaults.headers.common = {
    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    'X-Requested-With': 'XMLHttpRequest',
    'Content-Type': 'application/json',
    'Authorization': 'Bearer ' + localStorage.token,
};

