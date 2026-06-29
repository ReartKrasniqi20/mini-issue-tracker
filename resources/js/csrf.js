// Small fetch wrapper: attaches CSRF token + JSON headers, and throws an
// error carrying { status, data } so callers can handle 422 validation.
export async function request(url, options = {}) {
    const token = document.querySelector('meta[name="csrf-token"]')?.content;

    const response = await fetch(url, {
        method: options.method || 'GET',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            ...(options.headers || {}),
        },
        body: options.body,
    });

    let data = null;
    try {
        data = await response.json();
    } catch (e) {
        // no JSON body
    }

    if (!response.ok) {
        const error = new Error('Request failed');
        error.status = response.status;
        error.data = data;
        throw error;
    }

    return data;
}
