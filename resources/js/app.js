import Alpine from 'alpinejs';

import { initTagManager } from './tags';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initTagManager();
});
