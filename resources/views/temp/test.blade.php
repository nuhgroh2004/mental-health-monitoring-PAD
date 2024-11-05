<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test reCAPTCHA</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <form action="your_action_url" method="POST">
        <input type="text" name="name" placeholder="User name"><br>
        <input type="email" name="email" placeholder="User email"><br>
        <input type="password" name="password" placeholder="User password"><br>
        <div class="g-recaptcha" data-sitekey="6LcbBnYqAAAAAO3aeA-qQHkJtabNN6S7v2H_7p9W"></div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
