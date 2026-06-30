import Alpine from 'alpinejs';

import { initTagManager } from './tags';
import { initComments } from './comments';
import { initMemberManager } from './members';
import { initIssueFilters } from './issue-filters';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initTagManager();
    initComments();
    initMemberManager();
    initIssueFilters();
});
