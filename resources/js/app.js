import Alpine from 'alpinejs';

import { initTagManager } from './tags';
import { initComments } from './comments';
import { initMemberManager } from './members';
import { initIssueFilters } from './issue-filters';
import { initColorPicker } from './color-picker';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form').forEach((form) => {
        form.noValidate = true;
    });

    initTagManager();
    initComments();
    initMemberManager();
    initIssueFilters();
    initColorPicker();
});
