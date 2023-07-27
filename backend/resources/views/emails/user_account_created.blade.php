<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your account has been created!</title>
</head>
<body>
    <p>Hello {{$first_name}} {{$last_name}},</p>
    <p>Your account has been created in our school management system.</p>
    <p>So you can access to our school system by login information:</p>
    <p> 👉 Your Email Address: {{ $email }} </p>
    <p> 👉 Your Password: {{ $password }}</p>
    <p>Thank You...!</p>

</body>
</html>

