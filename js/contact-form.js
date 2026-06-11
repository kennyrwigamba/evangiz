/**
 * Evangiz Restaurant - Contact & Booking AJAX Form Handler
 */

document.addEventListener('DOMContentLoaded', () => {
    // EmailJS configuration
    const EMAILJS_PUBLIC_KEY = 'dOVcu0nvTMk5cSVLh';
    if (window.emailjs && typeof window.emailjs.init === 'function') {
        window.emailjs.init({
            publicKey: EMAILJS_PUBLIC_KEY
        });
    }

    const contactForm = document.getElementById('contact-form');
    const bookingForm = document.getElementById('booking-form');
    const cateringForm = document.getElementById('catering-form');

    if (contactForm) {
        setupFormHandler(contactForm, 'contact');
    }
    
    if (bookingForm) {
        setupFormHandler(bookingForm, 'booking');
    }

    if (cateringForm) {
        setupFormHandler(cateringForm, 'booking');
    }
});

/**
 * Validates inputs and binds AJAX handlers to forms
 */
function setupFormHandler(form, formType) {
    const EMAILJS_SERVICE_ID = 'service_tvh6uqa';
    const EMAILJS_TEMPLATE_ID = 'template_k94wivw';
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn ? submitBtn.innerHTML : 'Submit';
    
    // Create status wrapper if not exists and place it at top of form
    let statusDiv = form.querySelector('.form-status-alert');
    if (!statusDiv) {
        statusDiv = document.createElement('div');
        statusDiv.className = 'form-status-alert';
        form.insertBefore(statusDiv, form.firstChild);
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
                return response.text().then(text => {
                    throw new Error('HTTP ' + response.status + ': ' + (text || response.statusText));
                });
            }
            // Attempt to parse JSON but fall back to text for diagnostics
            return response.text().then(txt => {
                try {
                    return JSON.parse(txt);
                } catch (e) {
                    throw new Error('Invalid JSON response from server: ' + txt);
                }
            });
        })
        .then(data => {
            // Re-enable button
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }

            if (data.status === 'success') {
                const emailParams = {
                    form_type: formType,
                    name: formData.get('name') || '',
                    email: formData.get('email') || '',
                    phone: formData.get('phone') || 'N/A',
                    subject: formData.get('subject') || (formType === 'booking' ? 'Table Booking' : 'General Inquiry'),
                    message: formData.get('message') || '',
                    booking_date: formData.get('booking_date') || '',
                    booking_time: formData.get('booking_time') || '',
                    guests: formData.get('guests') || ''
                };

                if (window.emailjs && typeof window.emailjs.send === 'function') {
                    // Email notification is best-effort: DB success should still be shown to user.
                    window.emailjs
                        .send(EMAILJS_SERVICE_ID, EMAILJS_TEMPLATE_ID, emailParams)
                        .catch(error => {
                            console.warn('EmailJS send failed:', error);
                        });
                }

                form.reset();
                statusDiv.className = 'form-status-alert alert-success';
                statusDiv.innerHTML = `<strong>Success!</strong> ${data.message}`;
                statusDiv.style.display = 'block';
                try { statusDiv.scrollIntoView({ behavior: 'smooth', block: 'center' }); } catch(e) {}
            } else {
                statusDiv.className = 'form-status-alert alert-error';
                statusDiv.innerHTML = `<strong>Error:</strong> ${data.message}`;
                statusDiv.style.display = 'block';
                try { statusDiv.scrollIntoView({ behavior: 'smooth', block: 'center' }); } catch(e) {}
            }
        })
        .catch(error => {
            // Re-enable button
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            }
            statusDiv.className = 'form-status-alert alert-error';
            // Show diagnostic message to help root-cause (trim large HTML responses)
            const msg = (error && error.message) ? error.message : 'A network connection problem occurred. Please try again.';
            statusDiv.innerHTML = `<strong>Error:</strong> ${msg}`;
            statusDiv.style.display = 'block';
            try { statusDiv.scrollIntoView({ behavior: 'smooth', block: 'center' }); } catch(e) {}
            console.error('Submission error:', error);
        });
    });
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
