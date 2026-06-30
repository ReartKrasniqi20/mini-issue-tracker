import { request } from './csrf';

function debounce(fn, delay) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => fn(...args), delay);
    };
}

export function initIssueFilters() {
    const form = document.getElementById('issue-filters');
    if (!form) return;

    const list = document.getElementById('issue-list');

    async function refresh() {
        const params = new URLSearchParams(new FormData(form)).toString();
        try {
            const data = await request(`${form.action}?${params}`);
            list.innerHTML = data.html;
        } catch (e) {
        }
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        refresh();
    });

    form.querySelector('[name="q"]')?.addEventListener('input', debounce(refresh, 300));

    form.querySelectorAll('select').forEach((select) => {
        select.addEventListener('change', refresh);
    });
}
