import Alpine from 'alpinejs';

import { initTagManager } from './tags';
import { initComments } from './comments';
import { initMemberManager } from './members';
import { initIssueFilters } from './issue-filters';
import { initColorPicker } from './color-picker';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    // Defer to server-side validation everywhere; skip native browser popups
    // so our own red field styling + messages are what the user sees.
    document.querySelectorAll('form').forEach((form) => {
        form.noValidate = true;
    });

    initTagManager();
    initComments();
    initMemberManager();
    initIssueFilters();
    initColorPicker();
});
