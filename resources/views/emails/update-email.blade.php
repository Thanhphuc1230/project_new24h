<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Email Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <p>Hi {{ $user->fullname }},</p>
    <p>Please click the following link to verify your new email:</p>
    <p><a href="{{ url('/verify_email/' . $token . '?new_email=' . $newEmail) }}">Verify your email address</a></p>
    <p>If you did not request this change, please contact us immediately.</p>
    <p>Thank you for using our website.</p>
</body>
</html>
