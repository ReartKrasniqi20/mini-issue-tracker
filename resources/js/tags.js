import { request } from './csrf';

function renderBadges(container, checkboxes) {
    const checked = [...checkboxes].filter((cb) => cb.checked);

    if (checked.length === 0) {
        container.innerHTML = '<span class="text-sm text-gray-400">No tags</span>';
        return;
    }

    container.innerHTML = '';
    checked.forEach((cb) => {
        const span = document.createElement('span');
        span.className = 'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium text-white';
        span.style.backgroundColor = cb.dataset.tagColor || '#6b7280';
        span.textContent = cb.dataset.tagName;
        container.appendChild(span);
    });
}

export function initTagManager() {
    const manager = document.getElementById('tag-manager');
    if (!manager) return;

    const issueId = manager.dataset.issueId;
    const badges = document.getElementById('issue-tags');
    const checkboxes = manager.querySelectorAll('.tag-checkbox');

    checkboxes.forEach((cb) => {
        cb.addEventListener('change', async () => {
            cb.disabled = true;
            try {
                if (cb.checked) {
                    await request(`/issues/${issueId}/tags`, {
                        method: 'POST',
                        body: JSON.stringify({ tag_id: cb.dataset.tagId }),
                    });
                } else {
                    await request(`/issues/${issueId}/tags/${cb.dataset.tagId}`, {
                        method: 'DELETE',
                    });
                }
                renderBadges(badges, checkboxes);
            } catch (e) {
                cb.checked = !cb.checked; // revert on failure
            } finally {
                cb.disabled = false;
            }
        });
    });
}
