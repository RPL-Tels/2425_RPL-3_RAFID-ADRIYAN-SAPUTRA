<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>email laravel</title>
    @vite('resources/css/app.css')
    <style>
        *{
            margin: 0;
            color: #374151;
        }
    </style>
</head>
<body>
    <div style="width: 100%;">
        <div style="width: 550px; margin-left: auto; margin-right: auto; background-color: white; border-radius: 8px;">
            <div style="padding-top: 28px; padding-left: 18px; padding-right: 18px; padding-bottom: 28px; background-color: #3b82f6; border-top-left-radius: 8px; border-top-right-radius: 8px; line-height: 1.5;">
                <p style="font-weight: bold; font-size: 20px; text-align: center; color: white;">CODE OTP</p>
                <p style="font-weight: bold; font-size: 16px; text-align: center; color: white;" class="text-gray-700">Client Management Project</p>
            </div>
            <div style="padding-top: 20px; padding-left: 18px; padding-right: 18px; padding-bottom: 20px; border: 1.5px solid #d1d5db; border-top: none; border-bottom: none; height: 400px;">
                <p style="font-size: 28px; color: #3b82f6; font-weight: bold; text-align: center; margin-top: 20px;">Login Code</p>
                <div style="padding: 20px 80px; border: 1.5px solid #d1d5db; margin-top: 20px; width: fit-content; margin-left: auto; margin-right: auto; border-radius: 8px;">
                    <p style="text-align: center; font-weight: 500;">Here is your login approval code:</p>
                    <p style="text-align: center; font-size: 30px; margin-top: 10px; font-weight: 700; letter-spacing: 10px;">{{$otp}}</p>
                    <p style="text-align: center; margin-top: 10px; font-size: small;">This code will expire in 10 minutes</p>
                </div>
                <div style="margin-top: 20px; font-size: 14px; text-align: center;">
                    <p>If this request did not come from you, ignore this email. This email was sent automatically, please do not reply.</p>
                </div>
            </div>
            <div style="padding: 20px 0px; background-color: #f3f4f6; border: 1.5px solid #d1d5db; border-top: none;">
                <p style="font-size: small; text-align: center; color: #6b7280;">© {{now()->format('Y')}} Client Management Project. All rights reserved</p>
            </div>
        </div>
    </div>
</body>
</html>