import { request } from './csrf';

function renderMembers(container, checkboxes) {
    const checked = [...checkboxes].filter((cb) => cb.checked);

    if (checked.length === 0) {
        container.innerHTML = '<span class="text-sm text-gray-400">No members</span>';
        return;
    }

    container.innerHTML = '';
    checked.forEach((cb) => {
        const span = document.createElement('span');
        span.className = 'inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs text-gray-700';
        span.textContent = cb.dataset.userName;
        container.appendChild(span);
    });
}

export function initMemberManager() {
    const manager = document.getElementById('member-manager');
    if (!manager) return;

    const issueId = manager.dataset.issueId;
    const badges = document.getElementById('issue-members');
    const checkboxes = manager.querySelectorAll('.member-checkbox');

    checkboxes.forEach((cb) => {
        cb.addEventListener('change', async () => {
            cb.disabled = true;
            try {
                if (cb.checked) {
                    await request(`/issues/${issueId}/members`, {
                        method: 'POST',
                        body: JSON.stringify({ user_id: cb.dataset.userId }),
                    });
                } else {
                    await request(`/issues/${issueId}/members/${cb.dataset.userId}`, {
                        method: 'DELETE',
                    });
                }
                renderMembers(badges, checkboxes);
            } catch (e) {
                cb.checked = !cb.checked;
            } finally {
                cb.disabled = false;
            }
        });
    });
}
