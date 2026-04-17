<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $company = $_POST["company"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $message = $_POST["message"];
        $captcha = $_POST["g-recaptcha-response"];

        // Replace YOUR_SECRET_KEY with your actual reCAPTCHA secret key
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6LfYoIknAAAAAIALNPqlgHUZrdgkcRiKILiToxkB',
            'response' => $captcha
        );

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ),
        );

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $result = json_decode($response, true);

        if ($result['success']) {
            // Process the form data here (e.g., send an email, save to a database, etc.)
            // Replace the placeholders with your actual email and other processing code.
            $to = "your-email@example.com";
            $subject = "Inquiry from Website";
            $message = "Name: $name\nCompany: $company\nEmail: $email\nPhone: $phone\nMessage: $message";

            mail($to, $subject, $message);
            echo "<p>Thank you for your inquiry. We will get back to you shortly.</p>";
        } else {
            echo "<p>CAPTCHA verification failed. Please try again.</p>";
        }
    }
    ?>
    <h1>Contact Us</h1>
    <form method="post" action="contact-pro.php">
        <label>Name:</label><br>
        <input type="text" name="name" required><br>

        <label>Company Name:</label><br>
        <input type="text" name="company" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Phone No:</label><br>
        <input type="tel" name="phone" required><br>

        <label>Message:</label><br>
        <textarea name="message" rows="5" required></textarea><br>

        <div class="g-recaptcha" data-sitekey="6LfYoIknAAAAAK6VrEs7Iy3NAnTtDNPCcQnUXsK4"></div><br>
        <!-- Replace YOUR_SITE_KEY with your actual reCAPTCHA site key -->

        <input type="submit" value="Submit">
    </form>
</body>
</html>