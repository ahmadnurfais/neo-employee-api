<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Account: Your OTP Code - NeoEmployee</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 20px 0;
        }

        .header img {
            max-width: 100px;
            border-radius: 50%;
        }

        .header h1 {
            color: #0097B2;
            margin: 10px 0 0;
            font-size: 24px;
        }

        .content {
            text-align: center;
            margin-top: 20px;
        }

        .content p {
            font-size: 16px;
            color: #333333;
            margin: 10px 0;
        }

        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #0097B2;
            margin: 20px 0;
        }

        .description {
            font-size: 14px;
            color: #666666;
            margin-top: 10px;
            line-height: 1.5;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
        }

        .footer a {
            margin: 0 10px;
            display: inline-block;
            color: #0097B2;
            text-decoration: none;
        }

        .app-icons img {
            width: 36px;
            height: 36px;
            margin: 20px 10px;
        }

        .social-icons img {
            width: 24px;
            height: 24px;
            margin: 0 10px;
        }

        .footer p {
            color: #666666;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <img src="https://files.ahmadnurfais.my.id/neoemployee_app_icon.png" alt="NeoEmployee Icon">
            <h1>NeoEmployee</h1>
        </div>

        <!-- Content Section -->
        <div class="content">
            <p>Hello, <b>{{ $email_receiver_name }}</b></p>
            <p>Your OTP code is:</p>
            <p class="otp-code">{{ $otp }}</p>
            <p>Please use this code to verify your account. It will expire in 5 minutes.</p>
            <hr />
            <!-- App Description -->
            <div class="description">
                <p><strong>NeoEmployee</strong>, a comprehensive employee management mobile application designed to
                    streamline workplace operations and boost productivity.</p>
            </div>
        </div>

        <!-- Footer Section with Inline Images -->
        <div class="footer">
            <p>Download our app or visit our website:</p>
            <p><b><a href="www.google.com">www.neoemployee.com</a></b></p>

            <!-- App and Website Icons using Images -->
            <a href="https://play.google.com/store/apps/details?id=com.neoemployee.app" title="Download on Google Play">
                <img width="250"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/512px-Google_Play_Store_badge_EN.svg.png"
                    alt="Google Play Store">
            </a>

            <!-- Social Media Icons using Images -->
            <div class="social-icons" style="margin-top: 10px;">
                <a href="https://www.facebook.com/neoemployee" title="Follow us on Facebook">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Facebook_f_logo_%282019%29.svg/600px-Facebook_f_logo_%282019%29.svg.png"
                        alt="Facebook Icon">
                </a>
                <a href="https://www.twitter.com/neoemployee" title="Follow us on Twitter">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2d/Twitter_X.png/800px-Twitter_X.png?20230729154337"
                        alt="Twitter Icon">
                </a>
                <a href="https://www.instagram.com/neoemployee" title="Follow us on Instagram">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
                        alt="Instagram Icon">
                </a>
            </div>

            <p>&copy; {{ date('Y') }} NeoEmployee. All rights reserved.</p>
        </div>
    </div>

</body>

</html>
