import { request } from './csrf';

function parseSelectedUsers(manager) {
    try {
        return new Set(JSON.parse(manager.dataset.selectedUsers || '[]').map(String));
    } catch (e) {
        return new Set();
    }
}

function renderUserOptions(manager, users, selectedUsers) {
    if (users.length === 0) {
        manager.innerHTML = '<p class="text-sm text-gray-500">No users exist yet.</p>';
        return [];
    }

    manager.innerHTML = '';

    return users.map((user) => {
        const label = document.createElement('label');
        label.className = 'flex items-center gap-3 cursor-pointer';

        const input = document.createElement('input');
        input.type = 'checkbox';
        input.className = 'member-checkbox issue-manager-checkbox rounded border-black text-gray-900 focus:ring-0 focus:ring-offset-0';
        input.dataset.userId = user.id;
        input.dataset.userName = user.name;
        input.checked = selectedUsers.has(String(user.id));

        const name = document.createElement('span');
        name.className = 'text-sm text-gray-700';
        name.textContent = user.name;

        label.append(input, name);
        manager.appendChild(label);

        return input;
    });
}

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

    request(manager.dataset.optionsUrl)
        .then(({ users }) => {
            const checkboxes = renderUserOptions(manager, users, parseSelectedUsers(manager));

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
        })
        .catch(() => {
            manager.innerHTML = '<p class="text-sm text-red-600">Could not load members.</p>';
        });
}
