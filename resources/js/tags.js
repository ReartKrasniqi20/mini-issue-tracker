import { request } from './csrf';

function parseSelectedTags(manager) {
    try {
        return new Set(JSON.parse(manager.dataset.selectedTags || '[]').map(String));
    } catch (e) {
        return new Set();
    }
}

function renderTagOptions(manager, tags, selectedTags) {
    if (tags.length === 0) {
        manager.innerHTML = `
            <p class="text-sm text-gray-500">
                No tags exist yet. <a href="${manager.dataset.tagsUrl}" class="text-indigo-600 hover:underline">Create some first</a>.
            </p>
        `;
        return [];
    }

    manager.innerHTML = '';

    return tags.map((tag) => {
        const label = document.createElement('label');
        label.className = 'flex items-center gap-3 cursor-pointer';

        const input = document.createElement('input');
        input.type = 'checkbox';
        input.className = 'tag-checkbox issue-manager-checkbox rounded border-black text-gray-900 focus:ring-0 focus:ring-offset-0';
        input.dataset.tagId = tag.id;
        input.dataset.tagName = tag.name;
        input.dataset.tagColor = tag.color;
        input.checked = selectedTags.has(String(tag.id));

        const badge = document.createElement('span');
        badge.className = 'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium text-white';
        badge.style.backgroundColor = tag.color || '#6b7280';
        badge.textContent = tag.name;

        label.append(input, badge);
        manager.appendChild(label);

        return input;
    });
}

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

    request(manager.dataset.optionsUrl)
        .then(({ tags }) => {
            const checkboxes = renderTagOptions(manager, tags, parseSelectedTags(manager));

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
                        cb.checked = !cb.checked;
                    } finally {
                        cb.disabled = false;
                    }
                });
            });
        })
        .catch(() => {
            manager.innerHTML = '<p class="text-sm text-red-600">Could not load tags.</p>';
        });
}
