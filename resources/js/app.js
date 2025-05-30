import './bootstrap';
import 'flowbite';
import '@fortawesome/fontawesome-free/css/all.min.css';
import Alpine from 'alpinejs';
import { initFlowbite } from 'flowbite';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initFlowbite();
});
