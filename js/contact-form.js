/**
 * Evangiz Restaurant - Contact & Booking AJAX Form Handler
 */

document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contact-form');
    const bookingForm = document.getElementById('booking-form');

    if (contactForm) {
        setupFormHandler(contactForm, 'contact');
    }
    
    if (bookingForm) {
        setupFormHandler(bookingForm, 'booking');
    }
});

/**
 * Validates inputs and binds AJAX handlers to forms
 */
function setupFormHandler(form, formType) {
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn ? submitBtn.innerHTML : 'Submit';
    
    // Create status wrapper if not exists
    let statusDiv = form.querySelector('.form-status-alert');
    if (!statusDiv) {
        statusDiv = document.createElement('div');
        statusDiv.className = 'form-status-alert';
        form.appendChild(statusDiv);
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Reset previous validation errors
        let hasError = false;
        statusDiv.className = 'form-status-alert';
        statusDiv.innerHTML = '';
        statusDiv.style.display = 'none';
        
        const inputs = form.querySelectorAll('.form-control[required]');
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
            const errorMsg = input.nextElementSibling;
            if (errorMsg && errorMsg.classList.contains('form-error-msg')) {
                errorMsg.textContent = '';
            }
            
            if (!input.value.trim()) {
                hasError = true;
                input.classList.add('is-invalid');
                if (errorMsg && errorMsg.classList.contains('form-error-msg')) {
                    errorMsg.textContent = `${input.previousElementSibling.textContent.replace('*', '').trim()} is required.`;
                }
            } else if (input.type === 'email' && !validateEmail(input.value)) {
                hasError = true;
                input.classList.add('is-invalid');
                if (errorMsg && errorMsg.classList.contains('form-error-msg')) {
                    errorMsg.textContent = 'Please enter a valid email address.';
                }
            }
        });
        
        if (hasError) {
            statusDiv.className = 'form-status-alert alert-error';
            statusDiv.textContent = 'Please fix the errors above and resubmit.';
            statusDiv.style.display = 'block';
            return;
        }

        // Disable button & show spinner/loader state
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="btn-spinner"></span>
                <span>Processing...</span>
            `;
        }

        // Collect Form Data
        const formData = new FormData(form);
        formData.append('ajax_submit', '1');
        formData.append('form_type', formType);

        // Fetch API dispatch to backend
        fetch(form.getAttribute('action') || window.location.href, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Server responded with an error status.');
            }
            return response.json();
        })
        .then(data => {
            // Re-enable button
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }

            if (data.status === 'success') {
                form.reset();
                statusDiv.className = 'form-status-alert alert-success';
                statusDiv.innerHTML = `<strong>Success!</strong> ${data.message}`;
                statusDiv.style.display = 'block';
            } else {
                statusDiv.className = 'form-status-alert alert-error';
                statusDiv.innerHTML = `<strong>Error:</strong> ${data.message}`;
                statusDiv.style.display = 'block';
            }
        })
        .catch(error => {
            // Re-enable button
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }
            statusDiv.className = 'form-status-alert alert-error';
            statusDiv.innerHTML = '<strong>Error:</strong> A network connection problem occurred. Please try again.';
            statusDiv.style.display = 'block';
            console.error('Submission error:', error);
        });
    });
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
