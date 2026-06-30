import { request } from './csrf';

function clearErrors(form) {
    form.querySelectorAll('[data-error]').forEach((el) => {
        el.textContent = '';
        el.classList.add('hidden');
    });
    form.querySelectorAll('.input-invalid').forEach((el) => el.classList.remove('input-invalid'));
}

function showErrors(form, errors) {
    Object.entries(errors).forEach(([field, messages]) => {
        const el = form.querySelector(`[data-error="${field}"]`);
        if (el) {
            el.textContent = messages[0];
            el.classList.remove('hidden');
        }

        const input = form.querySelector(`[name="${field}"]`);
        if (input) input.classList.add('input-invalid');
    });
}

export function initComments() {
    const root = document.getElementById('comments');
    if (!root) return;

    const issueId = root.dataset.issueId;
    const list = document.getElementById('comments-list');
    const loadMoreBtn = document.getElementById('load-more-comments');
    const emptyMsg = document.getElementById('comments-empty');
    const countEl = document.getElementById('comments-count');
    const form = document.getElementById('comment-form');

    let nextPage = 1;

    async function loadPage(page) {
        const data = await request(`/issues/${issueId}/comments?page=${page}`);
        list.insertAdjacentHTML('beforeend', data.html);
        nextPage = data.next_page;
        loadMoreBtn.classList.toggle('hidden', !nextPage);
        countEl.textContent = data.total;
        emptyMsg.classList.toggle('hidden', data.total > 0);
    }

    loadMoreBtn.addEventListener('click', () => {
        if (nextPage) loadPage(nextPage);
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearErrors(form);

        const submitBtn = form.querySelector('button');
        submitBtn.disabled = true;

        try {
            const data = await request(`/issues/${issueId}/comments`, {
                method: 'POST',
                body: JSON.stringify({
                    body: form.body.value,
                }),
            });

            list.insertAdjacentHTML('afterbegin', data.html); // prepend new comment
            form.reset();                                       // clear the form
            countEl.textContent = data.total;
            emptyMsg.classList.add('hidden');
        } catch (err) {
            if (err.status === 422 && err.data?.errors) {
                showErrors(form, err.data.errors);              // inline errors, no alert
            }
        } finally {
            submitBtn.disabled = false;
        }
    });

    loadPage(1); // initial AJAX load
}
