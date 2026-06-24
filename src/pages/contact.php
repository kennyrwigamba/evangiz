<?php
/**
 * Evangiz Restaurant - Contact Us page & Form Handlers
 */

// 1. PHP Form Submission Controller
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_type = $_POST['form_type'] ?? 'contact';
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Default values for general inquiries to match the new minimalist layout
    if ($form_type === 'contact') {
        if (empty($phone))
            $phone = 'N/A';
        if (empty($subject))
            $subject = 'General Inquiry';
    }

    $booking_date = $_POST['booking_date'] ?? '';
    $booking_time = $_POST['booking_time'] ?? '';
    $guests = intval($_POST['guests'] ?? 0);

    $errors = [];
    if (empty($name))
        $errors[] = "Full Name is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "A valid Email Address is required.";
    if (empty($phone))
        $errors[] = "Phone Number is required.";

    if ($form_type === 'booking') {
        if (empty($booking_date))
            $errors[] = "Booking Date is required.";
        if (empty($booking_time))
            $errors[] = "Booking Time is required.";
        if ($guests <= 0)
            $errors[] = "Guests count must be at least 1.";
    } else {
        if (empty($subject))
            $errors[] = "Subject is required.";
        if (empty($message))
            $errors[] = "Message body is required.";
    }

    // Check if AJAX submit
    $is_ajax = (!empty($_SERVER['HTTP_X_REQUEST_WITH']) && strtolower($_SERVER['HTTP_X_REQUEST_WITH']) === 'xmlhttprequest') || isset($_POST['ajax_submit']);

    if (!empty($errors)) {
        $err_msg = implode(" ", $errors);
        if ($is_ajax) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => $err_msg]);
            exit;
        } else {
            header("Location: " . url('/contact?status=error&msg=' . urlencode($err_msg)));
            exit;
        }
    }

    try {
        if ($form_type === 'booking') {
            // Save to bookings table
            $stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, booking_date, booking_time, guests, subject, message, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
            $stmt->execute([$name, $email, $phone, $booking_date, $booking_time, $guests, $subject ?: 'Table Booking', $message]);
            if (strpos($subject, 'Catering') !== false) {
                $success_message = "Your catering inquiry request was logged successfully! We will contact you soon.";
            } else {
                $success_message = "Your table reservation request was logged successfully! We will contact you soon.";
            }
        } else {
            // Save to contacts table
            $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $phone, $subject, $message]);
            $success_message = "Your contact inquiry message has been submitted successfully!";
        }

        // 2. Email Transmission Dispatch (HTML layout template)
        $to = CONTACT_RECEIVER_EMAIL;
        $mail_subject = "Evangiz Web Submission: " . ($form_type === 'booking' ? "New Table Booking" : "New Contact Inquiry");

        $mail_content = "
        <html>
        <head>
            <title>{$mail_subject}</title>
<!-- Page styles moved to /css/pages/contact.css for caching & performance -->
</head>
        <body>
            <div class='email-card'>
                <div class='email-header'>
                    <h2>{$mail_subject}</h2>
                </div>
                <div class='email-body'>
                    <p>You have received a new inquiry from the Evangiz Restaurant website:</p>
                    <table class='email-table'>
                        <tr><th>Sender Name</th><td>" . htmlspecialchars($name) . "</td></tr>
                        <tr><th>Email Address</th><td>" . htmlspecialchars($email) . "</td></tr>
                        <tr><th>Phone Number</th><td>" . htmlspecialchars($phone) . "</td></tr>";

        if ($form_type === 'booking') {
            $mail_content .= "
                        <tr><th>Booking Date</th><td>" . htmlspecialchars($booking_date) . "</td></tr>
                        <tr><th>Booking Time</th><td>" . htmlspecialchars($booking_time) . "</td></tr>
                        <tr><th>Total Guests</th><td>" . htmlspecialchars($guests) . "</td></tr>";
        }

        $mail_content .= "
                        <tr><th>Subject Option</th><td>" . htmlspecialchars($subject ?: 'Table Booking') . "</td></tr>
                        <tr><th>Message Body</th><td>" . nl2br(htmlspecialchars($message)) . "</td></tr>
                    </table>
                </div>
            </div>
        </body>
        </html>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . CONTACT_SENDER_EMAIL . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";

        // Trigger mail delivery (ignore local setup SMTP failures gracefully)
        @mail($to, $mail_subject, $mail_content, $headers);

        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => $success_message]);
            exit;
        } else {
            header("Location: " . url('/contact?status=success&msg=' . urlencode($success_message)));
            exit;
        }

    } catch (PDOException $e) {
        $db_err = "System Error: Failed to save details. " . $e->getMessage();
        if ($is_ajax) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $db_err]);
            exit;
        } else {
            header("Location: " . url('/contact?status=error&msg=' . urlencode($db_err)));
            exit;
        }
    }
}

// 3. Status messages formatting indicators for non-AJAX fallbacks
$status = $_GET['status'] ?? null;
$status_msg = $_GET['msg'] ?? '';

$page_header_title = 'Connect With Evangiz';
$page_header_image = '/image/page-header/page-contact.jpg';
$page_header_breadcrumbs = [
    ['label' => 'Home', 'href' => url('/')],
    ['label' => 'Contact Us'],
];

include __DIR__ . '/../includes/page-header.php';
?>

<!-- Content Block -->
<section class="section contact-section">
    <div class="container">

        <!-- Display Status Alert if POST fallback redirects here -->
        <?php if ($status): ?>
            <div class="form-status-alert alert-<?php echo $status === 'success' ? 'success' : 'error'; ?> show-alert">
                <strong><?php echo $status === 'success' ? 'Success!' : 'Error:'; ?></strong>
                <?php echo htmlspecialchars($status_msg); ?>
            </div>
        <?php endif; ?>

        <div class="grid-2 contact-grid">
            <!-- Column 1: Details & Address -->
            <div class="contact-info-column animate-scroll-reveal reveal-left">
                <h2 class="contact-main-heading">Just Drop A Line!</h2>
                <p class="contact-lead-desc">If you have any questions or concerns, just write a question and we will
                    reply you within 24 hours, we are always welcome.</p>

                <!-- Orange wave divider -->
                <div class="menu-title-wave mb-lg mt-sm"></div>

                <div class="grid-2 contact-subgrid">
                    <div class="info-block">
                        <h4 class="info-block-title">ENTEBBE </h4>
                        <p class="info-block-text">Plot 65 Kiwafu Road Kitooro Entebbe</p>
                        <p class="info-block-text mt-sm"><strong>Tel:</strong> <a href="tel:+256393104494"
                                class="text-accent">+256-393104494</a> / <a href="tel:+256200924832"
                                class="text-accent">+256-200924832</a></p>
                    </div>
                    <div class="info-block">
                        <h4 class="info-block-title">LUBOWA </h4>
                        <p class="info-block-text">Lubowa, along Kampala-Entebbe Road (directly opposite Roofings)</p>
                        <p class="info-block-text mt-sm"><strong>Tel:</strong> <a href="tel:+256393104493"
                                class="text-accent">+256-393104493</a> / <a href="tel:+256200924833"
                                class="text-accent">+256-200924833</a></p>
                    </div>
                </div>

                <div class="contact-links-box mb-lg mt-md">
                    <div class="info-block">
                        <h4 class="info-block-title">OPENING HOURS</h4>
                        <p class="info-block-text">
                            Mon - Fri : 9:00am - 10:00pm,<br>
                            Sat - Sun: 9:00am - 11:00pm<br>
                        </p>
                    </div>
                    <p class="contact-link-item mt-md">Mail: <a
                            href="mailto:evangizrestaurant@gmail.com">evangizrestaurant@gmail.com</a></p>
                </div>

                <!-- Social links circle badges -->
                <div class="contact-social-row">
                    <a href="https://www.tiktok.com/@evangizrestaurant" aria-label="TikTok"
                        class="contact-social-circle" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 448 512" fill="currentColor" aria-hidden="true">
                            <path
                                d="M448 209.9a210.1 210.1 0 0 1-122.8-39.3v178.7a162.6 162.6 0 1 1-140.2-161v89.9a74.6 74.6 0 1 0 52.2 71.2V0h88a122.2 122.2 0 0 0 55.8 102.4 121.4 121.4 0 0 0 67 20.1z">
                            </path>
                        </svg>
                    </a>
                    <a href="mailto:info@evangiz.com" aria-label="Mail" class="contact-social-circle" target="_blank">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                            </path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/evangizrestaurant" aria-label="Instagram"
                        class="contact-social-circle" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                    <a href="https://www.youtube.com/@evangizrestaurant" aria-label="YouTube"
                        class="contact-social-circle" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="5" width="20" height="14" rx="4"></rect>
                            <polygon points="10 8 16 12 10 16 10 8"></polygon>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Column 2: Interactive Input Forms -->
            <div class="contact-forms-column animate-scroll-reveal reveal-right">
                <!-- Form: General Inquiry -->
                <div class="form-panel-wrapper" id="contact-form-wrapper">
                    <form action="<?php echo url('/contact'); ?>" method="POST" id="contact-form" class="clean-form"
                        novalidate>
                        <input type="hidden" name="form_type" value="contact">

                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name*" required>
                            <span class="form-error-msg"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email*" required>
                            <span class="form-error-msg"></span>
                        </div>

                        <!-- Hidden defaults for phone & subject to satisfy DB requirements -->
                        <input type="hidden" name="phone" value="N/A">
                        <input type="hidden" name="subject" value="General Inquiry">

                        <div class="form-group">
                            <label class="form-label">Write message</label>
                            <textarea name="message" class="form-control form-textarea" placeholder="Write message"
                                rows="6" required></textarea>
                            <span class="form-error-msg"></span>
                        </div>

                        <div class="form-action-row mt-md">
                            <button type="submit" class="btn-send-message btn-send-message-blue">SEND A MESSAGE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Google Map Section at the bottom -->
        <div class="contact-map-wrapper animate-scroll-reveal mt-xl">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.782173338572!2d32.556929!3d0.243892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177d976cf2f407a3%3A0xe1e781134847204c!2sEvangiz%20Restaurant!5e0!3m2!1sen!2srw!4v1780362147943!5m2!1sen!2srw"
                width="100%" height="450" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<!-- Inline styles for Contact Page -->