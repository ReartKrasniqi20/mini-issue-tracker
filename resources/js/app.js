import Alpine from 'alpinejs';

import { initTagManager } from './tags';
import { initComments } from './comments';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initTagManager();
    initComments();
});
