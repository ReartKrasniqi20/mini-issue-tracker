export function initClickableRows() {
    document.addEventListener('click', (event) => {
        if (event.target.closest('a, button, input, select, textarea, label, form')) {
            return;
        }

        const row = event.target.closest('[data-row-href]');
        if (!row) return;

        const href = row.dataset.rowHref;

        if (event.metaKey || event.ctrlKey) {
            window.open(href, '_blank');
        } else {
            window.location = href;
        }
    });
}
