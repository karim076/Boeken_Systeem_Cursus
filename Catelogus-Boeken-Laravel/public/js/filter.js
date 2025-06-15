function applyFilters() {
    console.log("Applying filters...");

    const formData = new FormData();
    const searchValue = document.querySelector('input[name="search"]')?.value;
    const bookListContainer = document.getElementById('book-list-container');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    // Debug: Log the CSRF token
    console.log("CSRF Token:", csrfToken);

    if (!csrfToken) {
        console.error("CSRF token not found!");
        if (bookListContainer) {
            bookListContainer.innerHTML = '<div class="error">Security error. Please refresh the page.</div>';
        }
        return;
    }

    // Show loading indicator
    if (bookListContainer) {
        bookListContainer.innerHTML = '<div class="loading">Finding...</div>';
    }

    // Add form data
    if (searchValue) formData.append('search', searchValue);
    document.querySelectorAll('input[name="categories[]"]:checked').forEach(checkbox => {
        formData.append('categories[]', checkbox.value);
    });
    document.querySelectorAll('input[name="cover_types[]"]:checked').forEach(checkbox => {
        formData.append('cover_types[]', checkbox.value);
    });
    document.querySelectorAll('input[name="languages[]"]:checked').forEach(checkbox => {
        formData.append('languages[]', checkbox.value);
    });

    // Debug: Log form data being sent
    for (let [key, value] of formData.entries()) {
        console.log(key + ": " + value);
    }

    // Make AJAX request with timeout
    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), 10000); // 10 second timeout

    fetch('/filter-books', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken
        },
        body: formData,
        signal: controller.signal
    })
    .then(response => {
        clearTimeout(timeoutId);

        // Debug: Log response status
        console.log("Response status:", response.status);

        if (!response.ok) {
            return response.text().then(text => {
                throw new Error(`Server error: ${response.status} - ${text}`);
            });
        }
        return response.json();
    })
    .then(data => {
        // Debug: Log received data
        console.log("Received data:", data);

        if (!bookListContainer) return;

        if (data.html) {
            bookListContainer.innerHTML = data.html;
        } else {
            bookListContainer.innerHTML = '<div class="no-results">No books found</div>';
        }

        if (data.pagination) {
            const paginationContainer = document.querySelector('.library-pagination');
            if (paginationContainer) {
                paginationContainer.innerHTML = data.pagination;
            }
        }

        initBookCardEvents();
    })
    .catch(error => {
        clearTimeout(timeoutId);
        console.error('Error:', error);

        if (bookListContainer) {
            let errorMessage = 'Error loading results. Please try again.';

            if (error.name === 'AbortError') {
                errorMessage = 'Request timed out. Please try again.';
            } else if (error.message.includes('Server error')) {
                errorMessage = error.message;
            }

            bookListContainer.innerHTML = `<div class="error">${errorMessage}</div>`;
        }
    });
}
