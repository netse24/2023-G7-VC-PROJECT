<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verify Code</title>
</head>

<body>
    <h2>Hello, {{$data['first_name']}} {{$data['last_name']}} </h2>
    <p>Here is your verify code: {{$data['verify_code']}} <br>
        Don't let anyone know about this code <br>
        and you can use this code to recover your account. <br>
       <strong> Thank You...!</strong>
    </p>

</body>

</html>